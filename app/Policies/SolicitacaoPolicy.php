<?php

namespace App\Policies;

use App\Agente;
use App\Solicitacao;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SolicitacaoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any solicitacaos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the solicitacao.
     *
     * @param  \App\Agente  $user
     * @param  \App\Solicitacao  $solicitacao
     * @return mixed
     */
    public function view(Agente $user, Solicitacao $solicitacao)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar está solicitação.');
    }

    /**
     * Determine whether the user can create solicitacaos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a criar uma nova solicitação.');
    }

    /**
     * Determine whether the user can update the solicitacao.
     *
     * @param  \App\Agente  $user
     * @param  \App\Solicitacao  $solicitacao
     * @return mixed
     */
    public function update(Agente $user, Solicitacao $solicitacao)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar está solicitação.');
    }

    /**
     * Determine whether the user can delete the solicitacao.
     *
     * @param  \App\Agente  $user
     * @param  \App\Solicitacao  $solicitacao
     * @return mixed
     */
    public function delete(Agente $user, Solicitacao $solicitacao)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir está solicitação.');
    }

    /**
     * Determine whether the user can restore the solicitacao.
     *
     * @param  \App\Agente  $user
     * @param  \App\Solicitacao  $solicitacao
     * @return mixed
     */
    public function restore(Agente $user, Solicitacao $solicitacao)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the solicitacao.
     *
     * @param  \App\Agente  $user
     * @param  \App\Solicitacao  $solicitacao
     * @return mixed
     */
    public function forceDelete(Agente $user, Solicitacao $solicitacao)
    {
        //
    }
}
