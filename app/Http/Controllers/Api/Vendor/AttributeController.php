<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeTranslation;
use DB;

class AttributeController extends Controller
{
    public function index()
    {

        try{
            $attributes = Attribute::orderBy('id','DESC') -> paginate(20);
            return responseJson(1, 'Success', $attributes);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request)
    {

        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:attribute_translations,name',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // store in database
            DB::beginTransaction();
            $attribute = Attribute::create($request->only('name'));
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
            $attribute = Attribute::findOrFail($id);
            return responseJson(1, 'Success', $attribute);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        } 

    }

    public function update(Request $request, $id)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:attribute_translations,name',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            } 
            // find row 
            DB::beginTransaction();
            $attribute = Attribute::findOrFail($id);
            // update row 
            $attribute->translateOrNew('en')->name = $request->name;
            $attribute->save();
            DB::commit();
            return responseJson(1, 'The Cahnge Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function delete($id)
    {

        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->delete();
            return responseJson(1, 'Deleted Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        } 

    }

    public function deactivate($id)
    {
        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }  

    }

    // set ar language
    public function lang_ar(Request $request, $id)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt create
            DB::beginTransaction();
            // check if exists
            $attribute = Attribute::findOrFail($id);
            $attribute->translateOrNew('ar')->name = $request->name;
            $attribute->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    // set es language
    public function lang_es(Request $request, $id)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // satrt create
            DB::beginTransaction();
            // check if exists
            $attribute = Attribute::findOrFail($id);
            $attribute->translateOrNew('es')->name = $request->name;
            $attribute->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

}
