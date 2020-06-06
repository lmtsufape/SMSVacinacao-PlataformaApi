@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection

@push('script')
<script>
    $(document).ready(function($) {
        $('#tableUnidade').DataTable();
    });
</script>
@endpush

@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Unidades</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('UnidadeController@add')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('UnidadeController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="tableUnidade" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Unidade</th>
                <th>Localização</th>
                <th width="14%">Opcões</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($unds as $und)
            <tr>
                <td class="text-wrap">{{$und->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">Rua {{$und->rua}}, Nº{{$und->num}}, Bairro {{$und->bairro}}, {{$und->cidade}}-{{$und->uf}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="d-flex flex-column justify-content-center ">
                            <a data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="btn btn-info btn-sm mb-1 mr-1">Detalhes</a>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href="{{action('UnidadeController@editForm', $und->id)}}" class="mb-1 mr-1">
                                <i data-feather="edit"></i>
                                Editar
                            </a>
                            <form class="form-soft" action="{{action('UnidadeController@delete', $und->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <a href="" onclick="if(confirm('Deseja realmente excluir {{$und->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                    <i data-feather="trash-2"></i>
                                    Deletar
                                </a>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes da Unidade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3">Nome:</dt>
                                <dd class="h4 col-sm-9">{{$und->nome}}</dd>
                                <dt class="h4 col-sm-3">Rua:</dt>
                                <dd class="h4 col-sm-9">{{$und->rua}}</dd>
                                <dt class="h4 col-sm-3">Número:</dt>
                                <dd class="h4 col-sm-9">{{$und->num}}</dd>
                                <dt class="h4 col-sm-3">Bairro:</dt>
                                <dd class="h4 col-sm-9">{{$und->bairro}}</dd>
                                <dt class="h4 col-sm-3">Cidade:</dt>
                                <dd class="h4 col-sm-9">{{$und->cidade}}</dd>
                                <dt class="h4 col-sm-3">Estado:</dt>
                                <dd class="h4 col-sm-9">{{$und->uf}}</dd>
                                <dt class="h4 col-sm-3">Coordenadas:</dt>
                                <dd class="h4 col-sm-9">{{$und->lat}}, {{$und->lng}}</dd>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

@stack('script')
@stop