<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiPacienteController extends Controller
{
    //

    public function list(Request $request, $cns = false)
    {

        if ($cns !== false) {
            $paciente = \App\Paciente::find($cns);

            return $paciente;
        }

        $paciente = \App\Paciente::all();

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

        if ($request->json === 'true') {
            return $paciente;
        }

        return redirect()->action('PacienteController@list');
    }

    public function editForm($cns)
    {

        $pacienteEdit = \App\Paciente::find($cns);

        return view('paciente.edit')->with('obj', $pacienteEdit);
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

        if ($request->json === 'true') {
            return $updatingPaciente;
        }

        return redirect()->action('PacienteController@list');
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

        if ($request->json === 'true') {
            return $paciente;
        }

        return redirect()->action('PacienteController@list');
    }
}
