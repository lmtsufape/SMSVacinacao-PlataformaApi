<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SegmentoController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $segmento = \App\Segmento::find($id);

            return $segmento;
        }

        $segmento = \App\Segmento::all();

        if ($request->json === 'true') {
            return $segmento;
        }

        return view('segmento.list')->with('objs', $segmento);
    }

    public function add()
    {
        return view('segmento.add');
    }

    public function create(Request $request)
    {

        $dadosSegmento = $request->only(['id', 'idade_id', 'periodo_id']);

        $segmento = \App\Segmento::create($dadosSegmento);

        if ($request->json === 'true') {
            return $segmento;
        }

        return redirect()->action('SegmentoController@list');
    }

    public function editForm($id)
    {

        $segmentoEdit = \App\Segmento::find($id);

        return view('segmento.edit')->with('obj', $segmentoEdit);
    }

    public function edit(Request $request)
    {
        $updatingSegmento = '';
        $dadosSegmento = $request->only(['id', 'idade_id', 'periodo_id']);
        $segmento = \App\Segmento::find($dadosSegmento['id']);

        if ($segmento !== null) {
            $updatingSegmento = \App\Segmento::updateOrCreate(['id' => $dadosSegmento['id']], $dadosSegmento);
        } else {
            $updatingSegmento = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingSegmento;
        }

        return redirect()->action('SegmentoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $segmento = '';

        if ($id !== false) {
            $segmento = \App\Segmento::find($id);
        } else {
            $dadosSegmento = $request->only(['id']);
            $segmento = \App\Segmento::find($dadosSegmento['id']);
        }

        if ($segmento !== null) {
            $segmento->delete();
        } else {
            $segmento = 'not found';
        }

        if ($request->json === 'true') {
            return $segmento;
        }

        return redirect()->action('SegmentoController@list');
    }
}
