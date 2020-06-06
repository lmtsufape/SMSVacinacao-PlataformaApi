@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection

@push('listPublico')
<script>
    $(document).ready(function($) {
        $('#Publicotable').DataTable();
    });
</script>
@endpush

@section('content')
@stack('listPublico')
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Públicos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('PublicoController@add')}}?urlReturn={{URL::full()}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('PublicoController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="Publicotable" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Público</th>
                <th width="14%">Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td class="text-wrap">{{$obj->nome}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <a href="{{action('PublicoController@editForm', $obj->id)}}" class="mb-1 mr-1">
                            <i data-feather="edit"></i>
                            Editar
                        </a>
                        <form class="form-soft" action="{{action('PublicoController@delete', $obj->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <a href="" onclick="if(confirm('Deseja realmente excluir {{$obj->nome}}?')){this.closest('form').submit(); return false;}else{return false}">
                                <i data-feather="trash-2"></i>
                                Deletar
                            </a>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@stop