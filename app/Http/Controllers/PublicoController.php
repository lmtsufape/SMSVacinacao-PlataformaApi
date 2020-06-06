<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicoController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $publico = \App\Publico::find($id);

            return $publico;
        }

        $publico = \App\Publico::all();

        if ($request->json === 'true') {
            return $publico;
        }

        return view('publico.list')->with('objs', $publico);
    }

    public function add(Request $request)
    {
        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('publico.add')->with('urlReturn', $url);
        }

        return view('publico.add');
    }

    public function create(Request $request)
    {

        $dadosPublico = $request->only(['id', 'nome']);

        $publico = \App\Publico::create($dadosPublico);

        if ($request->json === 'true') {
            return $publico;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect()->action('PublicoController@list');
    }

    public function editForm($id)
    {

        $publicoEdit = \App\Publico::find($id);

        return view('publico.edit')->with('obj', $publicoEdit);
    }

    public function edit(Request $request)
    {
        $updatingPublico = '';
        $dadosPublico = $request->only(['id', 'nome']);
        $publico = \App\Publico::find($dadosPublico['id']);

        if ($publico !== null) {
            $updatingPublico = \App\Publico::updateOrCreate(['id' => $dadosPublico['id']], $dadosPublico);
        } else {
            $updatingPublico = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingPublico;
        }

        return redirect()->action('PublicoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $publico = '';

        if ($id !== false) {
            $publico = \App\Publico::find($id);
        } else {
            $dadosPublico = $request->only(['id']);
            $publico = \App\Publico::find($dadosPublico['id']);
        }

        if ($publico !== null) {
            $publico->delete();
        } else {
            $publico = 'not found';
        }

        if ($request->json === 'true') {
            return $publico;
        }

        return redirect()->action('PublicoController@list');
    }
}
