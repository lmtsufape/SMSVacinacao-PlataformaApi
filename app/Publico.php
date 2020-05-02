<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publico extends Model
{
    //

    protected $fillable = [
        'id', 'nome'
    ];
}
