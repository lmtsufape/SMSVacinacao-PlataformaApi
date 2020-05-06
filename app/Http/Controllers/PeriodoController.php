<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $periodo = \App\Periodo::find($id);

            return $periodo;
        }

        $periodo = \App\Periodo::all();

        if ($request->json === 'true') {
            return $periodo;
        }

        return view('periodo.list')->with('objs', $periodo);
    }

    public function add()
    {
        return view('periodo.add');
    }

    public function create(Request $request)
    {

        $dadosPeriodo = $request->only(['id', 'data_ini',  'data_end']);

        $periodo = \App\Periodo::create($dadosPeriodo);

        if ($request->json === 'true') {
            return $periodo;
        }

        return redirect()->action('PeriodoController@list');
    }

    public function editForm($id)
    {

        $periodoEdit = \App\Periodo::find($id);

        return view('periodo.edit')->with('obj', $periodoEdit);
    }

    public function edit(Request $request)
    {
        $updatingPeriodo = '';
        $dadosPeriodo = $request->only(['id', 'data_ini',  'data_end']);
        $periodo = \App\Periodo::find($dadosPeriodo['id']);

        if ($periodo !== null) {
            $updatingPeriodo = \App\Periodo::updateOrCreate(['id' => $dadosPeriodo['id']], $dadosPeriodo);
        } else {
            $updatingPeriodo = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingPeriodo;
        }

        return redirect()->action('PeriodoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $periodo = '';

        if ($id !== false) {
            $periodo = \App\Periodo::find($id);
        } else {
            $dadosPeriodo = $request->only(['id']);
            $periodo = \App\Periodo::find($dadosPeriodo['id']);
        }

        if ($periodo !== null) {
            $periodo->delete();
        } else {
            $periodo = 'not found';
        }

        if ($request->json === 'true') {
            return $periodo;
        }

        return redirect()->action('PeriodoController@list');
    }
}
