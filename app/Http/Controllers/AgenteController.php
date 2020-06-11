<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;

class AgenteController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $agente = \App\Agente::find($id);
            return $agente;
        } else {
            $agente = \App\Agente::all()->where('id', '!=', Auth::user()->id);
        }

        if ($request->json === 'true') {
            return $agente;
        }

        return view('agente.list')->with('objs', $agente);
    }

    public function add()
    {
        return view('agente.add');
    }

    public function create(Request $request)
    {


        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns',
            'cpf' => 'required|string|unique:agentes|cpf',
            'cidade' => 'required|string',
            'uf' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $dadosAgente = $request->only(['id', 'cpf', 'password', 'nome', 'email', 'cidade', 'uf', 'admin']);

        if ($request->has('admin')) {
            if ($request->admin) {
                $dadosAgente['admin'] = true;
            } else {
                $dadosAgente['admin'] = false;
            }
        }


        $dadosAgente['password'] = Hash::make($dadosAgente['password']);

        $agente = \App\Agente::create($dadosAgente);

        if ($request->json === 'true') {
            return $agente;
        }

        return redirect()->action('AgenteController@list');
    }

    public function editForm($id, Request $request)
    {

        $agenteEdit = \App\Agente::find($id);

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('agente.edit')->with(['obj' => $agenteEdit, 'urlReturn' => $url]);
        }

        return view('agente.edit')->with(['obj' => $agenteEdit, 'urlReturn' => URL::full()]);
    }

    public function edit(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email:rfc,dns',
            'cidade' => 'required|string',
            'uf' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $updatingAgente = '';
        $dadosAgente = $request->only(['id', 'cpf', 'password', 'nome', 'email', 'cidade', 'uf', 'admin']);
        $agente = \App\Agente::find($dadosAgente['id']);

        if ($dadosAgente['password'] == NULL) {
            unset($dadosAgente['password']);
        };


        if ($request->has('admin')) {
            $dadosAgente['admin'] = true;
        } else {
            $dadosAgente['admin'] = false;
        }


        $dadosAgente['password'] = Hash::make($dadosAgente['password']);

        if ($agente !== null) {
            $updatingAgente = \App\Agente::updateOrCreate(['id' => $dadosAgente['id']], $dadosAgente);
        } else {
            $updatingAgente = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingAgente;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect()->action('AgenteController@list');
    }

    public function delete(Request $request, $id = false)
    {
        $agente = '';

        if ($id !== false) {
            $agente = \App\Agente::find($id);
        } else {
            $dadosAgente = $request->only(['id']);
            $agente = \App\Agente::find($dadosAgente['id']);
        }

        if ($agente !== null) {
            $agente->delete();
        } else {
            $agente = 'not found';
        }

        if ($request->json === 'true') {
            return $agente;
        }

        return redirect()->action('AgenteController@list');
    }

    public function setAdmin($id)
    {
        $agente = \App\Agente::find($id);
        $agente->admin = true;
        $agente->save();

        return redirect()->action('AgenteController@list');
    }


    /* public function teste(Request $request)
    {
        $agente = \App\Agente::find(1);

        return $agente->pacientesAtendidos;
    }

    public function teste(Request $request)
    {
        $agente = \App\Agente::find(1);

        return $agente->pacientesRecusados;
    }

    public function teste(Request $request)
    {
        $agente = \App\Agente::find(2);

        return $agente->solicitacoesAtribuidas;
    }

    public function teste(Request $request)
    {
        $agente = \App\Agente::find(2);

        return $agente->solicitacoesDelegadas;
    } */

    public function teste(Request $request)
    {
        /* $agente = \App\Agente::with(['solicitacoesAtribuidas', 'solicitacoesAtribuidas.campanha'])->get(); */
        $agente = \App\Agente::find(2);


        /* return $agente->with(['solicitacoesAtribuidas', 'solicitacoesAtribuidas.campanha'])->get(); */
        return $agente->solicitacoesAtribuidas()->with(
            [
                'campanha',
                'campanha.vacina',
                'campanha.publico',
                'campanha.segmento',
                'campanha.segmento.idade',
                'campanha.segmento.idade.grupo',
                'campanha.segmento.periodo'
            ]
        )->get();
    }
}
