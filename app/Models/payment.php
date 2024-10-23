<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'email', 'phone', 'address', 'city', 'country', 'state', 'zip', 'payment_method', 'stripeToken', 'create_account', 'password', 'password_confirmation'];

}
