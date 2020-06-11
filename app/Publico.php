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

    public function idades()
    {
        return $this->belongsToMany('\App\Idade', 'campanhas_idades_publicos', 'publico_id', 'idade_id')
            ->withPivot(['campanha_id', 'data_ini', 'data_end']);
    }
}
