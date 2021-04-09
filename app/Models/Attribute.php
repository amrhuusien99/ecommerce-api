<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model 
{
    use Translatable;

    protected $table = 'attributes';
    public $timestamps = true; 
    protected $fillable = array('is_activate');

    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];

    public function scopeActive($query)
    {
        return $query -> where('is_activate', 1);
    }

    public function options()
    {
        return $this->hasMany('App\Models\Option');
    }

}