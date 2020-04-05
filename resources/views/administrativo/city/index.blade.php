@extends('adminlte::page')

@section('title', 'Lista de Cidades')

@section('content_header')
    <h1>Lista de Cidades</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader" >
            <img  src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif" alt="preloader">
        </div>
    </div>
    <div style="display:none;" class="card">
        <div class="card-header">

            <br />
            <div align="left">
                <button type="button" name="create_city_record" id="create_city_record" class="btn btn-success btn-sm">Inserir Cidade</button>
            </div>

        </div>
        <div class="card-body ">
            <table  id="table_city" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Estado</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.city.modal')


@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            //ACCESS DOCUMENTAÇÃO
            // axios.get(`{{route('city.show',2)}}`)
            // .then((response)=>{
            //         console.log(response);
            // },response=>{
            //     console.log(response)
            // });

            // Listando usuarios
            $("#table_city").DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('city.index')}}",
                },
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                    "sZeroRecords": "Nada foram encontrados registros",
                    "sInfo": "Mostrando _START_ to _END_ of _TOTAL_ registros",
                    "sInfoEmpty": "Showing 0 to 0 of 0 records",
                    "sInfoFiltered": "(filtrado até _MAX_ total registros)",
                    'sSearch':'Pesquisar',
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":    "Último",
                        "sNext":    "Seguinte",
                        "sPrevious": "Anterior"
                    },
                },
                columns:[
                    {data:'name', name:'name'},
                    {data:'state-name', name:'state-name'},
                    {data: 'status-desc', name: 'status'},
                    {data:'action',name:'action'},
                ]
            });


            //cadastrando um usuario
            $('#create_city_record').on('click',function(e){
                e.preventDefault();

                clear();
                triggerForm();

                $('#formModalCity').modal('show');
                $('#modal-city-title').append('Cadastrar Cidade');
                $('#action_city_button').val("Cadastrar");
                $('#action_city_button').addClass('btn-primary');

                $('#city_form').on('submit',function(e){
                    e.preventDefault();

                    let dataForm = $('#city_form').serialize();

                    axios.post(`{{route('city.store')}}`,dataForm)
                        .then((response)=>{
                            console.log(response.data.success);
                            if(response.data.success)
                            {
                                $('#form_city_result').html(

                                    `<div class="alert alert-success">
                                        <p>Sucesso ao cadastrar nova cidade !</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalCity').modal('hide');
                                }, 1000);
                            }
                        }).catch((response)=>{
                        console.log(response.responseJSON);
                    }).finally(()=>{

                        $('#table_city').DataTable().ajax.reload();
                    });

                });
            });


            //dps de carregar os ajax das páginas
            $(document ).ajaxComplete(function() {
                $('#preloader').hide();
                $('.card').show();
            });
        });

        function clear()
        {
            $('#action_city_button').val('');
            $('#modal-city-title').html('');
            $('#action_city_button').removeClass('btn-primary');
            $('#action_city_button').removeClass('btn-warning');
            $('#form_city_result').html('');
        }
        function triggerForm()
        {
            $("#city_form").trigger('reset');
        }
    </script>
@stop
