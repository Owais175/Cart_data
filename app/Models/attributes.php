<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributes extends Model
{
    use HasFactory;

    public $table = 'attributes';

    protected $primarykey = 'id';

    protected $fillable = ['code', 'name'];

    public function attributesvalues()
    {
        return $this->hasMany('App\attributesvalues', 'id', 'attributes_id');
    }
}
