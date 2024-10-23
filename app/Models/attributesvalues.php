<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attributesvalues extends Model
{
    use HasFactory;

    protected $table = 'attributesvalues';


    protected $primarykey = 'id';

    protected $fillable = ['attributes_id', 'value'];


    public function attributes()
    {
        return $this->belongsTo('App\attributes', 'id', 'attributes_id');
    }
}
