<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablecimientoCategorias extends Model
{
    protected $table = 'establecimiento_categorias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'cover',
        'status'
    ];
}
