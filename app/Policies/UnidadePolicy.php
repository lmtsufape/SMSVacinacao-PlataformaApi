<?php

namespace App\Policies;

use App\Agente;
use App\Unidade;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UnidadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any unidades.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the unidade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Unidade  $unidade
     * @return mixed
     */
    public function view(Agente $user, Unidade $unidade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar está unidade.');
    }

    /**
     * Determine whether the user can create unidades.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar uma nova unidade.');
    }

    /**
     * Determine whether the user can update the unidade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Unidade  $unidade
     * @return mixed
     */
    public function update(Agente $user, Unidade $unidade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar está unidade.');
    }

    /**
     * Determine whether the user can delete the unidade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Unidade  $unidade
     * @return mixed
     */
    public function delete(Agente $user, Unidade $unidade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir está unidade.');
    }

    /**
     * Determine whether the user can restore the unidade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Unidade  $unidade
     * @return mixed
     */
    public function restore(Agente $user, Unidade $unidade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the unidade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Unidade  $unidade
     * @return mixed
     */
    public function forceDelete(Agente $user, Unidade $unidade)
    {
        //
    }
}
