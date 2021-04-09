<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class CartController extends Controller
{

    public function index(){
        
        try{
            $data = [];
            $products = Auth::guard('user-api')->user()->carts()->get();
            // dd($products);
            if( count($products) > 0 ){
                foreach($products as $product){
                    $price = $product->special_price == null ? $product->price : $product->special_price ;
                    $delivery = $product->vendor->delivery_cost ;
                    $subTotel [] = $price + $delivery;
                }
                $amount = array_sum($subTotel);
                $data['products'] = $products;
                $data['amount'] = $amount;
                return responseJson(1, 'Success', $data);
            }else{
                return responseJson(0, 'No Data');
            }
        }catch(\Exception $ex){
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function store(Request $request, $product_id){

        try{

            DB::beginTransaction();
            if(!auth('user-api')->user()->cartHas(request('product_id'))){
                auth('user-api')->user()->carts()->attach(request('product_id'));
                DB::commit();
                return responseJson(1, 'Added Has Been Done');
            }else{
                return responseJson(1, 'This Product Added Befour');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete(Request $request, $product_id){

        try{

            DB::beginTransaction();

            if(auth('user-api')->user()->cartHas(request('product_id'))){
                auth('user-api')->user()->carts()->detach(request('product_id'));
                DB::commit();
                return responseJson(1, 'Removed Has Been Done');
            }else{
                return responseJson(0, 'There Is Something Wrong');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

}