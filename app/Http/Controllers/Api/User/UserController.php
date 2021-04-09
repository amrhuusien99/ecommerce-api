<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
use Hash;

class UserController extends Controller
{

    public function info($id){

        try{
            $user = Auth::guard('user-api')->user();
            return responseJson(1, 'Success', $user);
        }catch(\Exception $ex){
            return responseJson(1, 'There Is Something Wrong');
        }

    }



    public function edit(Request $request, $id){

        try{

            DB::beginTransaction();
            // check if is exists
            $user = Auth::guard('user-api')->user();
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:users,email,'. $user->id,
                'phone' => 'required|unique:users,phone,'. $user->id
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            } 
            // update row 
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
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
            return responseJson(1, 'The Cahnge Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function change_password(Request $request, $id)
    {

        if('id'){
            try{
                // validation
                $validator = validator()->make($request->all(),[
                    'oldpassword' => 'requried',
                    'password' => 'requried|confirmed'
                ]);
                if(!$validator){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                DB::beginTransaction();
                //get admin 
                $user = Auth::guard('user-api')->user();
                if(!$user){
                    return responseJson(0, 'There Is Something Wrong00');
                }
                //check if old password correct
                if(!Hash::check($request->input('oldpassword'),$user->password)){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // save in database
                $user->password = bcrypt($request->input('password'));
                $user->save();
                DB::commit();
                return responseJson(1, 'The Cahnge Has Been Done');
            }catch(\Exception $ex){
                DB::rollback();
                return responseJson(0, 'There Is Something Wrong22');
            }
        }else{
            return responseJson(0, 'There Is Something Wrong00');
        }

    }

}
