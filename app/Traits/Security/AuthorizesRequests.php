<?php

namespace App\Traits\Security;

use App\Components\Contracts\Gate;

trait AuthorizesRequests
{
  public function authorize($ability, $arguments = [])
    {
        list($ability, $arguments) = $this->parseAbilityAndArguments($ability, $arguments);

        return app(Gate::class)->authorize($ability, $arguments);
    }
}