<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Slider extends Model 
{
    use Translatable;

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('is_activate', 'photo');
    
    protected $translatedAttributes = ['title', 'description'];
    protected $hidden = ['translations'];
    
    public function scopeActive($query)
    {
        return $query -> where('is_activate', 1) ;
    }

}