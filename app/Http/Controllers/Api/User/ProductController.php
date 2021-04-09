<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Vendor;

class ProductController extends Controller
{
    public function product_info($slug){

        try{
            $data = [];
            $data['product'] = Product::where('slug', $slug)->first();
            if(!$data['product']){
                flash()->error("This product Not Exists");
                return back();
            }
            // get product attributes
            $productid = $data['product']->id;
            $data['product_attributes'] = Attribute::whereHas('options', function($q) use($productid){
                $q -> whereHas('product', function($qq) use($productid){
                    $qq -> where('product_id', $productid);
                });
            })->get();
            // get related product
            $product_categories = $data['product'] -> categories -> pluck('id');
            $data['related_products'] = Product::specialProduct()->whereHas('categories', function($q) use($product_categories){
                $q->whereIn('categories.id', $product_categories);
            })->limit(20)->latest()->get();
            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function products_by_vendor($id){

        try{
            $data = [];
            $data['vendor'] = Vendor::findOrFail($id);
            if($data['vendor']){
                $data['vendor_products'] = $data['vendor']->products()->active()->get();
            }
            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }
    }
}
