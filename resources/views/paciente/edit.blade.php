@extends('layouts.app')

@push('scripts')
<script>
    $(document).ready(function($) {
        $("#tel").mask('(99)99999-9999', {
            reverse: false,
            placeholder: "(__)_____-____"
        });
        $('#cns').mask('999 9999 9999 9999', {
            placeholder: "___ ____ ____ ____"
        })
        $("#cep").mask('99999-999', {
            placeholder: "_____-___"
        });

        $('#form').submit(function() {
            $('.unmask').unmask();
        });
    });
</script>
@endpush

@section('content')

<div>
    <h1 class="d-flex justify-content-center h2 pt-4">Editar Paciente</h1>
    <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form method="POST" action="{{action('PacienteController@edit')}}">
            @method('put')
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <label for="cns">CNS</label>
                    <input type="text" class="form-control unmask" id="cns" placeholder="cns" name="cns" value="{{$obj->cns}}">
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" value="{{$obj->nome}}">
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control unmask" id="cep" placeholder="CEP" name="cep" value="{{$obj->cep}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="form-control" id="bairro" placeholder="Bairro" name="bairro" value="{{$obj->bairro}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="form-control" id="cidade" placeholder="Cidade" name="cidade" value="{{$obj->cidade}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="uf">UF</label>
                        <select id="uf" class="form-control" name="uf">
                            <option selected="selected" value="{{$obj->uf}}">{{$obj->uf}}</option>
                            <option @if(old('uf')=='AC' ) selected @endif value="AC">AC</option>
                            <option @if(old('uf')=='AL' ) selected @endif value="AL">AL</option>
                            <option @if(old('uf')=='AP' ) selected @endif value="AP">AP</option>
                            <option @if(old('uf')=='AM' ) selected @endif value="AM">AM</option>
                            <option @if(old('uf')=='BA' ) selected @endif value="BA">BA</option>
                            <option @if(old('uf')=='CE' ) selected @endif value="CE">CE</option>
                            <option @if(old('uf')=='DF' ) selected @endif value="DF">DF</option>
                            <option @if(old('uf')=='ES' ) selected @endif value="ES">ES</option>
                            <option @if(old('uf')=='GO' ) selected @endif value="GO">GO</option>
                            <option @if(old('uf')=='MA' ) selected @endif value="MA">MA</option>
                            <option @if(old('uf')=='MT' ) selected @endif value="MT">MT</option>
                            <option @if(old('uf')=='MS' ) selected @endif value="MS">MS</option>
                            <option @if(old('uf')=='MG' ) selected @endif value="MG">MG</option>
                            <option @if(old('uf')=='PA' ) selected @endif value="PA">PA</option>
                            <option @if(old('uf')=='PB' ) selected @endif value="PB">PB</option>
                            <option @if(old('uf')=='PR' ) selected @endif value="PR">PR</option>
                            <option @if(old('uf')=='PE' ) selected @endif value="PE">PE</option>
                            <option @if(old('uf')=='PI' ) selected @endif value="PI">PI</option>
                            <option @if(old('uf')=='RJ' ) selected @endif value="RJ">RJ</option>
                            <option @if(old('uf')=='RN' ) selected @endif value="RN">RN</option>
                            <option @if(old('uf')=='RS' ) selected @endif value="RS">RS</option>
                            <option @if(old('uf')=='RO' ) selected @endif value="RO">RO</option>
                            <option @if(old('uf')=='RR' ) selected @endif value="RR">RR</option>
                            <option @if(old('uf')=='SC' ) selected @endif value="SC">SC</option>
                            <option @if(old('uf')=='SP' ) selected @endif value="SP">SP</option>
                            <option @if(old('uf')=='SE' ) selected @endif value="SE">SE</option>
                            <option @if(old('uf')=='TO' ) selected @endif value="TO">TO</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" id="rua" placeholder="Rua" name="rua" value="{{$obj->rua}}">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="num">Número</label>
                        <input type="number" class="form-control" id="num" placeholder="Numero" name="num" value="{{$obj->num}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="complemento">Complemento</label>
                        @if(isset($obj->complemento))
                        <input type="text" class="form-control" id="complemento" placeholder="Complemento" name="complemento" value="{{$obj->complemento}}">
                        @else
                        <input type="text" class="form-control" id="complemento" placeholder="Complemento" name="complemento" value="">
                        @endif
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="nasc">Data de Nascimento</label>
                        <input type="date" class="form-control" id="nasc" placeholder="Data de Nascimento" name="nasc" value="{{$obj->nasc}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tel">Telefone</label>
                        <input type="text" class="form-control unmask" id="tel" placeholder="Telefone" name="tel" value="{{$obj->tel}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="lat">Latitude</label>
                        <input type="number" class="form-control" id="lat" placeholder="Latitude" name="lat" value="{{$obj->lat}}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="lng">Longitude</label>
                        <input type="number" class="form-control" id="lng" placeholder="Longitude" name="lng" value="{{$obj->lng}}">
                    </div>
                </div>
            </div>
            <a href="{{action('PacienteController@list')}}" class="btn btn-dark">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</div>
@stack('scripts')
@stop