<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoConductor extends Model
{
    //
    use SoftDeletes;
    protected $table='curso_conductores';

    public function Conductor(){
        return $this->belongsTo('App\Conductor');
    }

    public function Curso(){
        return $this->belongsTo('App\Curso');
    }
}
