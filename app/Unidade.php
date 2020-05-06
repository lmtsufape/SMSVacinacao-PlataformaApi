<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model
{
    //

    protected $fillable = [
        'id', 'nome', 'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'complemento', 'lat', 'lng',
    ];

    public function vacinas()
    {
        return $this->belongsToMany('App\Vacina', 'vacinas_unidades')->withTimestamps();
    }
}
