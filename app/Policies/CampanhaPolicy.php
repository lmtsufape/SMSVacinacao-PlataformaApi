<?php

namespace App\Policies;

use App\Agente;
use App\Campanha;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CampanhaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any campanhas.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the campanha.
     *
     * @param  \App\Agente  $user
     * @param  \App\Campanha  $campanha
     * @return mixed
     */
    public function view(Agente $user, Campanha $campanha)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar está campanha.');
    }

    /**
     * Determine whether the user can create campanhas.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar uma nova campanha.');
    }

    /**
     * Determine whether the user can update the campanha.
     *
     * @param  \App\Agente  $user
     * @param  \App\Campanha  $campanha
     * @return mixed
     */
    public function update(Agente $user, Campanha $campanha)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a atualizar está campanha.');
    }

    /**
     * Determine whether the user can delete the campanha.
     *
     * @param  \App\Agente  $user
     * @param  \App\Campanha  $campanha
     * @return mixed
     */
    public function delete(Agente $user, Campanha $campanha)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir está campanha.');
    }

    /**
     * Determine whether the user can restore the campanha.
     *
     * @param  \App\Agente  $user
     * @param  \App\Campanha  $campanha
     * @return mixed
     */
    public function restore(Agente $user, Campanha $campanha)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the campanha.
     *
     * @param  \App\Agente  $user
     * @param  \App\Campanha  $campanha
     * @return mixed
     */
    public function forceDelete(Agente $user, Campanha $campanha)
    {
        //
    }
}
