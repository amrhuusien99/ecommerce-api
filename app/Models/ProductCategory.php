<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model 
{

    protected $table = 'product_categories';
    public $timestamps = true;
    protected $fillable = array('product_id', 'category_id');

}