<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = "establecimientos";
    protected $primaryKey = "id";
    protected $fillable = [ "nombre", "cover", "lat", "lng", "telefono", "email", "facebook", "instagram", "twitter", "whatsapp" ];
}
