<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Vendor extends Authenticatable implements JWTSubject
{

    protected $table = 'vendors';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'photo', 'address', 'delivery_cost', 'minimum_order', 'is_activate', 'state', 'special_vendor', 'pin_code', 'api_token');

    protected $hidden = [
        'api_token', 'pin_code', 'special_vendor'
    ];
        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function scopeActive($query)
    {
        return $query -> where('is_activate', 1) ;
    }

    public function scopeSpecial_vendor($query)
    {
        return $query -> where('special_vendor', 1) ;
    }
    
    public function products() 
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function productHas($product_id)
    {
        return $this->products()->where('id', $product_id)->first();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'vendor_id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'vendor_id');
    }

    public function notification()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

}