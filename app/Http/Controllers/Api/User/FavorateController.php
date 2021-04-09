<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class FavorateController extends Controller
{
    public function index(){ 

        try{
            $products = Auth::guard('user-api')->user()->favorates()->latest()->get();
            return responseJson(1, 'Success', $products);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function favorate(Request $request, $product_id){

        try{
            if(! auth('user-api')->user()->favorateHas(request('product_id'))){
                auth('user-api')->user()->favorates()->attach(request('product_id'));
                return responseJson(1, 'Added Has Been Done');
            }else{
                return responseJson(1, 'This Product Added Befour');
            }
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function unfavorate($product_id){

        try{
            auth('user-api')->user()->favorates()->detach(request('product_id'));
            return responseJson(1, 'Un Favorate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

}
