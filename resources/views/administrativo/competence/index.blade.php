@extends('adminlte::page')

@section('title', 'Lista de Meses de Referência')

@section('content_header')
    <h1>Lista de Meses de Referência</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div style="display:none;" id="preloader">
            <img src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif"
                 alt="preloader">
        </div>
    </div>
    <div style="display:none;" class="card">
        <div class="card-header">
            <div align="left">
                <button type="button" name="create_competence_record" id="create_competence_record"
                        class="btn btn-success btn-sm">Inserir Mês de Referência
                </button>
            </div>
        </div>
        <div class="card-body ">
            <table id="table_competence" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Mês</th>
                    <th>Ano</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.competence.modal')

@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function () {

            // Listando usuarios
            $("#table_competence").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('competence.index')}}",
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
                    {data: 'month', name: 'month'},
                    {data: 'year', name: 'year'},
                    {data: 'description', name: 'description'},
                    {data: 'status-desc', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });

            //cadastrando uma obra
            $('#create_competence_record').on('click', function (e) {
                e.preventDefault();
                clear();
                triggerForm();

                $('#formModalCompetence').modal('show');
                $('#modal-competence-title').append('Cadastrar Competencia');
                $('#action_competence_button').val("Cadastrar");
                $('#action_competence_button').addClass('btn-primary');

                $('#competence_form').on('submit', function (e) {
                    e.preventDefault();

                    let formElement = document.querySelector('#competence_form');
                    let dataForm = new FormData(formElement);

                    axios.post(`{{route('competence.store')}}`, dataForm)
                        .then((response) => {
                            if (response.data.success) {
                                $('#competence_form_result').html(
                                    `<div class="alert alert-success">
                                        <p>Sucesso ao cadastrar nova competencia !</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalCompetence').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {
                        let errors = error.response;
                        errors = errors.data.errors;

                        if (errors.year) {
                            $('#yearError').html(errors.year);
                        }

                        if (errors.month) {
                            $('#monthError').html(errors.month);
                        }
                    }).finally(() => {
                        $('#table_competence').DataTable().ajax.reload();
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

                $('#formModalCompetence').modal('show');

                $('#formModalCompetence').modal('show');
                $('#modal-competence-title').append('Editar Mês de referencia');
                $('#action_competence_button').val("Salvar");
                $('#action_competence_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#competence_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#competence_form').serialize();

                    axios.put(`/home/competence/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#competence_form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao Atualizar o mês de referencia!</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalCompetence').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.month) {
                            $('#monthError').html(errors.month);
                        }

                        if (errors.year) {
                            $('#yearError').html(errors.year);
                        }
                    }).finally(() => {

                        $('#table_competence').DataTable().ajax.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let url = "{{ route('competence.destroy', ':id') }}";
                url = url.replace(':id', id);
                if (confirm('Você deseja excluir esse mês de referencia?')) {
                    axios.delete(url)
                        .then(response => {
                            console.log(response.status == 204);
                            if (response.status == 204) {
                                $('#table_competence').DataTable().ajax.reload();
                                alert('Mês de referencia deletado');
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
            $('#monthError').html('');
            $('#yearError').html('');
        }

        function getData(id) {
            let url = "{{ route('competence.show', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url)
                .then(response => {
                    let data = response.data;
                    data = data[0];
                    $("#month > option[value=" + data.month + "]").prop("selected", true);
                    $('#year').val(data.year);
                    $("#status > option[value=" + data.status + "]").prop("selected", true);
                })
        }

        function clear() {
            $('#action_competence_button').val('');
            $('#modal-competence-title').html('');
            $('#action_competence_button').removeClass('btn-primary');
            $('#action_competence_button').removeClass('btn-warning');
            $('#competence_form_result').html('');
        }

        function triggerForm() {
            $("#competence_form").trigger('reset');
        }
    </script>
@stop
