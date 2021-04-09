<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute; 

class AttributeController extends Controller
{
    
    public function index()
    {
        try{
            $attributes = Attribute::orderBy('id','DESC') -> paginate(20);
            return responseJson(1, 'Success', $attributes);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }

    }

    public function delete($id)
    {

        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->delete();
            return responseJson(1, 'Success Deleted');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }

    }

    public function deactivate($id)
    {
        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            $attribute = Attribute::findOrFail($id);
            $attribute->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Excrption $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }    

    }

}
