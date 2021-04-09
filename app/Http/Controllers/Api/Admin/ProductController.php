<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){

        try{
            $products = Product::orderBy('id', 'DESC')->paginate(50);
            return responseJson(1, 'Success', $products);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function info($id){

        try{
            $product = Product::findOrFail($id);
            return responseJson(1, 'Success', $product);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

}
