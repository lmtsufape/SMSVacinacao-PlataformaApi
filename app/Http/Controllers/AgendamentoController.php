<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $agendamento = \App\Agendamento::find($id);

            return $agendamento;
        }

        $agendamento = \App\Agendamento::all();

        if ($request->json === 'true') {
            return $agendamento;
        }

        return view('agendamento.list')->with('objs', $agendamento);
    }

    public function add()
    {
        return view('agendamento.add');
    }

    public function create(Request $request)
    {

        $dadosAgendamento = $request->only(['id', 'solicitacao_id', 'agente_id', 'chiefAgent_id']);

        $agendamento = \App\Agendamento::create($dadosAgendamento);

        if ($request->json === 'true') {
            return $agendamento;
        }

        return redirect()->action('AgendamentoController@list');
    }

    public function editForm($id)
    {

        $agendamentoEdit = \App\Agendamento::find($id);

        return view('agendamento.edit')->with('obj', $agendamentoEdit);
    }

    public function edit(Request $request)
    {
        $updatingAgendamento = '';
        $dadosAgendamento = $request->only(['id', 'solicitacao_id', 'agente_id', 'chiefAgent_id']);
        $agendamento = \App\Agendamento::find($dadosAgendamento['id']);

        if ($agendamento !== null) {
            $updatingAgendamento = \App\Agendamento::updateOrCreate(['id' => $dadosAgendamento['id']], $dadosAgendamento);
        } else {
            $updatingAgendamento = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingAgendamento;
        }

        return redirect()->action('AgendamentoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $agendamento = '';

        if ($id !== false) {
            $agendamento = \App\Agendamento::find($id);
        } else {
            $dadosAgendamento = $request->only(['id']);
            $agendamento = \App\Agendamento::find($dadosAgendamento['id']);
        }

        if ($agendamento !== null) {
            $agendamento->delete();
        } else {
            $agendamento = 'not found';
        }

        if ($request->json === 'true') {
            return $agendamento;
        }

        return redirect()->action('AgendamentoController@list');
    }
}
