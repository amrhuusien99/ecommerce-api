<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vendor;
use DB;
use Illuminate\Support\Str;
use File;

class VendorController extends Controller
{
    public function index(){


        try{
            $vendors = Vendor::orderBy('id', 'DESC')->paginate(50);
            return responseJson(1, 'Success', $vendors);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

    public function store(Request $request){

        try{
            //validation
            $validator = validator()->make($request->all(),[
                'name' => 'required',
                'email' => 'required|unique:vendors,email',
                'phone' => 'required|unique:vendors,phone',
                'password' => 'required|confirmed'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // make password hash
            $request->merge(['password' => bcrypt($request->password)]);
            // store new vendor
            $vendor = Vendor::create($request->except('token', 'photo'));
            // make api token
            $vendor->api_token = Str::random(60);
            //save image
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
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id){

        try{
            DB::beginTransaction();
            $vendor = Vendor::findOrFail($id);
            if(!$vendor->photo == null){
                $path = str_replace('/', '\\', $vendor->photo);
                $image_path = public_path( $path );
                if (unlink($image_path)){
                    $vendor->delete();
                    DB::commit();
                    return responseJson(1, 'Deleted Has Been Done');
                }
            }else{
                $vendor->delete();
                DB::commit();
                return responseJson(1, 'Deleted Has Been Done');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

    public function deactivate($id){

        try{
            $vendor = Vendor::findOrFail($id);
            $vendor->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

    public function activate($id){

        try{
            $vendor = Vendor::findOrFail($id);
            $vendor->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

    public function unspecial($id){

        try{
            $vendor = Vendor::findOrFail($id);
            $vendor->update(['special_vendor' => 0]);
            return responseJson(1, 'The Change Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

    public function special($id){

        try{
            $vendor = Vendor::findOrFail($id);
            $vendor->update(['special_vendor' => 1]);
            return responseJson(1, 'The Change Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    
    }

}
