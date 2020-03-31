<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    //

    protected $fillable = [
        'id', 'nome', 'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lng',
    ];

    public function campanhas(){
        return $this->belongsToMany('App\Campanha')->withTimestamps();
    }
}
