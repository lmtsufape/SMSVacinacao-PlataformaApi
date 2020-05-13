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

            if ($request->has('mes')) {
                $mes =  $request->mes;
                $campanha->load(['publicos.idades' => function ($query) use ($id, $mes) {
                    $query->where('campanha_id', '=', $id)->whereMonth('data_ini', '>=', $mes);
                }])->get();
            } else {
                $campanha->load(['publicos.idades' => function ($query) use ($id) {
                    $query->where('campanha_id', '=', $id);
                }])->get();
            }

            return $campanha;
        }

        if ($request->has('mes')) {
            if ($request->has('excecao') && ($request->excecao === 'true')) {
                $campanha = DB::table('campanhas_idades_publicos')
                    ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
                    ->join('termos', 'termo_id', '=', 'termos.id')
                    ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
                    ->groupBy('campanhas.id', 'termos.id')
                    ->orderBy('data_ini')
                    ->whereMonth('data_ini', '>', $request->mes)
                    ->get();
            } else {
                $campanha = DB::table('campanhas_idades_publicos')
                    ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
                    ->join('termos', 'termo_id', '=', 'termos.id')
                    ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
                    ->groupBy('campanhas.id', 'termos.id')
                    ->orderBy('data_ini')
                    ->whereMonth('data_ini', '<=', $request->mes)
                    ->WhereMonth('data_end', '>=', $request->mes)
                    ->get();
            }
        } else {

            $campanha = DB::table('campanhas_idades_publicos')
                ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
                ->join('termos', 'termo_id', '=', 'termos.id')
                ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
                ->groupBy('campanhas.id', 'termos.id')
                ->orderBy('data_ini')
                ->get();

            /* $campanha = \App\Campanha::with(['publicos.idades' => function ($query) {
                $query->whereColumn('campanha_id', '=', 'campanha_id');
            }])->get(); */

            /* $campanhas = DB::table('campanhas'); */
            /* $campanha = DB::table('termos')
                ->join('campanhas', function ($join) {
                    $join->on('termos.id', '=', 'campanhas.termo_id');
                })->select(DB::raw("termos.nome AS termo_nome, termos.desc AS termo_desc, campanhas.*"))
                ->get(); */
        }

        if ($request->json === 'true') {

            /* $result = $campanha->map(function ($item) {
                return $item->with('idadePublico')->get();
            }); */


            /* return $campanha->groupBy('termo_nome'); */
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
