<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function products_in_category($slug){

        try{

            $data = [];
            $data['category'] = Category::active()->where('slug', $slug)->first();
            if($data['category']){
                $data['products'] = $data['category']->products()->active()->get();
            }

            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
