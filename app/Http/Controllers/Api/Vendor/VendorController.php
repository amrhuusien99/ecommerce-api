<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use DB;
use Hash;
use Auth;

class VendorController extends Controller
{
    public function info($id)
    {

        try{
            $vendor = Vendor::findOrFail($id);
            return responseJson(1, 'Success', $vendor);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function edit(Request $request, $id)
    {

        try{
            //get vendor 
            $vendor = Auth::guard('vendor-api')->user();
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:vendors,email,'.  $vendor->id,
                'phone' => 'required|unique:vendors,phone,'.  $vendor->id,
                'address' => 'requried'
            ]);
            if(!$validator){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // update row
            $vendor->update($request->except('token', 'photo'));
            // if is there photo
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/admin/images/vendors/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $vendor->photo = 'files/admin/images/vendors/' . $name;
            }
            $vendor->save();
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
                $vendor = Auth::guard('vendor-api')->user();
                if(!$vendor){
                    return responseJson(0, 'There Is Something Wrong00');
                }
                //check if old password correct
                if(!Hash::check($request->input('oldpassword'),$vendor->password)){
                    return responseJson(0, 'There Is Something Wrong');
                }
                // save in database
                $vendor->update([
                    $vendor->password = bcrypt($request->input('password'))
                ]);
                $vendor->save();
                DB::commit();
                return responseJson(1, 'The Cahnge Has Been Done');
            }catch(\Exception $ex){
                DB::rollback();
                return $ex;
                return responseJson(0, 'There Is Something Wrong22');
            }
        }else{
            return responseJson(0, 'There Is Something Wrong00');
        }

    }

    public function state($id){

        try{
            DB::beginTransaction();
            // find vendor in database
            $vendor = Vendor::findOrFail($id);

            // update state 
            if($vendor->state == 'close'){
                $vendor->state = 'open';
            }else{
                $vendor->state = 'close';
            }
            $vendor->save();
            DB::commit();
            return responseJson(1, 'The Cahnge Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
