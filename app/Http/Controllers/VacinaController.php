<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacinaController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $vacina = \App\Vacina::find($id);

            return $vacina;
        }

        $vacina = \App\Vacina::all();

        if ($request->json === 'true') {

            return $vacina->map(function ($item, $key) {
                $item->publicos = $item->publicos;

                return $item;
            });
        }

        return view('vacina.list')->with('objs', $vacina);
    }

    public function add()
    {
        return view('vacina.add');
    }

    public function create(Request $request)
    {

        $dadosVacina = $request->only(['id', 'termo_id', 'nome',  'desc', 'atend_domic']);
        if ($request->has('atend_domic')) {
            $dadosVacina['atend_domic'] = true;
        } else {
            $dadosVacina['atend_domic'] = false;
        }

        $vacina = \App\Vacina::create($dadosVacina);

        if ($request->json === 'true') {
            return $vacina;
        }

        return redirect()->action('VacinaController@list');
    }

    public function editForm($id)
    {

        $vacinaEdit = \App\Vacina::find($id);

        return view('vacina.edit')->with('obj', $vacinaEdit);
    }

    public function edit(Request $request)
    {
        $updatingVacina = '';
        $dadosVacina = $request->only(['id', 'termo_id', 'nome',  'desc', 'atend_domic']);
        $vacina = \App\Vacina::find($dadosVacina['id']);

        if ($request->has('atend_domic')) {
            $dadosVacina['atend_domic'] = true;
        } else {
            $dadosVacina['atend_domic'] = false;
        }

        if ($vacina !== null) {
            $updatingVacina = \App\Vacina::updateOrCreate(['id' => $dadosVacina['id']], $dadosVacina);
        } else {
            $updatingVacina = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingVacina;
        }

        return redirect()->action('VacinaController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $vacina = '';

        if ($id !== false) {
            $vacina = \App\Vacina::find($id);
        } else {
            $dadosVacina = $request->only(['id']);
            $vacina = \App\Vacina::find($dadosVacina['id']);
        }

        if ($vacina !== null) {
            $vacina->delete();
        } else {
            $vacina = 'not found';
        }

        if ($request->json === 'true') {
            return $vacina;
        }

        return redirect()->action('VacinaController@list');
    }

    public function teste()
    {


        $vacinaResults = \App\Vacina::all()->reject(function ($vacina) {
            $result = $vacina->idade_end - $vacina->idade_ini;
            $vacina->result = $result;
            return $result > 50;
        });

        return $vacinaResults;
    }
}
