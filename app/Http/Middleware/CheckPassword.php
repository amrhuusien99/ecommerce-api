<?php

namespace App\Http\Middleware;

use Closure;

class CheckPassword
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
        if( $request->header('api_password') !== env('API_PASSWORD','J8c4cIz6bOGRqmhPWwwpvcfB3D03GkoyAabARwdC6534321564cashjVDVDhks')){
            return responseJson(0, 'UnAuthenticated');
        }
        return $next($request);
    }
}
