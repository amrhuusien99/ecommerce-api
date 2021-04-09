<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('notifiable_id', 'notifiable_type', 'title', 'content');

    public function notifiable()
    {
        return $this->morphTo();
    }

}