<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class ApiUnidadeController extends Controller
{
    //

    public function list(Request $request, $id = false)
    {

        if ($id !== false) {
            $unidade = \App\Unidade::find($id);

            return $unidade;
        }

        $unidade = \App\Unidade::all();


        return $unidade;
    }

    public function add()
    {
        return view('unidade.add');
    }

    public function create(Request $request)
    {

        $dadosUnidade = $request->only(['id', 'nome',  'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'complemento', 'lat', 'lng']);
        $unidade = \App\Unidade::create($dadosUnidade);

        if ($request->json === 'true') {
            return $unidade;
        }

        return redirect()->action('UnidadeController@list');
    }


    public function editForm($id)
    {

        $unidadeEdit = \App\Unidade::find($id);

        return view('unidade.edit')->with('und', $unidadeEdit);
    }


    public function edit(Request $request)
    {
        $updatingUnidade = '';
        $dadosUnidade = $request->only(['id', 'nome',  'rua', 'num', 'bairro', 'cidade', 'uf', 'cep', 'complemento', 'lat', 'lng']);
        $unidade = \App\Unidade::find($dadosUnidade['id']);

        if ($unidade !== null) {
            $updatingUnidade = \App\Unidade::updateOrCreate(['id' => $dadosUnidade['id']], $dadosUnidade);
        } else {
            $updatingUnidade = 'not found';
        }


        if ($request->json === 'true') {
            return $updatingUnidade;
        }

        return redirect()->action('UnidadeController@list');
    }

    public function delete(Request $request, $id = false)
    {

        $unidade = '';

        if ($id !== false) {
            $unidade = \App\Unidade::find($id);
        } else {
            $dadosUnidade = $request->only(['id']);
            $unidade = \App\Unidade::find($dadosUnidade['id']);
        }

        if ($unidade !== null) {
            $unidade->delete();
        } else {
            $unidade = 'not found';
        }


        if ($request->json === 'true') {
            return $unidade;
        }

        return redirect()->action('UnidadeController@list');
    }

    public function near(Request $request)
    {

        $lat = floatval($request->lat);
        $lng = floatval($request->lng);
        $distance = floatval($request->distance);

        $result = DB::table(function ($query) use ($lat, $lng) {
            $query->select('*', DB::raw('round(CAST(float8 (6371 * acos(cos(radians(' . floatval($lat) . ')) * cos(radians(lat)) * cos(radians(lng) - radians(' . floatval($lng) . ')) + sin(radians(' . floatval($lat) . ')) * sin(radians(lat)))) as numeric), 3) AS distance'))
                ->from('unidades')
                ->orderBy('distance')
                ->limit(10);
        }, 'unidades')
            ->where('distance', '<', $distance)
            ->get();

        return $result;
    }
}
