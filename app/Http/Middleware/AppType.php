<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppType
{
    
    public function handle(Request $request, Closure $next)
    {
        if ($request->segment('2') == 'driver') {
            
           $request['app_type'] = 'driver';
            return $next($request);
           
        }elseif($request->segment('2') == 'customer'){
            $request['app_type'] = 'customer';
            return $next($request);
        }
       
    }
}
