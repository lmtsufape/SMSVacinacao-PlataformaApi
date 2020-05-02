<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacao extends Model
{
    //

    protected $table = "solicitacoes";

    protected $fillable = [
        'id', 'campanha_id', 'paciente_cns', 'agente_id', 'status', 'recusa_desc', 'data_time',
    ];


    public function campanha()
    {
        return $this->belongsTo('App\Campanha', 'campanha_id');
    }

    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'paciente_cns');
    }

    public function agente()
    {
        return $this->belongsTo('App\Agente');
    }
}
