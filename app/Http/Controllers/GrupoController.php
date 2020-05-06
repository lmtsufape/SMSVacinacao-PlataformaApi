<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GrupoController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $grupo = \App\Grupo::find($id);

            return $grupo;
        }

        $grupo = \App\Grupo::all();

        if ($request->json === 'true') {
            return $grupo;
        }

        return view('grupo.list')->with('objs', $grupo);
    }

    public function add()
    {
        return view('grupo.add');
    }

    public function create(Request $request)
    {

        $dadosGrupo = $request->only(['id', 'nome']);

        $grupo = \App\Grupo::create($dadosGrupo);

        if ($request->json === 'true') {
            return $grupo;
        }

        return redirect()->action('GrupoController@list');
    }

    public function editForm($id)
    {

        $grupoEdit = \App\Grupo::find($id);

        return view('grupo.edit')->with('obj', $grupoEdit);
    }

    public function edit(Request $request)
    {
        $updatingGrupo = '';
        $dadosGrupo = $request->only(['id', 'nome']);
        $grupo = \App\Grupo::find($dadosGrupo['id']);

        if ($grupo !== null) {
            $updatingGrupo = \App\Grupo::updateOrCreate(['id' => $dadosGrupo['id']], $dadosGrupo);
        } else {
            $updatingGrupo = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingGrupo;
        }

        return redirect()->action('GrupoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $grupo = '';

        if ($id !== false) {
            $grupo = \App\Grupo::find($id);
        } else {
            $dadosGrupo = $request->only(['id']);
            $grupo = \App\Grupo::find($dadosGrupo['id']);
        }

        if ($grupo !== null) {
            $grupo->delete();
        } else {
            $grupo = 'not found';
        }

        if ($request->json === 'true') {
            return $grupo;
        }

        return redirect()->action('GrupoController@list');
    }
}
