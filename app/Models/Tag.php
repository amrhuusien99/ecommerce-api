<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model 
{ 
    use Translatable;

    protected $table = 'tags';
    public $timestamps = true;
    protected $fillable = array('slug', 'is_activate', 'vendor_id');

    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];
    
    public function scopeActive($query)
    {
        return $query -> where('is_activate',1) ;
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

}