<?php

namespace App\Policies;

use App\Agente;
use App\CampanhaIdadePublico;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CampanhaIdadePublicoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any campanha idade publicos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function viewAny(Agente $user)
    {
        //
    }

    /**
     * Determine whether the user can view the campanha idade publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\CampanhaIdadePublico  $campanhaIdadePublico
     * @return mixed
     */
    public function view(Agente $user, CampanhaIdadePublico $campanhaIdadePublico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a visualizar está segmentação.');
    }

    /**
     * Determine whether the user can create campanha idade publicos.
     *
     * @param  \App\Agente  $user
     * @return mixed
     */
    public function create(Agente $user)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a  criar uma nova segmentação.');
    }

    /**
     * Determine whether the user can update the campanha idade publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\CampanhaIdadePublico  $campanhaIdadePublico
     * @return mixed
     */
    public function update(Agente $user, CampanhaIdadePublico $campanhaIdadePublico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a editar está segmentação.');
    }

    /**
     * Determine whether the user can delete the campanha idade publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\CampanhaIdadePublico  $campanhaIdadePublico
     * @return mixed
     */
    public function delete(Agente $user, CampanhaIdadePublico $campanhaIdadePublico)
    {
        //
        return $user->admin
            ? Response::allow()
            : Response::deny('Você não está autorizado a excluir está segmentação.');
    }

    /**
     * Determine whether the user can restore the campanha idade publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\CampanhaIdadePublico  $campanhaIdadePublico
     * @return mixed
     */
    public function restore(Agente $user, CampanhaIdadePublico $campanhaIdadePublico)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the campanha idade publico.
     *
     * @param  \App\Agente  $user
     * @param  \App\CampanhaIdadePublico  $campanhaIdadePublico
     * @return mixed
     */
    public function forceDelete(Agente $user, CampanhaIdadePublico $campanhaIdadePublico)
    {
        //
    }
}
