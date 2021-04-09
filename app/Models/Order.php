<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;  

    const PAID = 'paid';
    const UNPAID = 'unpaid';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function user()
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this -> belongsToMany(Product::class, 'order_products')->withPivot('quantity', 'price', 'note');
    }

    public function vendor()
    {
        return $this -> belongsTo(Vendor::class, 'Vendor_id');
    }

}
