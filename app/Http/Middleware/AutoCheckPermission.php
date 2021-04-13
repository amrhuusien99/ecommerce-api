<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\Permission;

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
        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', route_name)")->first();
        // dd($permission);
        if(!$permission){
            return responseJson(0, 'There Is Something Wrong , Please Contact Tecnical Support');
        }
        if(!Auth::guard('admin-api')->user()->role->permissionHas($permission->id)){
            return responseJson(0, 'You Are Not Forbedine');
        }
        return $next($request);

    }
}
