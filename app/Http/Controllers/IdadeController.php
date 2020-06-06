<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdadeController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $idade = \App\Idade::find($id);

            return $idade;
        }

        $idade = \App\Idade::all();

        if ($request->json === 'true') {
            return $idade;
        }

        return view('idade.list')->with('objs', $idade);
    }

    public function add(Request $request)
    {
        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('idade.add')->with('urlReturn', $url);
        }
        return view('idade.add');
    }

    public function create(Request $request)
    {

        $dadosIdade = $request->only(['grupo', 'idade_ini',  'idade_end', 'mes']);

        if ($request->has('mes')) {
            $dadosIdade['mes'] = true;
        } else {
            $dadosIdade['mes'] = false;
        }

        $idade = \App\Idade::create($dadosIdade);

        if ($request->json === 'true') {
            return $idade;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect()->action('IdadeController@list');
    }

    public function editForm($id)
    {

        $idadeEdit = \App\Idade::find($id);

        return view('idade.edit')->with('obj', $idadeEdit);
    }

    public function edit(Request $request)
    {
        $updatingIdade = '';
        $dadosIdade = $request->only(['id', 'grupo', 'idade_ini',  'idade_end', 'mes']);
        $idade = \App\Idade::find($dadosIdade['id']);

        if ($request->has('mes')) {
            $dadosIdade['mes'] = true;
        } else {
            $dadosIdade['mes'] = false;
        }

        if ($idade !== null) {
            $updatingIdade = \App\Idade::updateOrCreate(['id' => $dadosIdade['id']], $dadosIdade);
        } else {
            $updatingIdade = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingIdade;
        }

        return redirect()->action('IdadeController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $idade = '';

        if ($id !== false) {
            $idade = \App\Idade::find($id);
        } else {
            $dadosIdade = $request->only(['id']);
            $idade = \App\Idade::find($dadosIdade['id']);
        }

        if ($idade !== null) {
            $idade->delete();
        } else {
            $idade = 'not found';
        }

        if ($request->json === 'true') {
            return $idade;
        }

        return redirect()->action('IdadeController@list');
    }
}
