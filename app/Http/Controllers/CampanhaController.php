<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampanhaController extends Controller
{
    //
    public function list(Request $request, $id = false)
    {
        $campanha = '';

        if ($id !== false) {
            $campanha = \App\Campanha::find($id);
        } else {
            $campanha = \App\Campanha::with('termo')->get();
        }

        if ($request->json === 'true') {

            return $campanha;
        }

        return view('campanha.list')->with('objs', $campanha);
    }

    public function add(Request $request)
    {
        $termo = \App\Termo::all()->reverse();

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('campanha.add')->with(["objs" => $termo, "urlReturn" => $url]);
        }
        return view('campanha.add')->with("objs", $termo);
    }

    public function create(Request $request)
    {

        $dadosCampanha = $request->only(['nome', 'desc', 'atend_domic', 'termo_id']);

        if ($request->has('atend_domic')) {
            $dadosCampanha['atend_domic'] = true;
        } else {
            $dadosCampanha['atend_domic'] = false;
        }

        $campanha = \App\Campanha::create($dadosCampanha);

        if ($request->json === 'true') {
            return $campanha;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }
    }

    public function editForm($id, Request $request)
    {

        $termos = \App\Termo::all();
        $campanhaEdit = \App\Campanha::find($id);
        $campanhaEdit->load('termo')->get();

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('campanha.edit')->with(['obj' => $campanhaEdit, 'objsT' => $termos, 'objT' => $campanhaEdit->termo, "urlReturn" => $url]);
        }

        return view('campanha.edit')->with(['obj' => $campanhaEdit, 'objsT' => $termos, 'objT' => $campanhaEdit->termo]);
    }

    public function edit(Request $request)
    {
        $updatingCampanha = '';
        $dadosCampanha = $request->only(['id', 'nome', 'desc', 'atend_domic', 'termo_id']);
        $campanha = \App\Campanha::find($dadosCampanha['id']);

        if ($request->has('atend_domic')) {
            $dadosCampanha['atend_domic'] = true;
        } else {
            $dadosCampanha['atend_domic'] = false;
        }

        if ($campanha !== null) {
            $updatingCampanha = \App\Campanha::updateOrCreate(['id' => $dadosCampanha['id']], $dadosCampanha);
        } else {
            $updatingCampanha = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingCampanha;
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect(session('links')[2]);
    }

    public function delete(Request $request, $id = false)
    {

        $campanha = '';

        if ($id !== false) {
            $campanha = \App\Campanha::find($id);
        } else {
            $dadosCampanha = $request->only(['id']);
            $campanha = \App\Campanha::find($dadosCampanha['id']);
        }

        if ($campanha !== null) {
            $campanha->delete();
        } else {
            $campanha = 'not found';
        }

        if ($request->json === 'true') {
            return $campanha;
        }

        return redirect()->back();
    }

    /*  public function teste()
    {


        $campanhaResults = \App\Campanha::all()->reject(function ($campanha) {
            $result = $campanha->campanha_end - $campanha->campanha_ini;
            $campanha->result = $result;
            return $result > 50;
        });

        return $campanhaResults;
    } */

    public function addPublico(Request $request)
    {
        $result = '';
        $idcampanha = $request->idcampanha;
        $idpublico = $request->idpublico;

        $campanha = \App\Campanha::find($idcampanha);

        $campanha->load(['publicos.idades' => function ($query) use ($idcampanha, $idpublico) {
            $query->where('campanha_id', '=', $idcampanha);
        }])->get();

        foreach ($campanha->publicos as $obj) {
            if ($obj->id == $idpublico) {
                $result = $obj;
            }
        }

        return $result;
    }
}
