<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use DB;
use Auth;

class TagController extends Controller
{
    public function index()
    {
        try{
            $tags = auth()->guard('vendor-api')->user()->tags()->orderBy('id')->paginate(50);
            return responseJson(1, 'Success', $tags);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong00');
        }
        

    }

    public function store(Request $request)
    {

        try{
            // get vendor
            $vendor = Auth::guard('vendor-api')->user();
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:tags_translations,name',
                'slug' => 'required|unique:tags,slug',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // store in database
            DB::beginTransaction();
            $tag = Tag::create($request->only(['slug']));
            $tag->vendor_id = $vendor->id;
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function edit($id)
    {

        try{
            $tag = Tag::findOrFail($id);
            return responseJson(1, 'Success', $tag);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function update(Request $request, $id)
    {

        try{
            // find row
            $tag = Tag::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:tags_translations,name,' . $tag->id,
                'slug' => 'required|unique:tags,slug,' . $tag->id,
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // update row 
            $tag->update($request->only(['slug']));
            // save translation 
            $tag->translateOrNew('en')->name = $request->name;
            $tag->save();
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
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return responseJson(1, 'Deleted Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function deactivate($id)
    {
        try{
            $tag = Tag::findOrFail($id);
            $tag->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            $tag = Tag::findOrFail($id);
            $tag->update(['is_activate' => 1]);
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
            $tag = Tag::findOrFail($id);
            $tag->translateOrNew('ar')->name = $request->name;
            $tag->save();
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
            $tag = Tag::findOrFail($id);
            $tag->translateOrNew('es')->name = $request->name;
            $tag->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        } 
    }

}
