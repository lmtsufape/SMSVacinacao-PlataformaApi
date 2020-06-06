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

@push('add')
<script>
    $(document).ready(function($) {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        $("#data_ini").attr("min", `${yyyy}-${mm}-${dd}`);
        $("#data_end").attr("min", `${yyyy}-${mm}-${dd}`);
    });
</script>
@endpush

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4 mr-5 ss ">Adicionar Nova Data</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 mb-3  border-bottom ">
        <form method="POST" action="{{action('SegmentoController@create')}}?urlReturn={{ $urlReturn }}">
            @method('post')
            @csrf
            <input type="hidden" name="campanha_id" value="{{$campanha->id}}" />
            <input type="hidden" name="publico_id" value="{{$publico->id}}" />
            <input type="hidden" name="idade_id" value="{{$idade->id}}" />

            <div class="form-group col-md-12">
                <div class="form-group col-md-12">
                    <label for="data_ini">Data Início</label>
                    <input type="date" class="form-control" id="data_ini" placeholder="Data Início" name="data_ini">
                </div>
                <div class="form-group col-md-12">
                    <label for="data_end">Data Final</label>
                    <input type="date" class="form-control" id="data_end" placeholder="Data final" name="data_end">
                </div>
            </div>
            <div class="form-group col-md-12 mt-5 ">
                <div class="form-group col-md-12">
                    <a href="{{ $urlReturn }}" class="btn btn-secondary">Cancelar</a>
                    <button id="submit" type="submit" class="btn btn-primary">Criar</button>
                </div>
            </div>

        </form>
    </div>
</div>
@stack('add')
@stop