<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Mail;
use App\Mail\Admin\ResetPassword;


class AuthController extends Controller
{

    public function login(Request $request){

        try{

            // validator
            $validator = validator()->make($request->all(),[
                'email' => 'required',
                'password' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }

            // login
            $token = Auth::guard('admin-api')->attempt($request->only(['email', 'password']));
            if(!$token){
                return responseJson(0, 'The Data Is Not Correct');
            }
            $admin = Auth::guard('admin-api')->user();
            $admin->token = $token;

            return responseJson(0, 'Success', $admin);

        }catch(\Exception $ex){
            return responseJson(0, 'Error, There Is Something wrong');
        }

    }

    public function logout(Request $request){

        try{
            $token = $request->header('auth-token');
            if($token){
                auth()->logout(true);
                // JWTAuth::setToken($token)->invalidate();
                return responseJson(1, 'Logged Out Successfully');
            }else{
                return responseJson(0, 'There Is Something wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There IS Something Wrong');
        }

    }

    public function password_send_code(Request $request){

        // validation
        $validator = validator()->make($request->all(),[
            'email' => 'required|email|exists:admins,email'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if admin is in database
            $admin = Admin::where('email', $request->email)->first(); 
            if($admin){
                // send code
                $code = rand(1111, 9999);
                $update = $admin->update(['pin_code' => $code]);
                DB::commit();
                if($update){
                    Mail::to($admin->email)
                        ->bcc("amrhuusien99@gmail.com")
                        ->send(New ResetPassword($code));
                        return responseJson(1, 'Send Code Has Been Done');
                }
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function update_reset_password(Request $request){
        
        // validation
        $validator = validator()->make($request->all(),[
            'phone' => 'required|exists:admins,phone',
            'pin_code' => 'required|numeric|exists:admins,pin_code',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if is admin in database
            $admin = Admin::where('phone', $request->phone)->first();
            if($admin){
                // check if is pin code correct
                $code = $admin->where('pin_code', $request->pin_code)->first();
                if(!$code){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // update password
                $admin->password = bcrypt($request->input('password'));
                $admin->pin_code = null;
                $admin->save();
                DB::commit();
                return responseJson(1, 'The Change Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }

}
