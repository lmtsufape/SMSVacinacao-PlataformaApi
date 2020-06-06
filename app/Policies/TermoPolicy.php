<?php

namespace App\Policies;

use App\Agente;
use App\Termo;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TermoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any termos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the termo.
     *
     * @param  \App\Agente  $user
     * @param  \App\Termo  $termo
     * @return mixed
     */
    public function view(Agente $user, Termo $termo)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar este termo.');
    }

    /**
     * Determine whether the user can create termos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar um novo termo.');
    }

    /**
     * Determine whether the user can update the termo.
     *
     * @param  \App\Agente  $user
     * @param  \App\Termo  $termo
     * @return mixed
     */
    public function update(Agente $user, Termo $termo)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar este termo.');
    }

    /**
     * Determine whether the user can delete the termo.
     *
     * @param  \App\Agente  $user
     * @param  \App\Termo  $termo
     * @return mixed
     */
    public function delete(Agente $user, Termo $termo)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir este termo.');
    }

    /**
     * Determine whether the user can restore the termo.
     *
     * @param  \App\Agente  $user
     * @param  \App\Termo  $termo
     * @return mixed
     */
    public function restore(Agente $user, Termo $termo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the termo.
     *
     * @param  \App\Agente  $user
     * @param  \App\Termo  $termo
     * @return mixed
     */
    public function forceDelete(Agente $user, Termo $termo)
    {
        //
    }
}
