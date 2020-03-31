@extends('layout.app')

@section('content')

<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nome</th>
            <th>Lat</th>
            <th>Lng</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($unds as $und)
        <tr>
            <td>{{$und->id}}</td>
            <td>{{$und->nome}}</td>
            <td>{{$und->lat}}</td>
            <td>{{$und->lng}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop