@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #tableData {
        background-color: white;
        border-top: 1px solid #dddddd;
    }
</style>
@endsection

@push('addIdade')
<script>
    $(document).ready(function($) {

        $('#tableData').DataTable({
            "language": {
                "lengthMenu": "Exibir _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ total de registros)"
            },
            "searching": false,
            "paging": false,
            "info": false,
            "scrollY": "200px",
            "autoWidth": false,
            "scrollCollapse": true,
        });

        var getIdade = function() {
            const selectIdade = $("select.idade").children("option:selected").val();
            return selectIdade;
        }

        var getDataTable = function(urlProcess) {
            const selectedIdade = getIdade();
            $.ajax({
                type: "GET",
                url: urlProcess,
                success: function(result) {
                    result.forEach(function(item, index) {
                        $('#tableData > tbody').append(`
                            '<tr> 
                                <td>${item.id}</td> 
                                <td>${item.data_ini}</td> 
                                <td>${item.data_end}</td>
                                <td>
                                    <form class="form-soft" action="{{action('SegmentoController@delete')}}/${item.id}?urlReturn={{ URL::full() }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="" onclick="if(confirm('Deseja realmente excluir o período ${item.data_ini} à ${item.data_end}?')){this.closest('form').submit(); return false;}else{return false}">
                                            <i data-feather="trash-2"></i>
                                            Deletar
                                        </a>
                                    </form>
                                </td>
                            </tr>`);
                    });
                },
                complete: function(msg) {
                    $('#loading').css({
                        display: "none"
                    });
                }
            });
        }

        $(".btn-add").click(function() {
            const idade_id = getIdade();
            var url = `{{action('SegmentoController@add')}}/{{$campanha->id}}/{{$publico->id}}/${idade_id}?urlReturn={{URL::full()}}`;
            setTimeout(() => {
                window.location.href = url;
            }, 1);

        });

        var populate = function() {
            const selectedIdade = getIdade();
            $('#tableData > tbody').html('');
            var urlProcess = "{{action('SegmentoController@list')}}?campanha_id={{$campanha->id}}&publico_id={{$publico->id}}&idade_id=" + selectedIdade + "";
            getDataTable(urlProcess);
        }

        $("select.idade").change(function() {
            populate();
        });

        var main = function() {
            populate();
        }

        main();

    });
</script>
@endpush

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4 mr-5 ss ">Configuração de Idade</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3  border-bottom ">
        <form method="POST" action="{{action('SegmentoController@add')}}">
            @method('get')
            @csrf
            <input type="hidden" name="campanha_id" value="{{$campanha->id}}" />
            <input type="hidden" name="publico_id" value="{{$publico->id}}" />
            <div class="form-group col-md-12">
                <div class=" form-row">
                    <div class="form-group col-md-6">
                        <label for="nome">Idade</label>
                        <select id="idade" class="form-control idade" name="idade_id">
                            @foreach($objs as $obj)
                            <option value="{{$obj->id}}">{{$obj->grupo}}, de {{$obj->idade_ini}} à {{$obj->idade_end}} {{$obj->mes? 'meses':'anos'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="nome" class="mb-5"> </label>
                        <a href="{{action('IdadeController@add')}}?urlReturn={{URL::full()}}" class="btn btn-success mt-2">Nova Idade</a>
                    </div>
                </div>
            </div>


            <div class="form-group col-md-12 mt-5 ">
                <div class="form-row ">
                    <div class="form-group col-md-10">
                        <label for="desc">Datas para esta idade</label>
                        <table id="tableData" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Data Inicial</th>
                                    <th>Data Final</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody class="fi">

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group col-md-2 ">
                        <label for="nome" class="mb-5"> </label>
                        <button id="submit" type="submit" class="btn btn-primary btn-add">Adicionar</button>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 mt-5 ">
                <a href="{{$urlReturn}}" class="btn btn-secondary">Voltar</a>
            </div>

        </form>
    </div>
</div>
@stack('addIdade')
@stop