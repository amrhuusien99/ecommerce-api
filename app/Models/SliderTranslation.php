<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model 
{

    protected $table = 'slider_translations';
    public $timestamps = false;
    protected $fillable = array('title', 'description');

}