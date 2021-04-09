<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Option extends Model  
{
    use Translatable;

    protected $table = 'options';
    public $timestamps = true;
    protected $fillable = array('attribute_id', 'product_id', 'is_activate');

    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}