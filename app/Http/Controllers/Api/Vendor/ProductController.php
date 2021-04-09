<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Brand;
use DB;

class ProductController extends Controller
{
    public function index(){

        try{
            $products = auth()->guard('vendor-api')->user()->products()->orderBy('id')->paginate(50);
            return responseJson(1, 'Success', $products);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function create(){

        try{
            $data = [];
            $data['categories'] = Category::active()->select('id')->get();
            $data['tags'] = Tag::active()->select('id')->get();
            $data['brands'] = Brand::active()->select('id')->get();

            return responseJson(1, 'Success', $data);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }


    public function store(Request $request){

        try{
            // dd($request);
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:product_translations,name',
                'slug' => 'required|unique:products,slug',
                'description' => 'required|unique:product_translations,description',
                'categories' => 'required', 
                'categories.*' => 'numeric|exists:categories,id',
                'brand_id' => 'required|numeric|exists:brands,id'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            DB::beginTransaction();

            // start create 
            $product = Product::create([
                'slug' => $request->slug,
                'brand_id' => $request->brand_id,
                'vendor_id' => auth()->user()->id
            ]);

            //save translations
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;

            // save product categories
            $product->categories()->attach($request->categories);

            // save product tags
            if(isset($request->tags)){
                $product->tags()->attach($request->tags);
            }

            $product->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function edit($id){

        try{
            $product = Product::findOrFail($id);
            return responseJson(1, 'Success', $product);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function update(Request $request, $id){

        try{
            // check if is exists in database
            $product = Product::findOrFail($id);
            // get row translation
            $product_trans = ProductTranslation::where('product_id', $id)->first();
            // validation
            $validator = validator()->make($request->all(),[
                'name' => 'required|unique:product_translations,name,' .  $product_trans->id,
                'slug' => 'required|unique:products,slug,' .  $product->id,
                'description' => 'required|unique:product_translations,description,' . $product_trans->id,
                'categories' => 'required', 
                'categories.*' => 'numeric|exists:categories,id',
                'brand_id' => 'required|numeric|exists:brands,id'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }

            DB::beginTransaction();
            // start update
            $product->slug = $request->slug;
            $product->brand_id = $request->brand_id;
            
            //save translations
            $product->translateOrNew('en')->name = $request->name;
            $product->translateOrNew('en')->description = $request->description;
            $product->translateOrNew('en')->short_description = $request->short_description;
            $product->save();

            DB::commit();
            return responseJson(1, 'The Cahnge Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return $ex;
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function show($id){

        try{
            $product = Product::findOrFail($id);
            return responseJson(1, 'Success', $product);
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function price(Request $request, $id){

        try{
            // dd($request);
            // check if is exists in database
            $product = Product::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'price' => 'required|numeric',
                'special_price' => 'nullable|numeric',
                'special_price_start' => 'required_with:special_price',
                'special_price_end' => 'required_with:special_price'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            
            // add price for product
            $product->price = $request->price;
            $product->special_price = $request->special_price;
            $product->special_price_start = $request->special_price_start;
            $product->special_price_end = $request->special_price_end;

            if($request->selling_price == !null){
                $product->selling_price = $request->selling_price;
            }
            $product->save();

            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }
    
    public function stock(Request $request, $id){

        try{
            // check if is exists in database
            $product = Product::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'sku' => 'required|unique:products,sku',
                'quantity' => 'required|numeric',
                'in_stock' => 'required|numeric'
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            
            // add stock for product
            $product->sku = $request->sku;
            $product->quantity = $request->quantity;
            $product->in_stock = $request->in_stock;

            $product->save();
            DB::commit();
            return responseJson(1, 'Added Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function images(Request $request, $id){

        try{
            // dd($request->photo);
            // check if is exists in database
            $product = Product::findOrFail($id);
            // validation
            $validator = validator()->make($request->all(),[
                'photo' => 'required|unique:products,photo,' . $id,
                'photos' => 'nullable|array',
            ]);
            if($validator->fails()){
                return responseJson(0, 'Error', $validator->errors()->first());
            }
            
            // save photo
            if(!$request->photo == null){
                if(!$product->photo == null){
                    $image_path = public_path( $product->photo );
                    if (unlink($image_path)){
                        if (!$request->hasFile('photo') == null) {
                            $path = public_path();
                            $destinationPath = $path . '/files/admin/images/products/'; // upload path
                            $photo = $request->file('photo');
                            $extension = $photo->getClientOriginalExtension(); // getting image extension
                            $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                            $photo->move($destinationPath, $name); // uploading file to given path
                            $product->photo = 'files/admin/images/products/' . $name;
                        }
                    }
                }else{
                    if (!$request->hasFile('photo') == null) {
                        $path = public_path();
                        $destinationPath = $path . '/files/admin/images/products/'; // upload path
                        $photo = $request->file('photo');
                        $extension = $photo->getClientOriginalExtension(); // getting image extension
                        $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                        $photo->move($destinationPath, $name); // uploading file to given path
                        $product->photo = 'files/admin/images/products/' . $name;
                    }
                }
            }
            
            // save photos
            if(!$request->photo == null){
                if(!$product->photos == null){
                    $string = $product->photos;
                    $images = explode(",", $string);
                    foreach($images as $image){
                        $image_path = public_path( $image );
                        unlink($image_path);
                    }    
                    $images = array();
                    if ($request->hasFile('photos')) {
                        foreach ($files=$request->file('photos') as $file){
                            $path = public_path();
                            $destinationPath = $path . '/files/admin/images/products/'; // upload path
                            $extension = $file->getClientOriginalExtension(); // getting image extension
                            $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                            $file->move($destinationPath, $name); // uploading file to given path
                            $images[]= 'files/admin/images/products/' . $name;
                        }
                    }
                    // dd($images);
                    $product->update([   
                        'photos'=>  implode(",", $images),
                    ]);
                    $product->save();
                    DB::commit();
                    return responseJson(1, 'Added Has Been Done');
                }else{
                    $images = array();
                    if ($request->hasFile('photos')) {
                        foreach ($files=$request->file('photos') as $file){
                            $path = public_path();
                            $destinationPath = $path . '/files/admin/images/products/'; // upload path
                            $extension = $file->getClientOriginalExtension(); // getting image extension
                            $name = time() . '' . rand(11111, 99999) . '.' . $extension; //renameing image
                            $file->move($destinationPath, $name); // uploading file to given path
                            $images[]= 'files/admin/images/products/' . $name;
                        }
                    }
                    // dd($images);
                    $product->update([   
                        'photos'=>  implode(",", $images),
                    ]);
                    $product->save();
                    DB::commit();
                    return responseJson(1, 'Added Has Been Done');
                }
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    public function delete($id){

        try{
            $product = Product::findOrFail($id);
            DB::beginTransaction();
            if(!$product->photo == null){
                $image_path = public_path( $product->photo );
                if (unlink($image_path)){
                    $product->delete();
                    DB::commit();
                    return responseJson(0, 'Deleted Has Been Done');
                }
            }else{
                $product->delete();
                DB::commit();
                return responseJson(1, 'Deleted Has Been Done');
            }
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }

    }

    // set ar language
    public function lang_ar(Request $request, $id)
    {
        try{
            // validation
            DB::beginTransaction();
            // check if exists
            $product = Product::findOrFail($id);
            // satrt create
            $product->translateOrNew('ar')->name = $request->name;
            $product->translateOrNew('ar')->description = $request->description;
            $product->translateOrNew('ar')->short_description = $request->short_description;

            $product->save();
            DB::commit();
            return responseJson(1, 'Added AR Lang Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    // set es language
    public function lang_es(Request $request, $id)
    {
        try{
            // validation
            DB::beginTransaction();
            // check if exists
            $product = Product::findOrFail($id);
            // satrt create
            $product->translateOrNew('es')->name = $request->name;
            $product->translateOrNew('es')->description = $request->description;
            $product->translateOrNew('es')->short_description = $request->short_description;

            $product->save();
            DB::commit();
            return responseJson(1, 'Added ES Lang Has Been Done');
        }catch(\Exception $ex){
            DB::rollback();
            return responseJson(0, 'There Is Something Wrong');
        }
    }

    public function deactivate($id)
    {
        try{
            $product = Product::findOrFail($id);
            $product->update(['is_activate' => 0]);
            return responseJson(1, 'DeActivate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }    

    }

    public function activate($id)
    {
        try{
            $product = Product::findOrFail($id);
            $product->update(['is_activate' => 1]);
            return responseJson(1, 'Activate Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        }     

    }

    public function unspecial($id){

        try{
            $product = Product::findOrFail($id);
            $product->update(['special_product' => 0]);
            return responseJson(1, 'UnSpecial Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        } 
    
    }

    public function special($id){

        try{
            $product = Product::findOrFail($id);
            $product->update(['special_product' => 1]);
            return responseJson(1, 'Special Has Been Done');
        }catch(\Exception $ex){
            return responseJson(0, 'There Is Something Wrong');
        } 
    
    }

}
