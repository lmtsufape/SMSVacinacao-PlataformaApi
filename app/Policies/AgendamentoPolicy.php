<?php

namespace App\Policies;

use App\Agendamento;
use App\Agente;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AgendamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any agendamentos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the agendamento.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agendamento  $agendamento
     * @return mixed
     */
    public function view(Agente $user, Agendamento $agendamento)
    {
        //
    }

    /**
     * Determine whether the user can create agendamentos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a delegar solicitações.');
    }

    /**
     * Determine whether the user can update the agendamento.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agendamento  $agendamento
     * @return mixed
     */
    public function update(Agente $user, Agendamento $agendamento)
    {
        //
    }

    /**
     * Determine whether the user can delete the agendamento.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agendamento  $agendamento
     * @return mixed
     */
    public function delete(Agente $user, Agendamento $agendamento)
    {
        //
    }

    /**
     * Determine whether the user can restore the agendamento.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agendamento  $agendamento
     * @return mixed
     */
    public function restore(Agente $user, Agendamento $agendamento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the agendamento.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agendamento  $agendamento
     * @return mixed
     */
    public function forceDelete(Agente $user, Agendamento $agendamento)
    {
        //
    }
}
