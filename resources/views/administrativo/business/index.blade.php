@extends('adminlte::page')

@section('title', 'Lista de Empresas')

@section('content_header')
    <h1>Lista de Empresas</h1>
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
                <button type="button" name="create_business_record" id="create_business_record" class="btn btn-success btn-sm">Inserir Empresa</button>
            </div>

        </div>
        <div class="card-body ">
            <table  id="table_business" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.business.modal')

@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            // Listando usuarios
            $("#table_business").DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('business.index')}}",
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
                    {data: 'status-desc', name: 'status'},
                    {data:'action',name:'action'},
                ]
            });

            //cadastrando uma empresa
            $('#create_business_record').on('click',function(e){
                e.preventDefault();

                clear();
                triggerForm();

                $('#formModalBusiness').modal('show');
                $('#modal-business-title').append('Cadastrar Empresa');
                $('#action_business_button').val("Cadastrar");
                $('#action_business_button').addClass('btn-primary');

                $('#business_form').on('submit',function(e){
                    e.preventDefault();

                    let dataForm = $('#business_form').serialize();

                    axios.post(`{{route('business.store')}}`,dataForm)
                        .then((response)=>{
                            console.log(response.data.success);
                            if(response.data.success)
                            {
                                $('#business_form_result').html(

                                    `<div class="alert alert-success">
                                         <p>Sucesso ao cadastrar nova empresa!</p>
                                     </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalBusiness').modal('hide');
                                }, 1000);
                            }
                        }).catch((response)=>{
                        console.log(response.responseJSON);
                    }).finally(()=>{
                        location.reload();
                    });

                });
            });

            $('body').on('click', '.edit', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                //limopando a modal e os forms
                clear();
                clearError();
                triggerForm();

                $('#formModalBusiness').modal('show');

                $('#formModalBusiness').modal('show');
                $('#modal-business-title').append('Editar Empresa');
                $('#action_business_button').val("Salvar");
                $('#action_business_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#business_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#business_form').serialize();

                    axios.put(`/home/business/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#business_form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao Atualizar a empresa!</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalBusiness').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response;

                        console.log(errors);

                        if (errors.business_name) {
                            $('#busines_nameError').html(errors.business_name);
                        }
                    }).finally(() => {

                        $('#table_business').DataTable().ajax.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                if (confirm('Você deseja desativar essa empresa ?')) {

                    axios.delete(`/home/business/${id}`)
                        .then(response => {
                            console.log(response.status == 204);
                            if (response.status == 204) {
                                $('#table_business').DataTable().ajax.reload();
                                alert('Empresa Desativada');
                            }
                        })

                }


            });

            //dps de carregar os ajax das páginas
            $(document ).ajaxComplete(function() {
                $('#preloader').hide();
                $('.card').show();
            });
        });

        function clearError() {
            $('#business_nameError').html('');
        }

        function clear()
        {
            $('#action_business_button').val('');
            $('#modal-business-title').html('');
            $('#action_business_button').removeClass('btn-primary');
            $('#action_business_button').removeClass('btn-warning');
            $('#form_business_result').html('');
        }

        function getData(id) {
            let url = "{{ route('business.show', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url)
                .then(response => {
                    let data = response.data;
                    data = data[0];
                    $('#business_name').val(data.name);
                    $("#status > option[value=" + data.status + "]").prop("selected", true);
                })
        }
        function triggerForm()
        {
            $("#form_business_result").trigger('reset');
        }
    </script>
@stop
