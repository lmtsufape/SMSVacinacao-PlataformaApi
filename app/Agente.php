<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordEmail as ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

class Agente extends Authenticatable
{
    //

    use Notifiable;

    protected $table = "agentes";

    protected $fillable = [
        'id', 'email', 'nome', 'cpf', 'password', 'cidade', 'uf',
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
}
