<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Auth;

class CheckToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try{
            if($guard != null){
                auth()->shouldUse($guard);
                $token = $request->header('auth-token');
                $request->headers->set('auth-token', (string) $token, true);
                $request->headers->set('authorization', 'Bearer '.$token, true);
                try{
                    $user = JWTAuth::parseToken()->authenticate();
                }catch(\Exception $ex){
                    if($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                        return responseJson(0, 'Invalid Token');
                    }elseif($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                        return responseJson(0, 'Expired Token');
                    }else{
                        return responseJson(0, 'Token Not Found');
                    }
                }catch(\Throwable $ex){
                    if($ex instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                        return responseJson(0, 'Invalid Token');
                    }elseif($ex instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                        return responseJson(0, 'Expired Token');
                    }else{
                        return responseJson(0, 'Token Not Found');
                    }
                }    
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
            if(Auth::guard($guard)->user()->is_activate == 0){
                return responseJson(0, 'You Are Not Activate , Please Contact The Administration');
            }
            return $next($request);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
