<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CursoConductor extends Model
{
    //use SoftDeletes;

    protected $table="curso_conductores";
    protected $hidden=["pdf"];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d', // Change your format
        'updated_at' => 'datetime:Y-m-d',
    ];

    protected $fillable=['curso_id','empresa_transporte_id','conductor_id','carnet','fecha_ingreso','fecha_vence','pdf','certificado'];

    public function Curso(){
        return $this->belongsTo('App\Curso');
    }
    public function Conductor(){
        return $this->belongsTo('App\Conductor');
    }
    public function EmpresaTransporte(){
        return $this->belongsTo('App\EmpresaTransporte');
    }

    public function scopeFilter($query,$filter){
        return $query
                ->where('carnet','like','%'.$filter.'%')
                ->orwhere('certificado','like','%'.$filter.'%')
            ;
    }
    public function scopeBuscar($query,$criterio){
        return $query
            ->orwhereHas('Curso',function ($query) use($criterio){
                return $query->where('nombre','like','%'.$criterio.'%');
            })
            ->orwhereHas('Conductor',function ($query) use($criterio){
                return $query->where('Nombres','like','%'.$criterio.'%')
                    ->orwhere('Apellidos','like','%'.$criterio.'%');
            })
            ->orwhereHas('EmpresaTransporte',function ($query) use($criterio){
                return $query->where('Razon_social','like','%'.$criterio.'%');
            })
            ->orwhere('carnet','like','%'.$criterio.'%')
            ->orwhere('id','like','%'.$criterio.'%');
        ;
    }

}
