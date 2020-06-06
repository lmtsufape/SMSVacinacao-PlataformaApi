<?php

namespace App\Policies;

use App\Agente;
use App\Paciente;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PacientePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any pacientes.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the paciente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Paciente  $paciente
     * @return mixed
     */
    public function view(Agente $user, Paciente $paciente)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar este paciente.');
    }

    /**
     * Determine whether the user can create pacientes.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar um novo paciente.');
    }

    /**
     * Determine whether the user can update the paciente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Paciente  $paciente
     * @return mixed
     */
    public function update(Agente $user, Paciente $paciente)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar este paciente.');
    }

    /**
     * Determine whether the user can delete the paciente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Paciente  $paciente
     * @return mixed
     */
    public function delete(Agente $user, Paciente $paciente)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir este paciente.');
    }

    /**
     * Determine whether the user can restore the paciente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Paciente  $paciente
     * @return mixed
     */
    public function restore(Agente $user, Paciente $paciente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the paciente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Paciente  $paciente
     * @return mixed
     */
    public function forceDelete(Agente $user, Paciente $paciente)
    {
        //
    }
}
