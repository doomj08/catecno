<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table="conductores";
    protected $casts = [
        'created_at' => 'datetime:d/M/Y', // Change your format
        'updated_at' => 'datetime:d/M/Y',
        'hora' => 'datetime:h:i a',
    ];
}
