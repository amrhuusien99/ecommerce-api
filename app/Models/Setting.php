<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'phone', 'facebook', 'insta', 'whats_app', 'bank_name', 'commission', 'app_link', 'twitter', 'youtube');

}