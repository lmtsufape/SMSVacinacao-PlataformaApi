@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection

@push('listCampanha')
<script>
    $(document).ready(function($) {

        $('#tableSegmento').DataTable({
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
            "columnDefs": [{
                "targets": 1,
                "render": function(data, type, row) {
                    return data.substr(0, 100) + "...";
                }
            }]
        });
    });
</script>
@endpush

@section('content')

<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Segmentações de Campanhas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('SegmentoController@addCampanha')}}?urlReturn={{URL::full()}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('SegmentoController@listFull')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="tableSegmento" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Campanha</th>
                <th>Descrição</th>
                <th>Período</th>
                <th>Atend. Domic</th>
                <th width="14%">Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td class="text-wrap">{{$obj->nome}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">{{$obj->desc}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="text-wrap">{{$obj->data_ini}} - {{$obj->data_end}}</td>
                <td data-toggle="modal" data-target="#modal{{$loop->iteration}}">{{$obj->atend_domic? 'Sim' : 'Não'}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <div class="d-flex flex-column justify-content-center mb-1 mr-1">
                            <a data-toggle="modal" data-target="#modal{{$loop->iteration}}" class="btn btn-info btn-sm">Detalhes</a>
                        </div>
                        @can('create', App\CampanhaIdadePublico::class)
                        <div class="d-flex flex-column justify-content-center mb-1 mr-1">
                            <a href="{{action('CampanhaController@editForm', $obj->id)}}?urlReturn={{URL::full()}}" class="mb-1 mr-1">
                                <i data-feather="edit"></i>
                                Editar
                            </a>
                            <form class="form-soft" action="{{action('SegmentoController@delete')}}?campanha_id={{$obj->id}}&urlReturn={{ URL::full() }}" method="post">
                                @method('delete')
                                @csrf
                                <a href="" onclick="if(confirm('Deseja realmente excluir todas as segmentações contendo a campanha {{$obj->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                    <i data-feather="trash-2"></i>
                                    Deletar
                                </a>
                            </form>
                        </div>
                        @endcan
                    </div>
                </td>
            </tr>
            <div class="modal fade bd-example-modal-lg" id="modal{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes da Campanha</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="row mt-3 pt-3 pl-2 ">
                                <dt class="h4 col-sm-3 ">Nome:</dt>
                                <dd class="h4 col-sm-9 ">{{$obj->nome}}</dd>
                                <dt class="h4 col-sm-3">Descrição:</dt>
                                <dd class="h4 col-sm-9">{{$obj->desc}}</dd>
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
@stack('listCampanha')
@stop