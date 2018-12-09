<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaTransporte extends Model
{
    //
    use SoftDeletes;
    public function scopeLista($query){
        return $query->select('id','Razon_social')->orderby('Razon_social');
    }
}
