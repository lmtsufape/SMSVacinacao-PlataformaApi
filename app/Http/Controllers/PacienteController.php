<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    //

    public function list(Request $request, $cns = false){
       
        if($cns !== false){
            $paciente = \App\Paciente::find($cns);

            return $paciente; 
        }

        $paciente = \App\Paciente::all();

        return $paciente; 
        
    }

    public function create(Request $request){

        $dadosPaciente = $request->only(['cns', 'nome', 'nasc', 'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lon']);
        $paciente = \App\Paciente::create($dadosPaciente);
        
        return $dadosPaciente; 
    }

    public function edit(Request $request){

        $dadosPaciente = $request->only(['cns', 'nome', 'nasc', 'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lon']);
        $paciente = \App\Paciente::find($dadosPaciente['cns']);

        if($paciente !== null){
            $updatingPaciente = \App\Paciente::updateOrCreate(['cns' => $dadosPaciente['cns']], $dadosPaciente);
            return $updatingPaciente;
        }

        return 'not found';
    }

    public function delete(Request $request, $cns = false){
        $paciente = '';
        
        if($cns !== false){
            $paciente = \App\Paciente::find($cns);
        }else{
            $dadosPaciente = $request->only(['cns']);
            $paciente = \App\Paciente::find($dadosPaciente['cns']);
        }
        
        if($paciente !== null){
            $paciente->delete();
            return 'success';
        }

        return 'not found';
        
    }
        
        
        
}
