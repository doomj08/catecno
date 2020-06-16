<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table="conductores";
    protected $fillable=['cedula','institucion_id','nombres','apellidos' ];
    protected $casts = [
        'created_at' => 'datetime:d/M/Y', // Change your format
        'updated_at' => 'datetime:d/M/Y',
        'hora' => 'datetime:h:i a',
    ];
}
