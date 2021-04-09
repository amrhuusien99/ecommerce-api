<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{
    use Translatable;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('slug', 'photo', 'photos', 'quantity', 'sku', 'price', 'special_price', 'special_price_start', 'special_price_end', 'in_stock', 'is_activate', 'special_product', 'brand_id', 'vendor_id');

    protected $translatedAttributes = ['name', 'description', 'short_description'];
    protected $hidden = ['translations'];

    public function scopeActive($query)
    {
        return $query -> where('is_activate', 1) ;
    }

    public function scopeSpecialProduct($query)
    {
        return $query -> where('special_product', 1) ;
    }

    public function scopeStock($query)
    {
        return $this -> in_stock == 1 ? 'Available' : 'Un Available' ;
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id'); 
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products');
    }

}