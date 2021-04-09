<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(){

        try{
            $orders = Order::all();
            return responseJson(1, 'Success', $orders);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function info($id){

        try{
            $order = Order::findOrFail($id);
            return responseJson(1, 'Success', $order);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

}
