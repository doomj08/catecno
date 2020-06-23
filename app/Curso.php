<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    //use SoftDeletes;

    protected $fillable=['nombre'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d', // Change your format
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function scopeBuscar($query,$criterio){
        return $query
            ->where('nombre','like','%'.$criterio.'%');
    }
}
