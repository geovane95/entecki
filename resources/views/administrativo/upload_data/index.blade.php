@extends('adminlte::page')

@section('title', 'Upload de dados')

@section('content_header')
    <h1>Upload de Dados</h1>
    @include('administrativo.upload_data.msg')
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader">
            <img src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif"
                 alt="preloader">
        </div>
    </div>
    <div class="card-header row">
        <form action="{{route('upload_data.store')}}" class="form-inline" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <label for="upload_type">Tipo de Upload</label>
                    {{Form::select('upload_type',$uploadtype,null,['class'=>'form-control','placeholder'=>'Escolha um tipo de upload','id'=>'upload_type'])}}
                </div>
                <div class="col">
                    <label for="competence">Mês de Referência</label>
                    {{Form::select('competence',$competence,null,['class'=>'form-control','placeholder'=>'Escolha um mês de referência','id'=>'competence'])}}
                </div>
                <div class="col" style="display: none;" id="constructionselect">
                    <label for="construction">Obra</label>
                    {{Form::select('construction',$construction,null,['class'=>'form-control','placeholder'=>'Escolha uma obra','id'=>'construction'])}}
                </div>
                <div class="col">
                    <label for="file">Arquivo</label>
                    <input type="file" name="file" id="file" class="form-control-file">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-info">Enviar</button>
                    <button type="button" class="btn btn-info"><span class="fa fa-info-circle" id="info_upload"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div style="display:none;" id="tabeladiv">
        <h3>Ultimos Uploads realizados</h3>
        <table id="table_uploads" class="table table-bordered table-striped" style="width:100%;">
            <thead class="thead-dark">
            <tr>
                <th>Tipo de Upload</th>
                <th>Usuário</th>
                <th>Nome do Arquivo</th>
                <th>Mês de Referência</th>
                <th>Data de Upload</th>
                <th>Status do Upload</th>
                <th>Download</th>
            </tr>
            </thead>
        </table>
        @include('administrativo.upload_data.modal')

        @stop

        @section('css')

        @stop

        @section('js')
            <script>


                $(document).ready(function () {

                    // Listando usuarios
                    $("#table_uploads").DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{route('upload_data.index')}}",
                        },
                        "oLanguage": {
                            "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                            "sZeroRecords": "Nada foram encontrados registros",
                            "sInfo": "Mostrando _START_ to _END_ of _TOTAL_ registros",
                            "sInfoEmpty": "Showing 0 to 0 of 0 records",
                            "sInfoFiltered": "(filtrado até _MAX_ total registros)",
                            'sSearch': 'Pesquisar',
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst": "Primero",
                                "sLast": "Último",
                                "sNext": "Seguinte",
                                "sPrevious": "Anterior"
                            },
                        },
                        columns: [
                            {data: 'upload_type_name', name: 'upload_type_name'},
                            {data: 'user_name', name: 'user_name'},
                            {data: 'fileName', name: 'fileName'},
                            {data: 'competence_description', name: 'competence_description'},
                            {data: 'created_at', name: 'created_at'},
                            {data: 'upload_status_name', name: 'upload_status_name'},
                            {data: 'action', name: 'action'},
                        ]
                    });

                    $("#upload_type").change(function () {
                        if ($("#upload_type").val() == "1") {
                            $("#constructionselect").hide();
                        } else {
                            $("#constructionselect").show();
                        }
                    });


                    //dps de carregar os ajax das páginas
                    $(document).ajaxComplete(function () {
                        $('#preloader').hide();
                        $('#tabeladiv').show();
                    });


                    //cadastrando uma obra
                    $('#info_upload').on('click', function (e) {

                        $('#ModalInfo').modal('show');
                    });
                });
            </script>
@stop
