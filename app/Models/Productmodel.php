<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productmodel extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = ['product_title', 'product_image', 'product_price', 'product_description', 'product_qty'];


    public function attributes()
    {
        return $this->hasMany('App/product_attributes', 'product_id', 'id');
    }

}


