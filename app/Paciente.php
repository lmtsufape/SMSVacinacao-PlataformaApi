<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //

    protected $fillable = [
        'cns', 'nome', 'nasc', 'tel', 'rua', 'num', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lng',
    ];

    protected $primaryKey = 'cns';

    public function campanhas()
    {
        return $this->belongsToMany('App\Campanhas')->withPivot('agente_cpf', 'vacinado', 'data', 'horario')->withTimestamps();
    }
}
