<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'orders_id',
        'order_products_product_id',
        'order_products_name',
        'order_products_price',
        'order_products_qty',
        'order_products_subtotal',
        'variants',
    ];

    protected $table = 'orders_products';

    // Define the relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }
}
