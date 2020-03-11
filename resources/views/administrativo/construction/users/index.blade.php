@extends('adminlte::page')

@section('title', 'Lista de Obras')

@section('content_header')
    <h1>Vinculo de Obras  com clientes</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader" >
            <img  src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif" alt="preloader">
        </div>
    </div>
    <div  class="card">
        <div class="card-header row">
            <button id="btn_cliente" class="btn btn-primary">Add Cliente</button>

        </div>
        <div class="card-body ">
            <table  id="table_construction" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{$client->name}}</td>
                        <td><i id="deletar" class="fa fa-trash"></i></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <hr/>



@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function(){
            $('#table_construction').DataTable();
            console.log('Hi');
        });

    </script>
@stop
