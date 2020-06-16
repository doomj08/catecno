<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoConductor extends Model
{
    protected $table="curso_conductores";

    public function Curso(){
        return $this->belongsTo('App\Curso');
    }
    public function Conductor(){
        return $this->belongsTo('App\Conductor');
    }
    public function EmpresaTransporte(){
        return $this->belongsTo('App\EmpresaTransporte');
    }

}
