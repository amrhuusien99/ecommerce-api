<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryTranslation;
use DB;

class SubCategoryController extends Controller
{
    
    public function index(){
        
        try{
            $subcategories = Category::child()->orderBy('id', 'DESC')->paginate(20);
            return responseJson(1, 'Success', $subcategories);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function create(){
        
        try{
            $maincategories = Category::parent()->orderBy('id', 'DESC')->paginate(20);
            return responseJson(1, 'Success', $maincategories);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function store(Request $request){

        try{
            //validation 
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:category_translations,name',
                'slug' => 'required|unique:categories,slug',
                'parent_id' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            // check parent
            $parent = Category::findOrFail($request->parent_id);
            // add row
            DB::beginTransaction();
            $category = Category::create($request->only(['slug', 'parent_id']));
            // add translation 
            $category->translateOrNew('en')->name = $request->name;
            $category->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Somrthing Wrong');
        }
            
    }

    public function edit($id){

        try{
            if('id'){
                $category = Category::findOrFail($id);
                return responseJson(1, 'Success', $category);
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function update(Request $request, $id){

        try{
            if('id'){
                // find row 
                $category = Category::findOrFail($id);
                // get row translation
                $category_trans = CategoryTranslation::where('category_id', $id)->first();
                //validation
                $validator = validator()->make($request->all(),[
                    'name' => 'required|unique:category_translations,name,' . $category_trans->id,
                    'slug' => 'required|unique:categories,slug,' . $category->id,
                    'parent_id' => 'required'
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                // check main category
                $parent = Category::findOrFail($request->parent_id);
                DB::beginTransaction();
                // update row
                $category->update([
                    $category->slug = $request->slug,
                    $category->parent_id = $request->parent_id,
                ]);
                // update translation
                $category->translateOrNew('en')->name = $request->name;
                $category->save();
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
            if('id'){
                $category = Category::findOrFail($id);
                $category->delete();
                return responseJson(1, 'Deleted Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function deactivate($id)
    {
        try{
            if('id'){
                $category = Category::findOrFail($id);
                $category->update(['is_activate' => 0]);
                return responseJson(1, 'The DeActivate Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            if('id'){
                $category = Category::findOrFail($id);
                $category->update(['is_activate' => 1]);
                return responseJson(1, 'The Activate Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    // set ar language
    public function lang_ar(Request $request, $id)
    {
        try{
            if('id'){
                // find row form database
                $category = Category::findOrFail($id);
                // validation
                $validator = validator()->make($request->all(),[
                    'name' => 'required|unique:category_translations,name,' .  $category->id,
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                // satrt create
                DB::beginTransaction();
                $category->translateOrNew('ar')->name = $request->name;
                $category->save();
                DB::commit();
                return responseJson(1, 'Added Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            } 
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong0');
        }
    }

    // set es language
    public function lang_es(Request $request, $id)
    {
        try{
            if('id'){
                // find row form database
                $category = Category::findOrFail($id);
                // validation
                $validator = validator()->make($request->all(),[
                    'name' => 'required|unique:category_translations,name,' .  $category->id,
                ]);
                if($validator->fails()){
                    return responseJson(0, 'Error', $validator->errors()->first());
                }
                // satrt create
                DB::beginTransaction();
                $category->translateOrNew('es')->name = $request->name;
                $category->save();
                DB::commit();
                return responseJson(1, 'Added Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }    
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong00');
        }
    }
}
