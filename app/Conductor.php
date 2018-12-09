<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Conductor extends Model
{
    //
    use SoftDeletes;
    protected $table='Conductores';

    public function Institucion(){
        return $this->belongsTo('App\Institucion');
    }

    public static function scopeLista($query)
    {
        return $query->select('id','cedula','Nombres','Apellidos');
    }
}
