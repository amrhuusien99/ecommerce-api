<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\BrandTranslation;
use DB;

class BrandController extends Controller
{
    
    public function index(){

        try{
            $brands = Brand::all();
            return responseJson(1, 'Success', $brands);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request){

        try{
            DB::beginTransaction();
            //validation 
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:brand_translations,name'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // add row 
            $brand = Brand::create($request->only(['name']));
            // if is set photo
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/images/brands/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $brand->photo = 'files/images/brands/' . $name;
            }
            $brand->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function edit($id)
    {
        try{
            $brand = Brand::findOrFail($id);
            return responseJson(1, 'Success', $brand);
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong00');
        }    

    }

    public function update(Request $request, $id)
    {

        try{
            // find row 
            $brand = Brand::findOrFail($id);
            // get row translation
            $brand_trans = BrandTranslation::where('brand_id', $id)->first();
            dd($brand_trans->id);
            //validation 
            $validator = validator()->make($request->all(),[
                'name' => 'required_without:id|unique:brand_translations,name,' .  $brand_trans->id,
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // update row 
            $brand->translateOrNew('en')->name = $request->name;
            // is is set photo
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/images/brands/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $brand->photo = 'files/images/brands/' . $name;
            }
            $brand->save();
            DB::commit();
            return responseJson(1, 'The Change Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id)
    {

        try{
            DB::beginTransaction();
            $brand = Brand::findOrFail($id);
            if(!$brand->photo == null){
                $image_path = public_path( $brand->photo );
                if (unlink($image_path)){
                    $brand->delete();
                    DB::commit();
                    return responseJson(1, 'Success Deleted');
                }
            }else{
                $brand->delete();
                DB::commit();
                return responseJson(1, 'Success Deleted');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function deactivate($id)
    {
        try{
            $brand = Brand::findOrFail($id);
            $brand->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong00');
        }    

    }

    public function activate($id)
    {
        try{
            $brand = Brand::findOrFail($id);
            $brand->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong00');
        }    

    }
    // set ar language
    public function lang_ar(Request $request, $id)
    {
        try{
            // check if exists
            $brand = Brand::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:brand_translations,name,' .  $brand->id,
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt create
            DB::beginTransaction();
            $brand->translateOrNew('ar')->name = $request->name;
            $brand->save();
            DB::commit();
            return responseJson(0, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong00');
        }
    }

    // set es language
    public function lang_es(Request $request, $id)
    {
        try{
            // check if exists
            $brand = Brand::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:brand_translations,name,' .  $brand->id,
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt create
            DB::beginTransaction();
            $brand->translateOrNew('es')->name = $request->name;
            $brand->save();
            DB::commit();
            return responseJson(0, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong00');
        }
    }

}
