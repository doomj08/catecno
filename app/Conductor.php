<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use SoftDeletes;

    protected $table="conductores";

    protected $fillable=['cedula','institucion_id','nombres','apellidos' ];

    protected $casts = [
        'created_at' => 'datetime:d/M/Y', // Change your format
        'updated_at' => 'datetime:d/M/Y',
    ];

    public function CursoConductor(){
        return $this->hasMany('App\CursoConductor');
    }
    public function Institucion(){
        return $this->belongsTo('App\Institucion');
    }
}
