@extends('adminlte::page')

@section('title', 'Envio de Emails de Obras')

@section('content_header')
    <h1>Envio de Emails de Obras</h1>
@stop

@section('content')
    <h4><strong>{{ $error }}</strong></h4>
    <a href="{{route('competence.index')}}">Clique aqui e cadastre os meses de refêrencia.</a>
@stop

@section('css')

@stop

@section('js')

@stop
