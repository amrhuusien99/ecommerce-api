<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'phone', 'pin_code', 'is_activate', 'api_token' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
        return $query -> where('is_activate', 1);
    }

    public function carts()
    {
        return $this->belongsToMany(Product::class, 'carts')->withTimestamps();
    }

    public function cartHas($product_id)
    {
        return self::carts()->where('product_id', $product_id)->exists();
    }

    public function favorates()
    {
        return $this->belongsToMany(Product::class, 'favorates')->withTimestamps();
    }

    public function favorateHas($product_id)
    {
        return self::favorates()->where('product_id', $product_id)->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'orders');
    }

}
