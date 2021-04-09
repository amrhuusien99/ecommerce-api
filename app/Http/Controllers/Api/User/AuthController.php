<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;
use Mail;
use App\Mail\User\ResetPassword;
use Illuminate\Support\Str;


class AuthController extends Controller
{

    public function register(Request $request){

        try{
             //validation
            $validator = validator()->make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'phone' => 'required|unique:users,phone',
                'password' => 'required|confirmed'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // make password hash
            DB::beginTransaction();
            $request->merge(['password' => bcrypt($request->password)]);
            // start create in database 
            $user = User::create($request->except('photo'));
            // make api token
            $user->api_token = Str::random(60);
            //save image
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/admin/images/users/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $user->photo = 'files/admin/images/users/' . $name;
            }
            $user->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }


    public function login(Request $request){

        try{

            // validator
            $validator = validator()->make($request->all(),[
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }

            // login
            $token = Auth::guard('user-api')->attempt($request->only(['email', 'password']));
            if(!$token){
                return responseJson(0, 'The Data Is Not Correct');
            }
            $user = Auth::guard('user-api')->user();
            $user->token = $token;

            return responseJson(0, 'Success', $user);

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
            'email' => 'required|email|exists:users,email'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if admin is in database
            $user = User::where('email', $request->email)->first(); 
            if($user){
                // send code
                $code = rand(1111, 9999);
                $update = $user->update(['pin_code' => $code]);
                DB::commit();
                if($update){
                    Mail::to($user->email)
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
            'phone' => 'required|exists:users,phone',
            'pin_code' => 'required|numeric|exists:users,pin_code',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return responseJson(0, 'Error', $validator->errors()->first());
        }
        try{
            DB::beginTransaction();
            // check if is admin in database
            $user = User::where('phone', $request->phone)->first();
            if($user){
                // check if is pin code correct
                $code = $user->where('pin_code', $request->pin_code)->first();
                if(!$code){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // update password
                $user->password = bcrypt($request->input('password'));
                $user->pin_code = null;
                $user->save();
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
