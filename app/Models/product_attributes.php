<?php

namespace App\Models;

use App\Models\Productmodel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product_attributes extends Model
{
    use HasFactory;

    protected $fillable = ['attributes_id', 'value', 'product_price', 'product_qty', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Productmodel::class);
    }

    public function attributes()
    {
        return $this->belongsTo('App/attributes', 'attributes_id', 'id');
    }
    public function attributesvalues()
    {
        return $this->belongsTo('App/attributesvalues', 'value', 'id');
    }

}
