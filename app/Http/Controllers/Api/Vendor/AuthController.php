<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Mail;
use App\Mail\Vendor\ResetPassword;


class AuthController extends Controller
{

    public function login(Request $request){

        try{

            // validator
            $validator = validator()->make($request->all(),[
                'email' => 'required|email|exists:vendors,email',
                'password' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }

            // login
            $token = Auth::guard('vendor-api')->attempt($request->only(['email', 'password']));
            if(!$token){
                return responseJson(0, 'The Data Is Not Correct');
            }
            $vendor = Auth::guard('vendor-api')->user();
            $vendor->token = $token;

            return responseJson(0, 'Success', $vendor);

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
            'email' => 'required|email|exists:vendors,email'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if admin is in database
            $vendor = Vendor::where('email', $request->email)->first(); 
            if($vendor){
                // send code
                $code = rand(1111, 9999);
                $update = $vendor->update(['pin_code' => $code]);
                DB::commit();
                if($update){
                    Mail::to($vendor->email)
                        ->bcc("amrhuusien99@gmail.com")
                        ->send(New ResetPassword($code));
                        return responseJson(1, 'Send Code Has Been Done');
                }
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function update_reset_password(Request $request){
        
        // validation
        $validator = validator()->make($request->all(),[
            'phone' => 'required|exists:vendors,phone',
            'pin_code' => 'required|numeric|exists:vendors,pin_code',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if is admin in database
            $vendor = Vendor::where('phone', $request->phone)->first();
            if($vendor){
                // check if is pin code correct
                $code = $vendor->where('pin_code', $request->pin_code)->first();
                if(!$code){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // update password
                $vendor->password = bcrypt($request->input('password'));
                $vendor->pin_code = null;
                $vendor->save();
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
