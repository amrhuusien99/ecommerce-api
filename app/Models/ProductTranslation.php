<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model 
{

    protected $table = 'product_translations';
    public $timestamps = false;
    protected $fillable = array('name', 'description', 'short_description');

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}