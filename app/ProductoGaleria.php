<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoGaleria extends Model
{
    protected $table = 'producto_galerias';
    protected $primaryKey = 'id';
    protected $fillables = [
        'img',
        'producto_id',
        'order'
    ];

    public $timestamps = false;
}
