<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Vendor;

class HomeController extends Controller
{
    public function home(){

        try{
            $data = [];
            $data['sliders'] = Slider::active()->get(['photo']);
            // get parent categories with childern
            $data['categories'] = Category::active()->parent()->select('id', 'slug')->with(['childrens' => function ($q){
                $q->select('id', 'parent_id', 'slug');
                $q->with(['childrens' => function ($qq){
                    $qq->select('id', 'parent_id', 'slug');
                }]);
            }])->get();
            // get products by vendor
            $data['vendors'] = Vendor::active()->special_vendor()->with(['products' => function($q){
                $q->active()->specialProduct()->get();
            }])->get();

            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
