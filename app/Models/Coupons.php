<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'discount',
        'expire',
        'expire_at'
    ];

    protected $primarykey = 'id';

}
