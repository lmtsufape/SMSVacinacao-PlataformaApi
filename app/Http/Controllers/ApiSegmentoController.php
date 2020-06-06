<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSegmentoController extends Controller
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
        } else if ($request->has('mes')) {
            if ($request->has('excecao') && ($request->excecao === 'true')) {
                $campanha = DB::table('campanhas_idades_publicos')
                    ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
                    ->join('termos', 'termo_id', '=', 'termos.id')
                    ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
                    ->groupBy('campanhas.id', 'termos.id')
                    ->orderBy('data_ini')
                    ->whereYear('data_ini', '=', date('Y'))
                    ->whereMonth('data_ini', '>', $request->mes)
                    ->get();
            } else {
                $campanha = DB::table('campanhas_idades_publicos')
                    ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
                    ->join('termos', 'termo_id', '=', 'termos.id')
                    ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
                    ->groupBy('campanhas.id', 'termos.id')
                    ->orderBy('data_ini')
                    ->whereYear('data_ini', '=', date('Y'))
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

        return $campanha;
    }


    public function listTest(Request $request, $id = false)
    {
        $obj = '';
        $queryRcv = new Request($request->query());

        if ($id) {

            $obj = \App\CampanhaIdadePublico::find($id);

            $obj->load(['campanha', 'publico', 'idade'])->get();
        } else if ($queryRcv->has(['campanha_id', 'publico_id', 'idade_id'])) {

            $query = $queryRcv->only(['campanha_id', 'publico_id', 'idade_id', 'data_ini', 'data_end']);

            $obj = \App\CampanhaIdadePublico::where($query)->get();
        } else if ($queryRcv->has(['campanha_id', 'publico_id'])) {

            $query = $queryRcv->only(['campanha_id', 'publico_id']);

            $obj = \App\CampanhaIdadePublico::where($query)
                ->join('idades', 'idade_id', '=', 'idades.id')
                ->select('idades.*')
                ->distinct('idades.id')
                ->get();
        } else if ($queryRcv->has(['campanha_id'])) {

            $query = $queryRcv->only(['campanha_id']);

            $obj = \App\CampanhaIdadePublico::where($query)
                ->join('publicos', 'publico_id', '=', 'publicos.id')
                ->select('publicos.*')
                ->distinct('publicos.id')
                ->get();
        } else {

            $obj = \App\CampanhaIdadePublico::with(['campanha', 'publico', 'idade'])->get();
        }

        return  $obj;
    }

    public function updateTest(Request $request, $id = false)
    {
        $obj = '';

        if ($id) {
            $data = $request->only(['campanha_id', 'publico_id', 'idade_id', 'data_ini', 'data_end']);
            $obj = \App\CampanhaIdadePublico::find($id)->update($data);
        } else {
            $queryRcv = new Request($request->query());
            $query = $queryRcv->only(['campanha_id', 'publico_id', 'idade_id']);
            $data = $request->only(['campanha_id', 'publico_id', 'idade_id', 'data_ini', 'data_end']);
            $obj = \App\CampanhaIdadePublico::where($query)->update($data);
        }

        return  $obj;
    }

    public function deleteTest(Request $request, $id = false)
    {
        $obj = '';
        $queryRcv = new Request($request->query());

        if ($id) {
            $obj = \App\CampanhaIdadePublico::find($id)->delete();
        } else {
            $query = $queryRcv->only(['campanha_id', 'publico_id', 'idade_id']);
            $obj = \App\CampanhaIdadePublico::where($query)->delete();
        }

        return  $obj;
    }

    public function add()
    {
        $campanha = DB::table('campanhas_idades_publicos')
            ->join('campanhas', 'campanha_id', '=', 'campanhas.id')
            ->join('termos', 'termo_id', '=', 'termos.id')
            ->select(DB::raw('MIN(campanhas_idades_publicos.data_ini) as data_ini, MAX(campanhas_idades_publicos.data_end) as data_end, campanhas.*, termos.nome AS termo_nome, termos.desc AS termo_desc'))
            ->groupBy('campanhas.id', 'termos.id')
            ->orderBy('data_ini')
            ->get();
        return $campanha;
    }



    public function addCampanha()
    {
        $campanha = \App\Campanha::all();

        return $campanha;
    }

    public function create(Request $request)
    {

        $dadosCampanha = $request->only(['id', 'vacina_id', 'publico_id',  'segmento_id']);

        $campanha = \App\Campanha::create($dadosCampanha);

        return $campanha;
    }

    public function editForm($id)
    {

        $segmentoEdit = \App\CampanhaIdadePublico::find($id);

        return $segmentoEdit;
    }

    public function edit(Request $request)
    {
        $updatingSegmento = '';
        $dadosSegmento = $request->only(['id', 'idade_id', 'periodo_id']);
        $segmento = \App\CampanhaIdadePublico::find($dadosSegmento['id']);

        if ($segmento !== null) {
            $updatingSegmento = \App\CampanhaIdadePublico::updateOrCreate(['id' => $dadosSegmento['id']], $dadosSegmento);
        } else {
            $updatingSegmento = 'not found';
        }

        return $updatingSegmento;
    }

    public function delete(Request $request, $id = false)
    {

        $segmento = '';

        if ($id !== false) {
            $segmento = \App\CampanhaIdadePublico::find($id);
        } else {
            $dadosSegmento = $request->only(['id']);
            $segmento = \App\CampanhaIdadePublico::find($dadosSegmento['id']);
        }

        if ($segmento !== null) {
            $segmento->delete();
        } else {
            $segmento = 'not found';
        }

        return $segmento;
    }
}
