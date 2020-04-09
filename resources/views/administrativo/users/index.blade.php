@extends('adminlte::page')

@section('title', 'Lista de Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader">
            <img src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif"
                 alt="preloader">
        </div>


        <div style="display:none;" class="card">
            <div class="card-header">

                <br/>
                <div align="left">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Criar
                        Usuario
                    </button>
                    <button type="button" name="list_admins" id="list_admins"
                            class="btn btn-success btn-sm">Listar Admins
                    </button>
                    <button type="button" name="list_clients" id="list_clients"
                            class="btn btn-success btn-sm">Listar Cliente
                    </button>
                </div>

            </div>
            <div class="card-body ">
                <table id="table_id" class="table table-bordered table-striped" style="width:100%;">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th>Ação</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    @include('administrativo.users.modal')


@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function () {

            //ACCESS DOCUMENTAÇÃO
            // axios.get(`{{route('user.show',2)}}`)
            // .then((response)=>{
            //         console.log(response);
            // },response=>{
            //     console.log(response)
            // });

            var url_atual = window.location.href;

            id = url_atual.split('/')[5];

            let url = id ? "{{route('user.show',':id')}}" : "{{route('user.index')}}";

            url = url.replace(':id',id);

            // Listando usuarios
            $("#table_id").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: url,
                },
                "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por pagina",
                    "sZeroRecords": "Nada foi encontrado - desculpa",
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
                    {data: 'name', name: 'name'},
                    {data: 'company', name: 'company'},
                    {data: 'email', name: 'email'},
                    {data: 'access-profile-name', name: 'profile'},
                    {data: 'action', name: 'action'},
                ]
            });


            //cadastrando um usuario
            $('#create_record').on('click', function (e) {
                e.preventDefault();

                clear();
                clearError();
                triggerForm();

                $('#formModal').modal('show');
                $('#modal-title').append('Cadastrar Usuario');
                $('#action_button').val("Cadastrar");
                $('#action_button').addClass('btn-primary');
                $('#pass').show();

                $('#user_form').on('submit', function (e) {
                    e.preventDefault();
                    clearError();
                    let dataForm = $('#user_form').serialize();

                    axios.post(`{{route('user.store')}}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao cadastrar novo usuario !</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModal').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.name) {
                            $('#nameError').html(errors.name[0]);
                        }
                        if (errors.company) {
                            $('#companyError').html(errors.company[0]);
                        }
                        if (errors.email) {
                            $('#emailError').html(errors.email);
                        }
                        if (errors.password) {
                            $('#passwordError').html(errors.password);
                        }
                        if (errors.access_profile) {
                            $('#access_profileError').html(errors.access_profile);
                        }
                        errors = {};
                    }).finally(() => {

                        $('#table_id').DataTable().ajax.reload();
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

                $('#formModal').modal('show');

                $('#formModal').modal('show');
                $('#modal-title').append('Editar Usuario');
                $('#action_button').val("Salvar");
                $('#action_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#user_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#user_form').serialize();

                    axios.put(`/home/user/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao Atualizar  usuario !</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModal').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.name) {
                            $('#nameError').html(errors.name);
                        }
                        if (errors.company) {
                            $('#companyError').html(errors.name);
                        }
                        if (errors.email) {
                            $('#emailError').html(errors.email);
                        }
                        if (errors.access_profile) {
                            $('#access_profileError').html(errors.access_profile);
                        }
                        errors = {};
                    }).finally(() => {

                        $('#table_id').DataTable().ajax.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                if (confirm('Você deseja deletar esse usuario ?')) {

                    axios.delete(`/home/user/${id}`)
                        .then(response => {
                            console.log(response.status == 204);
                            if (response.status == 204) {
                                $('#table_id').DataTable().ajax.reload();
                                alert('Usuario Deletado');
                            }
                        })

                }


            });

            // $('.edit').on('click',function(e){
            //     e.preventDefault();
            //     let id  =  $(this).attr('id');
            //     console.log(id);
            // });

            $('#state').on('select', function (e) {

            });

            //dps de carregar os ajax das páginas
            $(document).ajaxComplete(function () {
                $('#preloader').hide();
                $('.card').show();
            });

            $("#list_clients").click(function () {
                window.location = '{{ route('user.index') }}'+'/2';
            });

            $("#list_admins").click(function () {
                window.location = '{{ route('user.index') }}'+'/1';
            });
        });

        function clearError() {
            $('#nameError').html('');
            $('#companyError').html('');
            $('#emailError').html('');
            $('#passwordError').html('');
            $('#perfil_acessos_idError').html('');
        }

        function clear() {
            $('#action_button').val('');
            $('#modal-title').html('');
            $('#action_button').removeClass('btn-primary');
            $('#action_button').removeClass('btn-warning');
            $('#form_result').html('');
            $('#nameError').html('');
            $('#companyError').html('');
            $('#emailError').html('');
            $('#passwordError').html('');
            $('#perfil_acessos_idError').html('');
        }

        function triggerForm() {
            $("#user_form").trigger('reset');
        }

        function getData(id) {
            var url = "{{ route('user.edit', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url)
                .then(response => {

                    $('#name').val(response.data.name);
                    $('#business').val(response.data.company);
                    $('#email').val(response.data.email);
                    $('#password').val(response.data.password);
                    $("#access_profile > option[value="+response.data.access_profile+"]").prop("selected",true);
                    $('#pass').hide();

                })
        }
    </script>
@stop
