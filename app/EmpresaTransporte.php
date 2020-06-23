<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaTransporte extends Model
{
    //use SoftDeletes;

    protected $fillable=['razon_social'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d', // Change your format
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function scopeBuscar($query,$criterio){
        return $query
            ->where('Razon_social','like','%'.$criterio.'%');
    }
}
