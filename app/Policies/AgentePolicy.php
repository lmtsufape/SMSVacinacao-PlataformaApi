<?php

namespace App\Policies;

use App\Agente;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AgentePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any agentes.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function view(Agente $user, Agente $agente)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar este agente.');
    }

    /**
     * Determine whether the user can create agentes.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar um novo agente.');
    }

    /**
     * Determine whether the user can update the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function update(Agente $user, Agente $agente)
    {
        //
        if ($user->id === $agente->id) {
            return true;
        }

        return $user->admin && !$agente->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar este outro agente.');
    }

    /**
     * Determine whether the user can set administrator the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function setAdmin(Agente $user, Agente $agente)
    {
        //

        if ($user->id === $agente->id) {
            return $user->admin;
        }

        return $user->admin && !$agente->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a tornar este agente administrador.');
    }



    /**
     * Determine whether the user can delete the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function delete(Agente $user, Agente $agente)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir este agente.');
    }

    /**
     * Determine whether the user can restore the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function restore(Agente $user, Agente $agente)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the agente.
     *
     * @param  \App\Agente  $user
     * @param  \App\Agente  $agente
     * @return mixed
     */
    public function forceDelete(Agente $user, Agente $agente)
    {
        //
    }
}
