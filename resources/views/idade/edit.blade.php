@extends('layouts.app')

@section('content')
<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Idade</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('IdadeController@edit')}}">
            @method('put')
            @csrf
            <input type="hidden" name="id" value="{{$obj->id}}" />
            <div class="form-group col-md-12">
                <div class="form-row">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control" id="grupo" placeholder="Grupo" name="grupo" value="{{$obj->grupo}}" required autocomplete="grupo" autofocus>


                </div>
            </div>
            <div class="form-group col-md-12 ">
                <div class="form-row">
                    Faixa Etária
                </div>
            </div>
            <div class="form-group col-md-12 mb-5">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="idade_ini">Idade Início</label>
                        <input type="number" class="form-control" id="idade_ini" placeholder="Idade início" name="idade_ini" value="{{$obj->idade_ini}}" required autocomplete="idade_ini" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="idade_end">Idade Final</label>
                        <input type="number" class="form-control" id="idade_end" placeholder="Idade final" name="idade_end" value="{{$obj->idade_end}}" required autocomplete="idade_end" autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" value="" id="mes" name="mes" value="{{$obj->mes? '1':'0'}}" {{($obj->mes? ' checked' : '')}}>
                        <label class="form-check-label" for="mes">
                            Marque está caixa de seleção se a faixa etária corresponde a meses.
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <a href="{{ URL::previous() }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>
@stop