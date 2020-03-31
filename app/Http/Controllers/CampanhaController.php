<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    //

    public function list(Request $request, $id = false){
       
        if($id !== false){
            $campanha = \App\Campanha::find($id);

            return $campanha; 
        }

        $campanha = \App\Campanha::all();

        return $campanha; 
        
    }

    public function create(Request $request){

        $dadosCampanha = $request->only(['id', 'nome',  'desc', 'idade_ini', 'idade_end', 'atend_domic']);
        $campanha = \App\Campanha::create($dadosCampanha);
        
        return $dadosCampanha; 
    }

    public function edit(Request $request){

        $dadosCampanha = $request->only(['id', 'nome',  'desc', 'idade_ini', 'idade_end', 'atend_domic']);
        $campanha = \App\Campanha::find($dadosCampanha['id']);

        if($campanha !== null){
            $updatingCampanha = \App\Campanha::updateOrCreate(['id' => $dadosCampanha['id']], $dadosCampanha);
            return $updatingCampanha;
        }

        return 'not found';
    }

    public function delete(Request $request, $id = false){

        $campanha = '';
        
        if($id !== false){
            $campanha = \App\Campanha::find($id);
        }else{
            $dadosCampanha = $request->only(['id']);
            $campanha = \App\Campanha::find($dadosCampanha['id']);
        }
        
        if($campanha !== null){
            $campanha->delete();
            return 'success';
        }

        return 'not found';
    }

    public function teste(){


        $campanhaResults = \App\Campanha::all()->reject(function ($campanha){
            $result = $campanha->idade_end - $campanha->idade_ini;
            $campanha->result = $result;
            return $result > 50;
        });

        return $campanhaResults;

    }
}
