<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    
    public function index()
    {
        try{
            $options = Option::orderBy('id', 'DESC')->paginate(50);
            return responseJson(1, 'Success', $options);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }
    }

    public function delete($id)
    {
        try{
            $option = Option::findOrFail($id);
            $option->delete();
            return responseJson(1, 'Success Deleted');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }    
    }

    public function deactivate($id)
    {
        try{
            $option = Option::findOrFail($id);
            $option->update(['is_activate' => 0]);
            return responseJson(1, 'The DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }   

    }

    public function activate($id)
    {
        try{
            $option = Option::findOrFail($id);
            $option->update(['is_activate' => 1]);
            return responseJson(1, 'The Activate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Somrthing Wrong');
        }    

    }

}
