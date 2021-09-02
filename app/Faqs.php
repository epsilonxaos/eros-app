<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $fillables = [
        'titulo',
        'informacion',
        'status'
    ];
}
