<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Periodo extends Model
{
    //

    protected $table = "periodos";

    protected $fillable = [
        'id', 'data_ini', 'data_end'
    ];
}
