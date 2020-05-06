<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {
        $campanha = '';

        if ($id !== false) {
            $campanha = \App\Campanha::find($id);

            return $campanha;
        }

        if($request->has('mes')){
            if($request->has('excecao') && ($request->excecao === 'true')){
                $campanha = \App\Campanha::whereMonth('data_ini', '!=', $request->mes)->with('idadePublico')->get();
            }else{
                $campanha = \App\Campanha::whereMonth('data_ini', $request->mes)->with('idadePublico')->get();
            }

        }else{
            $campanha = \App\Campanha::with('idadePublico')->get();
        }

        if ($request->json === 'true') {

            /* $result = $campanha->map(function ($item) {
                return $item->with('idadePublico')->get();
            }); */


            return $campanha;
        }

        return view('campanha.list')->with('objs', $campanha);
    }

    public function add()
    {
        return view('campanha.add');
    }

    public function create(Request $request)
    {

        $dadosCampanha = $request->only(['id', 'vacina_id', 'publico_id',  'segmento_id']);

        $campanha = \App\Campanha::create($dadosCampanha);

        if ($request->json === 'true') {
            return $campanha;
        }

        return redirect()->action('CampanhaController@list');
    }

    public function editForm($id)
    {

        $campanhaEdit = \App\Campanha::find($id);

        return view('campanha.edit')->with('obj', $campanhaEdit);
    }

    public function edit(Request $request)
    {
        $updatingCampanha = '';
        $dadosCampanha = $request->only(['id', 'vacina_id', 'publico_id',  'segmento_id']);
        $campanha = \App\Campanha::find($dadosCampanha['id']);

        if ($campanha !== null) {
            $updatingCampanha = \App\Campanha::updateOrCreate(['id' => $dadosCampanha['id']], $dadosCampanha);
        } else {
            $updatingCampanha = 'not found';
        }

        if ($request->json === 'true') {
            return $updatingCampanha;
        }

        return redirect()->action('CampanhaController@list');
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

        return redirect()->action('CampanhaController@list');
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
}
