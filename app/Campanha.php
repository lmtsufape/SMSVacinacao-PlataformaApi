<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
    //

    protected $fillable = [
        'id', 'nome', 'desc', 'idade_ini', 'idade_end', 'atend_domic',
    ];

    public function unidades(){
        return $this->belongsToMany('App\Unidade')->withTimestamps();
    }

    public function pacientes(){
        return $this->belongsToMany('App\Paciente')->withPivot('agente_cpf','vacinado', 'data', 'horario')->withTimestamps();
    }
}
