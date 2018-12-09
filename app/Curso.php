<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    //
    use SoftDeletes;
    public function scopeLista($query){
        return $query->select('id','nombre');
    }
}
