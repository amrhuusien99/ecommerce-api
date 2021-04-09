<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use DB;

class SliderController extends Controller
{
    public function index()
    {

        try{
            $sliders = Slider::orderBy('id', 'DESC')->paginate(60);
            return responseJson(1, 'Success', $sliders);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request)
    {

        try{
            // validation
            $validator = validator()->make($request->all(),[
                'title' => 'required|unique:slider_translations,title',
                'description' => 'required',
                'photo' => 'required'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            } 
            // create slider
            DB::beginTransaction();
            $slider = Slider::create($request->except('photo'));
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/admin/images/sliders/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $slider->photo = 'files/admin/images/sliders/' . $name;
            }
            $slider->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function edit($id)
    {
        try{
            $slider = Slider::findOrFail($id);
            return responseJson(1, 'Success', $slider);
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function update(Request $request, $id)
    {

        try{
            // check if exists
            $slider = Slider::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'title' => 'required|unique:slider_translations,title,' . $slider->id,
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();
            // update row 
            $slider->update($request->except('token', 'photo'));
            if ($request->hasFile('photo')) {
                $path = public_path();
                $destinationPath = $path . '/files/admin/images/sliders/'; // upload path
                $photo = $request->file('photo');
                $extension = $photo->getClientOriginalExtension(); // getting image extension
                $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                $photo->move($destinationPath, $name); // uploading file to given path
                $slider->photo = 'files/admin/images/sliders/' . $name;
            }
            $slider->save();
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
            $slider = Slider::findOrFail($id);
            if(!$slider->photo == null){
                $image_path = public_path( $slider->photo );
                if (unlink($image_path)){
                    $slider->delete();
                    return responseJson(0, 'Success Deleted');
                }
            }else{
                $slider->delete();
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
            $slider = Slider::findOrFail($id);
            $slider->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            $slider = Slider::findOrFail($id);
            $slider->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    // set ar language
    public function lang_ar(Request $request, $id)
    {
        try{
            // check if exists
            $slider = Slider::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'title' => 'required|unique:slider_translations,title,' . $slider->id,
                'description' => 'required',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            $slider->translateOrNew('ar')->title = $request->title;
            $slider->translateOrNew('ar')->description = $request->description;
            $slider->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(1, 'There Is Something Wrong');
        }
    }

    // set es language
    public function lang_es(Request $request, $id)
    {
        try{
            // check if exists
            $slider = Slider::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'title' => 'required|unique:slider_translations,title,' . $slider->id,
                'description' => 'required',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            $slider->translateOrNew('es')->title = $request->title;
            $slider->translateOrNew('es')->description = $request->description;
            $slider->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(1, 'There Is Something Wrong');
        }
    }

}
