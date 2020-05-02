<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Idade extends Model
{
    //

    protected $fillable = [
        'id', 'grupo_id', 'idade_ini', 'idade_end', 'mes',
    ];

    public function grupo()
    {
        return $this->belongsTo('App\Grupo');
    }

}
