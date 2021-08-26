<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoAmenidad extends Model
{
    protected $table = "producto_amenidades";
    protected $fillables = [
        'amenidades_id',
        'producto_id'
    ];
    public $timestamps = false;
}
