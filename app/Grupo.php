<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grupo extends Model
{
    //

    protected $table = "grupos";

    protected $fillable = [
        'id', 'nome',
    ];
}
