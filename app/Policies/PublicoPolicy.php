<?php

namespace App\Policies;

use App\Agente;
use App\Publico;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PublicoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any publicos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\Publico  $publico
     * @return mixed
     */
    public function view(Agente $user, Publico $publico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar este publico.');
    }

    /**
     * Determine whether the user can create publicos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar um novo publico.');
    }

    /**
     * Determine whether the user can update the publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\Publico  $publico
     * @return mixed
     */
    public function update(Agente $user, Publico $publico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar este publico.');
    }

    /**
     * Determine whether the user can delete the publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\Publico  $publico
     * @return mixed
     */
    public function delete(Agente $user, Publico $publico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir este publico.');
    }

    /**
     * Determine whether the user can restore the publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\Publico  $publico
     * @return mixed
     */
    public function restore(Agente $user, Publico $publico)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\Publico  $publico
     * @return mixed
     */
    public function forceDelete(Agente $user, Publico $publico)
    {
        //
    }
}
