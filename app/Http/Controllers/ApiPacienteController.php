<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiPacienteController extends Controller
{
    //

    public function list(Request $request, $cns = false)
    {
        $paciente = '';
        if ($cns !== false) {
            $paciente = \App\Paciente::find($cns);
            if ($paciente === null) {
                $paciente = 'Paciente não consta em nossos registros';
                return response($paciente, 404)->header('Content-Type', 'text/plain');
            }
        } else {
            $paciente = \App\Paciente::all();
        }

        return $paciente;
    }

    public function add()
    {
        return view('paciente.add');
    }

    public function create(Request $request)
    {

        $dadosPaciente = $request->only(['cns', 'nome', 'nasc', 'tel', 'rua', 'num', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lng']);
        $paciente = \App\Paciente::create($dadosPaciente);

        return $paciente;
    }

    public function editForm($cns)
    {

        $pacienteEdit = \App\Paciente::find($cns);

        return $pacienteEdit;
    }

    public function edit(Request $request)
    {
        $updatingPaciente = '';
        $dadosPaciente = $request->only(['cns', 'nome', 'nasc', 'tel', 'rua', 'num', 'complemento', 'bairro', 'cidade', 'uf', 'cep', 'lat', 'lng']);
        $paciente = \App\Paciente::find($dadosPaciente['cns']);

        if ($paciente !== null) {
            $updatingPaciente = \App\Paciente::updateOrCreate(['cns' => $dadosPaciente['cns']], $dadosPaciente);
        } else {
            $updatingPaciente = 'not found';
        }

        return $updatingPaciente;
    }

    public function delete(Request $request, $cns = false)
    {
        $paciente = '';

        if ($cns !== false) {
            $paciente = \App\Paciente::find($cns);
        } else {
            $dadosPaciente = $request->only(['cns']);
            $paciente = \App\Paciente::find($dadosPaciente['cns']);
        }

        if ($paciente !== null) {
            $paciente->delete();
        } else {
            $paciente = 'not found';
        }

        return $paciente;
    }
}
