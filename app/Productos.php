<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillables = [
        'cover',
        'nombre',
        'descripcion',
        'descripcion_extra',
        'status',
        'categorias_id',
    ];
}
