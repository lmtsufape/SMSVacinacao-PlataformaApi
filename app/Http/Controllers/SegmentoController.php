<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SegmentoController extends Controller
{
    //
    public function list(Request $request, $id = false)
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

    public function addCampanha(Request $request)
    {

        $campanha = \App\Campanha::all()->reverse();

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('segmento.addCampanha')->with(['objs' => $campanha, 'urlReturn' => $url]);
        }

        return view('segmento.addCampanha')->with('objs', $campanha);
    }

    public function addPublico($campanha_id, Request $request)
    {
        $campanha = \App\Campanha::find($campanha_id);
        $publico = \App\Publico::all()->reverse();

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('segmento.addPublico')->with(['objs' => $publico, 'campanha' => $campanha, 'urlReturn' => $url]);
        }


        return view('segmento.addPublico')->with(['objs' => $publico, 'campanha' => $campanha]);
    }

    public function addIdade($campanha_id, $publico_id, Request $request)
    {
        $campanha = \App\Campanha::find($campanha_id);
        $publico = \App\Publico::find($publico_id);

        $Idade = \App\Idade::all()->reverse();

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('segmento.addIdade')->with(['objs' => $Idade, 'campanha' => $campanha, 'publico' => $publico, 'urlReturn' => $url]);
        }
        return view('segmento.addIdade')->with(['objs' => $Idade, 'campanha' => $campanha, 'publico' => $publico]);
    }

    public function add($campanha_id, $publico_id, $idade_id, Request $request)
    {
        $campanha = \App\Campanha::find($campanha_id);
        $publico = \App\Publico::find($publico_id);
        $idade = \App\Idade::find($idade_id);

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return view('segmento.add')->with(['campanha' => $campanha, 'publico' => $publico, 'idade' => $idade, 'urlReturn' => $url]);
        }

        return view('segmento.add')->with(['campanha' => $campanha, 'publico' => $publico, 'idade' => $idade]);
    }

    public function create(Request $request)
    {



        $request->validate([
            'campanha_id' => 'required',
            'publico_id' => 'required',
            'idade_id' => 'required',
            'data_ini' => 'required',
            'data_end' => 'required|unique_with:campanhas_idades_publicos,data_ini,idade_id,publico_id,campanha_id',
        ], ['unique_with' => 'A combinação de data final, data início, idade, público e campanha já existe.']);

        $dadosSegmento = $request->only(['campanha_id', 'publico_id', 'idade_id', 'data_ini', 'data_end']);

        $segmento = \App\CampanhaIdadePublico::create($dadosSegmento);

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return redirect()->action('SegmentoController@list');
    }

    public function edit(Request $request, $id = false)
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

    public function delete(Request $request, $id = false)
    {
        $obj = '';
        $queryRcv = new Request($request->query());

        if ($id) {
            $obj = \App\CampanhaIdadePublico::find($id)->delete();
        } else {
            $query = $queryRcv->only(['campanha_id', 'publico_id', 'idade_id']);
            $obj = \App\CampanhaIdadePublico::where($query)->delete();
        }

        $queryRcv = new Request($request->query());
        if ($queryRcv->has('urlReturn')) {
            $url = $queryRcv->urlReturn;
            return redirect()->to($url);
        }

        return  $obj;
    }


    public function listFull(Request $request, $id = false)
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

        return view('segmento.list')->with('objs', $campanha);
    }
}
