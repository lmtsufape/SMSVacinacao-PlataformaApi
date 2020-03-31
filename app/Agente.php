<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agente extends Authenticatable
{
    //

    use Notifiable;

    protected $fillable = [
        'nome', 'cpf', 'senha','cidade', 'uf',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = 'cpf';
    protected $table = "agentes";

}
