<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Category extends Model 
{
    use Translatable;

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('parent_id', 'slug', 'is_activate');

    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];

    public function scopeParent($query)
    {
        return $query -> whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query -> whereNotNull('parent_id');
    }

    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function childrens()
    {
        return $this -> hasMany(Self::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query -> where('is_activate', 1) ;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

}