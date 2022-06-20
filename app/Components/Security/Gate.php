<?php

namespace App\Components\Security;

use App\Components\Contracts\Gate as GateContract;
use App\Models\Security\Resource;
use App\Models\Security\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Gate implements GateContract
{
    use HandlesAuthorization;

    protected $container;
    protected $userResolver;
    protected $policies = [];

    public function __construct(Container $container, callable $userResolver)
    {
        $this->container    = $container;
        $this->userResolver = $userResolver;
    }

    public function permissionsForUser(User $user)
    {
        $result = User::where('id', $user->id)->first();

        $list = [];
        $roles = PermissionRole::where('role_id',$result->user_type_id)->get();
        print_r($roles);
        //role-specific ... the order is important role < group < user permissions
        foreach ($result->roles as $role) {
            foreach ($role->resources as $permission) {
                if (isset($list[$permission->uuid])) {
                    if ($list[$permission->uuid]['on'] == User::ROLE_POLICY) {
                        if ($permission->pivot->allow == false) {
                            $list[$permission->uuid]['allow'] = false;
                        }
                    } else {
                        $list[$permission->uuid]['allow'] = $permission->pivot->allow ? true : false;
                        $list[$permission->uuid]['on']    = User::ROLE_POLICY;
                        $list[$permission->uuid]['id']    = $role->id;
                    }
                } else {
                    $list[$permission->uuid] = [
                        'allow' => ($permission->pivot->allow ? true : false),
                        'on'    => User::ROLE_POLICY,
                        'id'    => $role->id];
                }
            }
        }

        // group-specific
        foreach ($result->groups as $group) {
            foreach ($group->resources as $permission) {
                if (isset($list[$permission->uuid])) {
                    if ($list[$permission->uuid]['on'] == User::GROUP_POLICY) {
                        if ($permission->pivot->allow == false) {
                            $list[$permission->uuid]['allow'] = false;
                        }
                    } else {
                        $list[$permission->uuid]['allow'] = $permission->pivot->allow ? true : false;
                        $list[$permission->uuid]['on']    = User::GROUP_POLICY;
                        $list[$permission->uuid]['id']    = $group->id;
                    }
                } else {
                    $list[$permission->uuid] = [
                        'allow' => ($permission->pivot->allow ? true : false),
                        'on'    => User::GROUP_POLICY,
                        'id'    => $group->id];
                }
            }
        }

        // user-specific policies
        foreach ($result->policies as $permission) {
            if (isset($list[$permission->uuid])) {
                if ($list[$permission->uuid]['on'] == User::USER_POLICY) {
                    if ($permission->pivot->allow == false) {
                        $list[$permission->uuid]['allow'] = false;
                    }
                } else {
                    $list[$permission->uuid]['allow'] = $permission->pivot->allow ? true : false;
                    $list[$permission->uuid]['on']    = User::USER_POLICY;
                    $list[$permission->uuid]['id']    = $result->id;
                }
            } else {
                $list[$permission->uuid] = [
                    'allow' => ($permission->pivot->allow ? true : false),
                    'on'    => User::USER_POLICY,
                    'id'    => $result->id,
                ];
            }
        }

        return $list;
    }

    public function check($resources, $arguments = [])
    {
        $user = $this->resolveUser();

        return collect($resources)->every(function ($resource) use ($user, $arguments) {
            return $this->raw($user, $resource, $arguments);
        });
    }

    protected function raw(User $user, $resource, $arguments = [])
    {
        $list = $user->getPermissionList();

        if (!Resource::isUUID($resource)) {
            if (empty($resource = Resource::byAlias($resource))) {
                return false;
            }
        }

        if (empty($list[$resource->uuid]['allow'])) {
            return false;
        } else {
            return $list[$resource->uuid]['allow'];
        }
    }

  public function authorize($resource, $arguments = [])
    {
        $theUser = $this->resolveUser();

        return $this->raw($this->resolveUser(), $resource, $arguments) ? $this->allow() : $this->deny();
    }

   protected function resolveUser()
    {
        return call_user_func($this->userResolver);
    }
}