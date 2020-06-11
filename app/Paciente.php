<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    //

    protected $fillable = [
        'cns', 'nome', 'nasc', 'tel', 'rua', 'num', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lng',
    ];

    protected $primaryKey = 'cns';

    public function campanhas()
    {
        return $this->belongsToMany('\App\Campanha', 'campanhas_pacientes', 'paciente_cns', 'campanha_id')
            ->withPivot(['vacinado', 'data_time', 'agente_id'])
            ->join('agentes', 'agente_id', '=', 'agentes.id')
            ->where('vacinado', '=', true)
            ->select('campanhas', 'agentes.nome as agentes_agente_nome', 'agentes.id as agentes_agente_id');
    }

    public function agentes()
    {
        return $this->belongsToMany('\App\Agente', 'campanhas_pacientes', 'paciente_cns', 'agente_id')->withPivot(['vacinado', 'data_time'])->withTimestamps();
    }

    public function solicitacoes()
    {
        return $this->hasMany('App\Solicitacao', 'paciente_cns');
    }
}
