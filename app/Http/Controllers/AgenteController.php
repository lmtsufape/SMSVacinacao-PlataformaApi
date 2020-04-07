<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenteController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $agente = \App\Agente::find($id);

            return $agente;
        }

        $agente = \App\Agente::all();

        if ($request->json === 'true') {
            return $agente;
        }

        return view('agente.list')->with('objs', $agente);
    }

    public function add()
    {
        return view('agente.add');
    }

    public function create(Request $request)
    {

        $dadosAgente = $request->only(['cpf', 'password', 'nome', 'email', 'cidade', 'uf']);
        $agente = \App\Agente::create($dadosAgente);

        if ($request->json === 'true') {
            return $agente;
        }

        return redirect()->action('AgenteController@list');
    }

    public function editForm($id)
    {

        $agenteEdit = \App\Agente::find($id);

        return view('agente.edit')->with('obj', $agenteEdit);
    }

    public function edit(Request $request)
    {

        $updatingAgente = '';
        $dadosAgente = $request->only(['id', 'cpf', 'password', 'nome', 'email', 'cidade', 'uf']);
        $agente = \App\Agente::find($dadosAgente['id']);

        if ($dadosAgente['password'] == NULL) {
            unset($dadosAgente['password']);
        };

        if ($agente !== null) {
            $updatingAgente = \App\Agente::updateOrCreate(['id' => $dadosAgente['id']], $dadosAgente);
        } else {
            $updatingAgente = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingAgente;
        }

        return redirect()->action('AgenteController@list');
    }

    public function delete(Request $request, $id = false)
    {
        $agente = '';

        if ($id !== false) {
            $agente = \App\Agente::find($id);
        } else {
            $dadosAgente = $request->only(['id']);
            $agente = \App\Agente::find($dadosAgente['id']);
        }

        if ($agente !== null) {
            $agente->delete();
        } else {
            $agente = 'not found';
        }

        if ($request->json === 'true') {
            return $agente;
        }

        return redirect()->action('AgenteController@list');
    }
}
