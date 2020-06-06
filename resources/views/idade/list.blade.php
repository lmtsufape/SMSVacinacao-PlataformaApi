@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection

@push('listIdade')
<script>
    $(document).ready(function($) {
        $('#Idadetable').DataTable({
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
        });
    });
</script>
@endpush

@section('content')
@stack('listIdade')
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Idades</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a id="add" href="{{action('IdadeController@add')}}?urlReturn={{URL::full()}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="plus"></span> Cadastrar
            </a>
            <a href="{{action('IdadeController@list')}}" class="btn btn-sm btn-outline-primary pt-2 ml-2">
                <span data-feather="rotate-ccw"></span> Atualizar
            </a>
        </div>
    </div>

    <table id="Idadetable" class="table table-striped table-sm display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Faixa Etária</th>
                <th width="14%">Opções</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($objs as $obj)
            <tr>
                <td>{{$obj->grupo}}</td>
                <td class="text-wrap">De {{$obj->idade_ini}} à {{$obj->idade_end}} {{$obj->mes?'meses':'anos'}}</td>
                <td>
                    <div class="d-flex justify-content-around flex-wrap">
                        <a href="{{action('IdadeController@editForm', $obj->id)}}" class="mb-1 mr-1">
                            <i data-feather="edit"></i>
                            Editar
                        </a>
                        <form class="form-soft" action="{{action('IdadeController@delete', $obj->id)}}" method="post">
                            @method('delete')
                            @csrf
                            <a href="" onclick="if(confirm('Deseja realmente excluir grupo {{$obj->grupo}}, faixa etária {{$obj->idade_ini}} à {{$obj->idade_end}} ?')){this.closest('form').submit(); return false;}else{return false}">
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