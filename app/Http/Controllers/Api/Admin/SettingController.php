<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DB;

class SettingController extends Controller
{
    public function index(){

        try{
            $settings = Setting::orderBy('id','DESC') -> paginate(50);
            return responseJson(1, 'Success', $settings);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function edit(Request $request, $id){

        try{
            //validation
            $validator = validator()->make($request->all(),[
                'email' => 'required',
                'phone' => 'required',
                'facebook' => 'required',
                'insta' => 'required',
                'whats_app' => 'required',
                'bank_name' => 'required',
                'commission' => 'required',
                'app_link' => 'required',
                'twitter' => 'required',
                'youtube' => 'required',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            $setting = Setting::findOrFail($id);
            // update row
            $setting->update($request->except('token'));
            DB::commit();
            return responseJson(1, 'The Chage Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
