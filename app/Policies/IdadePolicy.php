<?php

namespace App\Policies;

use App\Agente;
use App\Idade;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class IdadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any idades.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the idade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Idade  $idade
     * @return mixed
     */
    public function view(Agente $user, Idade $idade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar está faixa etária de idade.');
    }

    /**
     * Determine whether the user can create idades.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar uma nova faixa etária de idade.');
    }

    /**
     * Determine whether the user can update the idade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Idade  $idade
     * @return mixed
     */
    public function update(Agente $user, Idade $idade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar está faixa etária de idade.');
    }

    /**
     * Determine whether the user can delete the idade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Idade  $idade
     * @return mixed
     */
    public function delete(Agente $user, Idade $idade)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir está faixa etária de idade.');
    }

    /**
     * Determine whether the user can restore the idade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Idade  $idade
     * @return mixed
     */
    public function restore(Agente $user, Idade $idade)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the idade.
     *
     * @param  \App\Agente  $user
     * @param  \App\Idade  $idade
     * @return mixed
     */
    public function forceDelete(Agente $user, Idade $idade)
    {
        //
    }
}
