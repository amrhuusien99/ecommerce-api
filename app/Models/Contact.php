<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'content', 'type_of_message');

}