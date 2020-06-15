<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class ApiSolicitacaoController extends Controller
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
        $solicitacao = '';

        if ($id !== false) {
            $solicitacao = \App\Solicitacao::find($id);

            return $solicitacao;
        } else {
            $solicitacao = \App\Solicitacao::with(['paciente', 'agente', 'campanhaidadepublico', 'campanhaidadepublico.campanha', 'campanhaidadepublico.publico', 'campanhaidadepublico.idade'])->get();
        }

        return $solicitacao;
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

        return $solicitacao;
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

        return $updatingSolicitacao;
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
            if ($solicitacao->status === 'Em espera') {
                $solicitacao->delete();
            } else if ($solicitacao->status === 'Aceito') {
                $solicitacao = 'Solicitação aceita por algum agente, não é possível cancelar mais está solicitação!';
                return response($solicitacao, 500)->header('Content-Type', 'text/plain');
            } else if ($solicitacao->status === 'Recusado') {
                $solicitacao = 'Solicitação recusada por algum agente, não é possível cancelar mais está solicitação!';
                return response($solicitacao, 500)->header('Content-Type', 'text/plain');
            } else {
                $solicitacao = 'Ocorreu algum problema, não foi possível cancelar está solicitação';
                return response($solicitacao, 500)->header('Content-Type', 'text/plain');
            }
        } else {
            $solicitacao = 'not found';
        }

        return $solicitacao;
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

        return $solicitacao;
    }

    public function atender(Request $request, $id = false)
    {

        $solicitacao = '';
        $solicitacao = \App\Solicitacao::find($id);

        if ($solicitacao !== null) {
            if (Auth::check()) {
                $agente = Auth::user()->id;
                $solicitacao->agente_id = $agente;
                $solicitacao->status = 'Vacinado';
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

    public function aceitar(Request $request, $id = false)
    {

        $solicitacao = '';
        $solicitacao = \App\Solicitacao::find($id);

        if ($solicitacao !== null) {
            if (Auth::check()) {
                $agente = Auth::user()->id;
                $solicitacao->agente_id = $agente;
                $solicitacao->status = 'Aceito';
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
                $agente = Auth::user()->id;
                $solicitacao->agente_id = $agente;
                $solicitacao->status = 'Recusado';
                $solicitacao->data_time = new DateTime('NOW');
                if ($request->has('desc')) {
                    $solicitacao->recusa_desc = $request->desc;
                }
                $solicitacao->save();
            }
        } else {
            $solicitacao = 'not found';
        }

        return $solicitacao;
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
                [
                    'paciente',
                    'agente',
                    'campanhaidadepublico',
                    'campanhaidadepublico.campanha',
                    'campanhaidadepublico.publico',
                    'campanhaidadepublico.idade',
                ]
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'not found';
        }

        return $solicitacao;
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
                [
                    'campanha',
                    'campanha.vacina',
                    'campanha.publico',
                    'campanha.segmento',
                    'campanha.segmento.idade',
                    'campanha.segmento.idade.grupo',
                    'campanha.segmento.periodo'
                ]
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'not found';
        }

        return $solicitacao;
    }

    public function pacienteSolic(Request $request, $id)
    {

        $solicitacao = '';

        $paciente = \App\Paciente::find($id);


        if ($paciente !== null) {
            $solicitacao = $paciente->solicitacoes()->with(
                [
                    'campanhaIdadePublico',
                    'campanhaIdadePublico.campanha',
                    'campanhaIdadePublico.publico',
                    'campanhaIdadePublico.idade',
                ]
            )->where($request->except('json'))->get();
        } else {
            $solicitacao = 'Paciente não consta em nossos registros';
            return response($solicitacao, 404)->header('Content-Type', 'text/plain');
        }

        return $solicitacao;
    }

    public function createPacienteSolic(Request $request, $id)
    {

        $solicitacao = '';


        $paciente = \App\Paciente::find($id);

        if ($paciente !== null) {
            $parameters = $request->only(['campanha_id', 'publico_id', 'idade_id']);
            $campanhaIdadePublico = \App\CampanhaIdadePublico::where($parameters)->first();
            if ($campanhaIdadePublico !== null) {
                $data = [
                    'campanha_idade_publico_id' => $campanhaIdadePublico->id,
                    'paciente_cns' => $paciente->cns,
                ];
                try {
                    $solicitacao = \App\Solicitacao::create($data);
                } catch (\Illuminate\Database\QueryException $e) {
                    $solicitacao = 'Você já fez uma solicitação como esta';
                    return response($solicitacao, 409)->header('Content-Type', 'text/plain');
                }
            } else {
                $solicitacao = 'Campanha, publico ou idade não encontrados';
                return response($solicitacao, 404)->header('Content-Type', 'text/plain');
            }
        } else {
            $solicitacao = 'Paciente não consta em nossos registros';
            return response($solicitacao, 404)->header('Content-Type', 'text/plain');
        }

        return $solicitacao;
    }
}
