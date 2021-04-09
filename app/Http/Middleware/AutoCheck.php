<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName();
        $permissions = Auth::guard('admin-api')->user()->role->permissions;
        // dd($permissions);
        if(!$permissions){
            return responseJson(0, 'There Is Something Wrong , Please Contact Tecnical Support');
        }
        if(!in_array($routeName, $permissions)){
            return responseJson(0, 'You Are Not Forbedine');
        }
        return $next($request);
    }
}
