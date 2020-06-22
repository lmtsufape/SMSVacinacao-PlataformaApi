@extends('layouts.app')

@section('content')
<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Cadastrar Nova Idade</h1>
    <div class="d-flex justify-content-center align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('IdadeController@create')}}?urlReturn={{ $urlReturn }}">
            @method('post')
            @csrf
            <div class="form-group col-md-12">
                <div class="form-row">
                    <label for="grupo">Grupo *</label>
                    <input type="text" pattern="[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ][A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ_\-\(\)\/\\* 0-9]*" title="Nome do grupo deve começar com letra e conter pelo menos alguma em sua descrição" class="form-control" id="grupo" placeholder="Grupo" name="grupo" required autocomplete="grupo" autofocus value="{{ old('grupo') }}">


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
                        <label for="idade_ini">Idade Início *</label>
                        <input type="number" min="1" class="form-control" id="idade_ini" placeholder="Idade início" name="idade_ini" required autocomplete="idade_ini" autofocus value="{{ old('idade_ini') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="idade_end">Idade Final *</label>
                        <input type="number" min="1" class="form-control" id="idade_end" placeholder="Idade final" name="idade_end" required autocomplete="idade_end" autofocus value="{{ old('idade_end') }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-check ml-3">
                        <input class="form-check-input" type="checkbox" value="" id="mes" name="mes">
                        <label class="form-check-label" for="mes">
                            Marque está caixa de seleção se a faixa etária corresponde a meses.
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <a href="{{ $urlReturn }}" class="btn btn-dark">Cancelar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@stop