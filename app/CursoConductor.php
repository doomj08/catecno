<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoConductor extends Model
{
    use SoftDeletes;

    protected $table="curso_conductores";

    protected $fillable=['curso_id','empresa_transporte_id','conductor_id','carnet','fecha_ingreso','fecha_vence'];

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
