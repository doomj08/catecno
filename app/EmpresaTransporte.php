<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaTransporte extends Model
{
    use SoftDeletes;

    protected $fillable=['razon_social'];
}
