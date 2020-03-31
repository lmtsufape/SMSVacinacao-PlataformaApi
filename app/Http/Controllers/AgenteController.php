<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgenteController extends Controller
{
    //

    public function list(Request $request, $cpf = false){
       
        if($cpf !== false){
            $agente = \App\Agente::find($cpf);

            return $agente; 
        }

        $agente = \App\Agente::all();

        return $agente; 
        
    }

    public function create(Request $request){

        $dadosAgente = $request->only(['cpf', 'senha', 'nome', 'cidade', 'uf']);
        $agente = \App\Agente::create($dadosAgente);
        
        return $dadosAgente; 
    }

    public function edit(Request $request){

        $dadosAgente = $request->only(['cpf', 'senha', 'nome', 'cidade', 'uf']);
        $agente = \App\Agente::find($dadosAgente['cpf']);

        if($agente !== null){
            $updatingAgente = \App\Agente::updateOrCreate(['cpf' => $dadosAgente['cpf']], $dadosAgente);
            return $updatingAgente;
        }

        return 'not found';
    }

    public function delete(Request $request, $cpf = false){
        $agente = '';
        
        if($cpf !== false){
            $agente = \App\Agente::find($cpf);
        }else{
            $dadosAgente = $request->only(['cpf']);
            $agente = \App\Agente::find($dadosAgente['cpf']);
        }
        
        if($agente !== null){
            $agente->delete();
            return 'success';
        }

        return 'not found';
        
    }
}
