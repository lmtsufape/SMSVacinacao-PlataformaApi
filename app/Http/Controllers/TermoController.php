<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermoController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $termo = \App\Termo::find($id);

            return $termo;
        }

        $termo = \App\Termo::all();

        if ($request->json === 'true') {
            return $termo;
        }

        return view('termo.list')->with('objs', $termo);
    }

    public function add(Request $request)
    {
        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('termo.add')->with('urlReturn', $url);
        }
        return view('termo.add');
    }

    public function create(Request $request)
    {

        $dadosTermo = $request->only(['id', 'nome', 'desc']);

        $termo = \App\Termo::create($dadosTermo);

        if ($request->json === 'true') {
            return $termo;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect(session('links')[3]);
    }

    public function editForm($id)
    {

        $termoEdit = \App\Termo::find($id);

        return view('termo.edit')->with('obj', $termoEdit);
    }

    public function edit(Request $request)
    {
        $updatingTermo = '';
        $dadosTermo = $request->only(['id', 'nome',  'desc']);
        $termo = \App\Termo::find($dadosTermo['id']);

        if ($termo !== null) {
            $updatingTermo = \App\Termo::updateOrCreate(['id' => $dadosTermo['id']], $dadosTermo);
        } else {
            $updatingTermo = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingTermo;
        }

        return redirect(session('links')[3]);
    }

    public function delete(Request $request, $id = false)
    {

        $termo = '';

        if ($id !== false) {
            $termo = \App\Termo::find($id);
        } else {
            $dadosTermo = $request->only(['id']);
            $termo = \App\Termo::find($dadosTermo['id']);
        }

        if ($termo !== null) {
            $termo->delete();
        } else {
            $termo = 'not found';
        }

        if ($request->json === 'true') {
            return $termo;
        }

        return redirect()->action('TermoController@list');
    }
}
