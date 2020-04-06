@extends('layouts.app')

@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Unidades</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{action('UnidadeController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="unidadetable" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Unidade</th>
                <th>Localização</th>
                <th>Opcoes</th>
            </tr>
        </thead>

        <tbody id="accordionExample">
            @foreach ($unds as $und)
            <tr data-toggle="collapse" data-target="#demo{{$und->id}}" aria-expanded="true" aria-controls="demo{{$und->id}}">
                <td>{{$und->nome}}</td>
                <td>{{$und->rua}}, Nº{{$und->num}}, {{$und->bairro}}, {{$und->cidade}}-{{$und->uf}}</td>
                <td>
                    <div class="d-flex justify-content-between flex-wrap">
                        <a class="link" href="#">
                            <span data-feather="slash"></span>
                            bloquear
                        </a>
                        <a href="{{action('UnidadeController@editForm', $und->id)}}">
                            <i data-feather="airplay"></i>
                            editar
                        </a>
                        <a href="{{action('UnidadeController@editForm', $und->id)}}">
                            <i data-feather="airplay"></i>
                            deletar
                        </a>
                        <form class="form-soft" action="{{action('UnidadeController@delete', $und->id)}}" method="post">
                            <input data-feather="airplay" type="submit" value="Delete"></input>
                            @method('delete')
                            @csrf
                        </form>
                    </div>
                </td>
            </tr>
            <tr id="demo{{$und->id}}" class="collapse" data-parent="#accordionExample">
                <td colspan="3" class="hiddenRow">
                    <div class="d-flex justify-content-between">
                        {{$und->lat}}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@stop