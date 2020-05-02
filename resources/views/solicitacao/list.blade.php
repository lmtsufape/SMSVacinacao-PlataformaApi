@extends('layouts.app')

@section('style')
@parent
<style type="text/css">
    #add:hover {
        background-color: limegreen;
    }
</style>
@endsection
@section('content')

<div>
    <div class="pt-3">
        <h1 class="h2">Solicitações</h1>
    </div>
    <div class="pt-3">
        <ul class="nav nav-tabs" id="tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Todas Solicitações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="my-tab" data-toggle="tab" href="#my" role="tab" aria-controls="my" aria-selected="false">Minhas Solicitações</a>
            </li>
        </ul>
        <div class="tab-content" id="tabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                @include('solicitacao.allTable')
            </div>
            <div class="tab-pane fade" id="my" role="tabpanel" aria-labelledby="my-tab">
                @include('solicitacao.myTable')
            </div>
        </div>
    </div>
</div>


@stop