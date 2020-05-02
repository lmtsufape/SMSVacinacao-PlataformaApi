<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitacaoController extends Controller
{
    //

    public function teste(Request $request, $id = false)
    {

        if ($id !== false) {
            $solicitacao = DB::table('unidades')->find(strval(1));

            return $solicitacao;
        }

        /* $solicitacaos = DB::table('campanhas_pacientes')->get(); */
        /* for ($i = 0; $i < sizeof($solicitacaos); $i++) {
            $paciente = DB::table('pacientes')->find($solicitacaos->get($i)->paciente_cns);
            $agente = DB::table('agentes')->find($solicitacaos->get($i)->agente_id);
            $campanha = DB::table('campanhas')->find($solicitacaos->get($i)->campanha_id);

            $solicitacaos->get($i)->put('paciente', $paciente);
            $solicitacaos->get($i)->put('agente', $agente);
            $solicitacaos->get($i)->put('campanha', $campanha);
        } */


        /* if ($request->json === 'true') {
            return $solicitacaos;
        }

        return view('solicitacao.list')->with('objs', $solicitacao); */

        /* $solicitacaos = DB::table('campanhas_pacientes')->get();
        $map = $solicitacaos->map(function ($item, $key) {
            $agente = DB::table('agentes')->where('id', $item->agente_id)->get();
            $item->agente = $agente->first();
            $paciente = DB::table('pacientes')->where('cns', $item->paciente_cns)->get();
            $item->paciente = $paciente->first();
            $campanha = DB::table('campanhas')->where('id', $item->campanha_id)->get();
            $item->campanha = $campanha->first();
            return $item;
        });

        return $map; */

        $result = \App\Paciente::all();

        return $result[0]->campanhas;
    }

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $solicitacao = \App\Solicitacao::find($id);

            return $solicitacao;
        }

        $solicitacao = \App\Solicitacao::all();

        if ($request->json === 'true') {
            return $solicitacao;
        }

        return view('solicitacao.list')->with('objs', $solicitacao);
    }

    public function add()
    {
        return view('solicitacao.add');
    }

    public function create(Request $request)
    {

        $dadosSolicitacao = $request->only(['id', 'campanha_id', 'paciente_cns', 'agente_id', 'status', 'recusa_desc', 'data_time']);

        if ($request->has(['agente_id', 'recusa_desc', 'data_time'])) {
        } else {
        }

        $solicitacao = \App\Solicitacao::create($dadosSolicitacao);

        if ($request->json === 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function editForm($id)
    {

        $solicitacaoEdit = \App\Solicitacao::find($id);

        return view('solicitacao.edit')->with('obj', $solicitacaoEdit);
    }

    public function edit(Request $request)
    {
        $updatingSolicitacao = '';
        $dadosSolicitacao = $request->only(['id', 'campanha_id', 'paciente_cns', 'agente_id', 'status', 'recusa_desc', 'data_time']);
        $solicitacao = \App\Solicitacao::find($dadosSolicitacao['id']);

        if ($solicitacao !== null) {
            $updatingSolicitacao = \App\Solicitacao::updateOrCreate(['id' => $dadosSolicitacao['id']], $dadosSolicitacao);
        } else {
            $updatingSolicitacao = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingSolicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $solicitacao = '';

        if ($id !== false) {
            $solicitacao = \App\Solicitacao::find($id);
        } else {
            $dadosSolicitacao = $request->only(['id']);
            $solicitacao = \App\Solicitacao::find($dadosSolicitacao['id']);
        }

        if ($solicitacao !== null) {
            $solicitacao->delete();
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json === 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function getStatus(Request $request, $id)
    {

        $solicitacao = '';

        $solicitacao = \App\Solicitacao::find($id);

        if ($solicitacao !== null) {
            $solicitacao = $solicitacao->status;
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            return $solicitacao;
        }

        return $solicitacao;
    }

    public function atender(Request $request, $id = false)
    {

        $solicitacao = '';
        $solicitacao = \App\Solicitacao::find($id);

        if ($solicitacao !== null) {
            if (Auth::check()) {
                $agente = Auth::user();
                $solicitacao->agente_id = $agente->id;
                $solicitacao->status = 'vacinado';
                $solicitacao->data_time = new DateTime('NOW');
                $solicitacao->save();
            }
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            if (Auth::check()) {
                return 'ok';
            } else {
                return 'fail';
            }
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function recusar(Request $request, $id = false)
    {

        $solicitacao = '';
        $solicitacao = \App\Solicitacao::find($id);

        if ($solicitacao !== null) {
            if (Auth::check()) {
                $agente = Auth::user();
                $solicitacao->agente_id = $agente->id;
                $solicitacao->status = 'recusado';
                $solicitacao->data_time = new DateTime('NOW');
                $solicitacao->save();
            }
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function agenteSolicAtrib(Request $request, $id = false)
    {

        $solicitacao = '';
        $agente = '';

        if ($id !== false) {
            $agente = \App\Agente::find($id);
        } else {
            if (Auth::check()) {
                $agente = Auth::user();
            }
        }

        if ($agente !== null) {
            $solicitacao = $agente->solicitacoesAtribuidas()->with(
                'campanha',
                'campanha.vacina',
                'campanha.publico',
                'campanha.segmento',
                'campanha.segmento.idade',
                'campanha.segmento.idade.grupo',
                'campanha.segmento.periodo'
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function agenteSolicDeleg(Request $request, $id = false)
    {

        $solicitacao = '';
        $agente = '';

        if ($id !== false) {
            $agente = \App\Agente::find($id);
        } else {
            if (Auth::check()) {
                $agente = Auth::user();
            }
        }

        if ($agente !== null) {
            $solicitacao = $agente->solicitacoesDelegadas()->with(
                'campanha',
                'campanha.vacina',
                'campanha.publico',
                'campanha.segmento',
                'campanha.segmento.idade',
                'campanha.segmento.idade.grupo',
                'campanha.segmento.periodo'
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }

    public function pacienteSolic(Request $request, $id)
    {

        $solicitacao = '';

        $paciente = \App\Paciente::find($id);


        if ($paciente !== null) {
            $solicitacao = $paciente->solicitacoes()->with(
                'campanha',
                'campanha.vacina',
                'campanha.publico',
                'campanha.segmento',
                'campanha.segmento.idade',
                'campanha.segmento.idade.grupo',
                'campanha.segmento.periodo'
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'not found';
        }

        if ($request->json == 'true') {
            return $solicitacao;
        }

        return redirect()->action('SolicitacaoController@list');
    }
}
