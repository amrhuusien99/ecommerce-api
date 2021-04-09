<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Auth;
use DB;
use Hash;

class AdminController extends Controller
{

    public function index(){

        try{
            $admins = Admin::all();
            return responseJson(0, 'Success', $admins);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request){

        try{
            //validation
            $validator = validator()->make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:admins,email',
                'phone' => 'required|unique:admins,phone',
                'role_id' => 'required|exists:roles,id',
                'password' => 'required|confirmed'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            $request->merge(['password'=>bcrypt($request->password)]);
            //create admin
            $admin = Admin::create($request->only(['name', 'email', 'phone', 'role_id', 'password']));
            //save image
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/admin/images/admins/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $admin->photo = 'files/admin/images/admins/' . $name;
            }
            $admin->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function create(){
        try{
            $role = Role::all();
            return responseJson(1, 'Success', $role);
        }catch(\Exception $ex){
            return responseJson(0, 'Error, There Is Something Wrong');
        }
    }

    public function info(Request $request, $id){

        try{
            if('id'){
                $admin = Auth::guard('admin-api')->user();
                return responseJson(1, 'Success', $admin);
            }else{
                return responseJson(0, 'Error, There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'Error, There Is Something Wrong');
        }

    }

    public function edit(Request $request, $id){

        try{
            if('id'){
                $admin = Auth::guard('admin-api')->user();
                return responseJson(1, 'Success', $admin);
            }else{
                return responseJson(0, 'Error, There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'Error, There Is Something Wrong');
        }

    }

    public function update(Request $request, $id){

        try{
            if('id'){
                //get admin 
                $admin = Auth::guard('admin-api')->user();
                if(!$admin){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // validation
                $validator = validator()->make($request->all(),[
                    'name' => 'required',
                    'email' => 'required|unique:admins,email,'.$admin->id,
                    'phone' => 'required|unique:admins,phone,'.$admin->id,
                    'role_id' => 'required|exists:roles,id',
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                DB::beginTransaction();
                //update row
                $admin->update([
                    $admin->name = $request->name,
                    $admin->email = $request->email,
                    $admin->phone = $request->phone,
                    $admin->role_id = $request->role_id
                ]);
                // update image
                if ($request->hasFile('photo')) {
                    if (!$admin->photo == null){
                        $image_path = public_path( $admin->photo );
                        if (unlink($image_path)){
                            $path = public_path();
                            $destinationPath = $path . '/files/admin/images/admins/'; // upload path
                            $photo = $request->file('photo');
                            $extension = $photo->getClientOriginalExtension(); // getting image extension
                            $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                            $photo->move($destinationPath, $name); // uploading file to given path
                            $admin->photo = 'files/admin/images/admins/' . $name;
                        }
                    }else{
                        $path = public_path();
                        $destinationPath = $path . '/files/admin/images/admins/'; // upload path
                        $photo = $request->file('photo');
                        $extension = $photo->getClientOriginalExtension(); // getting image extension
                        $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                        $photo->move($destinationPath, $name); // uploading file to given path
                        $admin->photo = 'files/admin/images/admins/' . $name;
                    }
                }
                $admin->save();
                DB::commit();
                return responseJson(1, 'The Change Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function change_password(Request $request, $id){

        try{
            if('id'){
                //get admin 
                $admin = Auth::guard('admin-api')->user();
                if(!$admin){
                    return responseJson(0, 'There Is Something Wrong');
                }
                //validation
                $validator = validator()->make($request->all(),[
                    'oldpassword' => 'required',
                    'password' => 'required|confirmed'
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                DB::beginTransaction();
                //check if old password correct
                if(!Hash::check($request->input('oldpassword'),$admin->password)){
                    return responseJson(0, 'There Is Something Wrong');
                }
                //update row
                $admin->update([
                    $admin->password = bcrypt($request->input('password'))
                ]);
                $admin->save();
                DB::commit();
                return responseJson(1, 'The Change Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id){
        
        try{
            DB::beginTransaction();
            $admin = Admin::findOrFail($id);
            if(!$admin->photo == null){
                $image_path = public_path( $admin->photo );
                if (unlink($image_path)){
                    $admin->delete();
                    DB::commit();
                    return responseJson(1, 'Success Deleted');
                }
            }else{
                $admin->delete();
                DB::commit();
                return responseJson(1, 'Success Deleted');
            }            
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Somring Wrong');
        }

    }

    public function activate($id){

        try{
            if($id){
                $admin = Admin::findOrFail($id);
                $admin->update(['is_activate' => 1]);
                return responseJson(0, 'The Activate Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function deactivate($id){

        try{
            if($id){
                $admin = Admin::findOrFail($id);
                $admin->update(['is_activate' => 0]);
                return responseJson(0, 'The DeActivate Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

}
