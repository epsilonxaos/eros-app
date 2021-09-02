<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'website';
    protected $primaryKey = 'id';
    protected $fillables = [
        'catalogoPDF'
    ];

    public $timestamps = false;
}
