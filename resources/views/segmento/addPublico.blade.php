@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #tableIdade {
        background-color: white;
        border-top: 1px solid #dddddd;
    }
</style>
@endsection

@push('addPublico')
<script>
    $(document).ready(function($) {

        $('#tableIdade').DataTable({
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

        var getPublico = function() {
            const selectPublico = $("select.publico").children("option:selected").val();
            return selectPublico;
        }

        var getDataTable = function(urlProcess) {
            const selectedPublico = getPublico();
            $.ajax({
                type: "GET",
                url: urlProcess,
                success: function(result) {
                    result.forEach(function(item, index) {
                        $('#tableIdade > tbody').append(`
                            '<tr> 
                                <td>${item.id}</td> 
                                <td>${item.grupo}</td> 
                                <td> De ${item.idade_ini} à ${item.idade_end}</td>
                                <td>
                                    <form class="form-soft" action="{{action('SegmentoController@delete')}}?campanha_id={{$campanha->id}}&publico_id=${selectedPublico}&idade_id=${item.id}&urlReturn={{ URL::full()}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <a href="" onclick="if(confirm('Deseja realmente excluir grupo ${item.grupo}, faixa etária de ${item.idade_ini} à ${item.idade_end}?')){this.closest('form').submit(); return false;}else{return false}">
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
            const publico_id = getPublico();
            var url = `{{action('SegmentoController@addIdade')}}/{{$campanha->id}}/${publico_id}?urlReturn={{URL::full()}}`;
            setTimeout(() => {
                window.location.href = url;
            }, 1);

        });

        var populate = function() {
            const selectedPublico = getPublico();
            $('#tableIdade > tbody').html('');
            var urlProcess = "{{action('SegmentoController@list')}}?campanha_id={{$campanha->id}}&publico_id=" + selectedPublico + "";
            getDataTable(urlProcess);
        }

        $("select.publico").change(function() {
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
    <h1 class="d-flex justify-content-center h2 pt-4 mr-5 ss ">Configuração de Público</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3  border-bottom ">
        <form method="POST" action="{{action('SegmentoController@addIdade')}}">
            @method('get')
            @csrf
            <div class="form-group col-md-12">
                <div class=" form-row">
                    <div class="form-group col-md-6">
                        <label for="nome">Público</label>
                        <select id="publico" class="form-control publico" name="publico_id">
                            @foreach($objs as $obj)
                            <option value="{{$obj->id}}">{{$obj->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 ">
                        <label for="nome" class="mb-5"> </label>
                        <a href="{{action('PublicoController@add')}}?urlReturn={{URL::full()}}" class="btn btn-success mt-2">Nova Publico</a>
                    </div>
                </div>
            </div>


            <div class="form-group col-md-12 mt-5 ">
                <div class="form-row ">
                    <div class="form-group col-md-10">
                        <label for="desc">Idades para esta publico</label>
                        <table id="tableIdade" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Grupo</th>
                                    <th>Faixa Etária</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody class="fi">

                            </tbody>
                        </table>
                    </div>
                    <div class="form-group col-md-2 ">
                        <label for="nome" class="mb-5"> </label>
                        <button class="btn btn-primary btn-add">Adicionar</button>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12 mt-5 ">
                <a href="{{$urlReturn}}" class="btn btn-secondary">Voltar</a>
            </div>

        </form>
    </div>
</div>
@stack('addPublico')
@stop