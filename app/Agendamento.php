<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agendamento extends Model
{
    //

    protected $table = "agentes_solicitacoes";

    protected $fillable = [
        'id', 'solicitacao_id', 'agente_id', 'chiefAgent_id',
    ];

    protected $softCascade = ['solicitacoes', 'agentes'];

    public function solicitacoes()
    {
        return $this->hasMany('App\solicitacao');
    }

    public static function boot()
    {
        parent::boot();

        // cause a delete of a product to cascade to children so they are also deleted
        static::deleted(function ($agendamento) {
            $agendamento->solicitacoes()->delete();
        });
    }
}
