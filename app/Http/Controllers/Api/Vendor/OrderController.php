<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;
use Auth;

class OrderController extends Controller
{
    public function index(){

        try{
            $orders = Auth::guard('vendor-api')->user()->orders()->get();
            return responseJson(1, 'Success', $orders);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function show($id){

        try{
            $order = Order::findOrFail($id);
            return responseJson(1, 'Success', $order);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }
}
