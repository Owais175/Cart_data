<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'state',
        'zip',
        'order_items',
        'order_item_total',
        'order_shipping',
        'order_total',
        'payment_method',
        'transaction_id',
        'order_status',
        'discount',
        'tax',
    ];

    // Define the relationship with OrderProduct
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'orders_id');
    }
}
