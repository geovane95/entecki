@extends('adminlte::page')

@section('title', 'Lista de Estados')

@section('content_header')
    <h1>Lista de Estados</h1>
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
                <button type="button" name="create_state_record" id="create_state_record" class="btn btn-success btn-sm">Inserir Estado</button>
            </div>

        </div>
        <div class="card-body ">
            <table  id="table_state" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sigla</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.state.modal')


@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            //ACCESS DOCUMENTAÇÃO
            // axios.get(`{{route('state.show',2)}}`)
            // .then((response)=>{
            //         console.log(response);
            // },response=>{
            //     console.log(response)
            // });

            // Listando usuarios
            $("#table_state").DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('state.index')}}",
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
                    {data:'initials', name:'initials'},
                    {data: 'status-desc', name: 'status'},
                    {data:'action',name:'action'},
                ]
            });


            //cadastrando um usuario
            $('#create_state_record').on('click',function(e){
                e.preventDefault();

                clear();
                triggerForm();

                $('#formModalState').modal('show');
                $('#modal-state-title').append('Cadastrar Estado');
                $('#action_state_button').val("Cadastrar");
                $('#action_state_button').addClass('btn-primary');

                $('#state_form').on('submit',function(e){
                    e.preventDefault();

                    let dataForm = $('#state_form').serialize();

                    axios.post(`{{route('state.store')}}`,dataForm)
                        .then((response)=>{
                            console.log(response.data.success);
                            if(response.data.success)
                            {
                                $('#form_state_result').html(

                                    `<div class="alert alert-success">
                                        <p>Sucesso ao cadastrar nova cidade !</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalState').modal('hide');
                                }, 1000);
                            }
                        }).catch((response)=>{
                        console.log(response.responseJSON);
                    }).finally(()=>{

                        $('#table_state').DataTable().ajax.reload();
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
            $('#action_state_button').val('');
            $('#modal-state-title').html('');
            $('#action_state_button').removeClass('btn-primary');
            $('#action_state_button').removeClass('btn-warning');
            $('#form_state_result').html('');
        }
        function triggerForm()
        {
            $("#state_form").trigger('reset');
        }
    </script>
@stop
