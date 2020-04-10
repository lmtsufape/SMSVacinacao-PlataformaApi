<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    //

    public function list(Request $request, $id = false)
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
    }
}
