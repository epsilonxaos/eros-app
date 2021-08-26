<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenidades extends Model
{
    protected $table = 'amenidades';
    protected $primaryKey = 'id';
    protected $fillables = [
        'titulo',
        'img',
        'status'
    ];
}
