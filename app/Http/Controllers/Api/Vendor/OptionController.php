<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\Product;
use App\Models\Attribute;
use DB;
use Auth;

class OptionController extends Controller 
{

    public function index()
    {

        try{

            $data = [];
            $data['products'] = Auth::guard('vendor-api')->user()->products()->active()->select('id')->get();
            $data['attributes'] = Attribute::active()->select('id')->get();
            $data['options'] = Option::orderBy('id', 'DESC')->paginate(50);

            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function create()
    {
        try{
            $data = [];
            $data['products'] = Auth::guard('vendor-api')->user()->products()->active()->select('id')->get();
            $data['attributes'] = Attribute::active()->select('id')->get();
        
            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function store(Request $request)
    {
        try{
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:option_translations,name',
                'product_id' => 'required|exists:products,id',
                'attribute_id' => 'required|exists:attributes,id',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // check product id and attribute id    
            $product = Product::findOrFail($request->product_id);
            $attribute = Attribute::findOrFail($request->attribute_id);
            // start create option
            $option = Option::create($request->only(['product_id', 'attribute_id']));
            // save translation 
            $option->translateOrNew('en')->name = $request->name;
            $option->save();
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
            if('id'){
                $option = Option::findOrFail($id);
                return responseJson(1, 'Success', $option);
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }   
    }

    public function update(Request $request, $id)
    {
        try{
            if('id'){
                // find row
                $option = Option::findOrFail($id);
                // validation
                $validator = validator()->make($request->all(),[
                    'name' => 'required|unique:option_translations,name,'. $option->id,
                    'product_id' => 'required|exists:products,id',
                    'attribute_id' => 'required|exists:attributes,id',
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                DB::beginTransaction();
                // check product id and attribute id    
                $product = Product::findOrFail($request->product_id);
                $attribute = Attribute::findOrFail($request->attribute_id);
                // start create option
                $option->update($request->only(['product_id', 'attribute_id']));
                // save translation 
                $option->translateOrNew('en')->name = $request->name;
                $option->save();
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

    public function delete($id)
    {
        try{
            if('id'){
                $option = Option::findOrFail($id);
                $option->delete();
                return responseJson(1, 'Deleted Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }   
    }

    public function deactivate($id)
    {
        try{
            if('id'){
                $option = Option::findOrFail($id);
                $option->update(['is_activate' => 0]);
                return responseJson(1, 'The Change Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }   

    }

    public function activate($id)
    {
        try{
            if('id'){
                $option = Option::findOrFail($id);
                $option->update(['is_activate' => 1]);
                return responseJson(1, 'The Change Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
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
            $option = Option::findOrFail($id);
            $option->translateOrNew('ar')->name = $request->name;
            $option->save();
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
            $option = Option::findOrFail($id);
            $option->translateOrNew('es')->name = $request->name;
            $option->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }
}
