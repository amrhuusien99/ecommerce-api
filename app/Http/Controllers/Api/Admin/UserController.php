<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User;
use DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(){

        try{
            $users = User::orderBy('id', 'DESC')->paginate(50);
            return responseJson(1, 'Success', $users);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request){

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

    public function delete($id){

        try{
            DB::beginTransaction();
            $user = user::findOrFail($id);
            if(!$user->photo == null){
                $image_path = public_path( $user->photo );
                if (unlink($image_path)){
                    $user->delete();
                    DB::commit();
                    return responseJson(1, 'Success Deleted');
                }
            }else{
                $user->delete();
                DB::commit();
                return responseJson(1, 'Success Deleted');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function deactivate($id){

        try{
            $user = User::findOrFail($id);
            $user->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function activate($id){

        try{
            $user = User::findOrFail($id);
            $user->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }

}
