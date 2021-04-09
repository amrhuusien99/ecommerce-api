<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable; 
use Illuminate\Database\Eloquent\Model;

class Brand extends Model 
{
    use Translatable;

    protected $table = 'brands';
    public $timestamps = true;
    protected $fillable = array('photo', 'is_activate');

    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];

    public function scopeActive($query)
    {
        return $query -> where('is_activate',1) ;
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}