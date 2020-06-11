<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordEmail as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agente extends Authenticatable
{
    //

    use Notifiable;

    protected $table = "agentes";

    protected $fillable = [
        'id', 'email', 'nome', 'cpf', 'password', 'cidade', 'uf', 'admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    public function campanhasAtendidas()
    {
        return $this->belongsToMany('\App\Campanha', 'campanhas_pacientes', 'agente_id', 'campanha_id')->withPivot(['vacinado', 'data_time'])->withTimestamps();
    }

    public function pacientesAtendidos()
    {
        return $this->belongsToMany('\App\Paciente', 'solicitacoes', 'agente_id', 'paciente_cns')->wherePivot('status', '=', 'vacinado')->withPivot(['status', 'data_time'])->withTimestamps();
    }

    public function pacientesRecusados()
    {
        return $this->belongsToMany('\App\Paciente', 'solicitacoes', 'agente_id', 'paciente_cns')->wherePivot('status', '=', 'recusado')->withPivot(['status', 'data_time'])->withTimestamps();
    }

    public function solicitacoesAtribuidas()
    {
        return $this->belongsToMany('\App\Solicitacao', 'agentes_solicitacoes', 'agente_id', 'solicitacao_id')
            ->withPivot('chiefAgent_id')
            ->join('agentes', 'chiefAgent_id', '=', 'agentes.id')
            ->select('solicitacoes.*', 'agentes.nome AS chiefAgent_nome');
    }

    public function solicitacoesDelegadas()
    {
        return $this->belongsToMany('\App\Solicitacao', 'agentes_solicitacoes', 'chiefAgent_id', 'solicitacao_id')->withPivot('agente_id');
    }

    public function agentesDelegados()
    {
        return $this->belongsToMany('\App\Agente', 'agentes_solicitacoes', 'chiefAgent_id', 'agente_id')->withPivot('solicitacao_id');
    }
}
