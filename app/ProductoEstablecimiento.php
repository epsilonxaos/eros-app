<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoEstablecimiento extends Model
{
    protected $table = "producto_establecimiento";
    protected $fillables = [
        'establecimiento_id',
        'producto_id'
    ];
    public $timestamps = false;
}
