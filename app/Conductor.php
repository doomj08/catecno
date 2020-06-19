<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    //use SoftDeletes;

    protected $table="conductores";

    protected $fillable=['cedula','institucion_id','nombres','apellidos' ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d', // Change your format
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected $appends=['nombre_completo','nombre_cedula'];

    public function CursoConductor(){
        return $this->hasMany('App\CursoConductor');
    }
    public function Institucion(){
        return $this->belongsTo('App\Institucion');
    }
    public function getNombreCompletoAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
    public function getNombreCedulaAttribute()
    {
        return 'C.C:'.$this->cedula. ' | ' .$this->nombres . ' ' . $this->apellidos;
    }
}
