@extends('adminlte::page')

@section('title', 'Lista de Responsáveis')

@section('content_header')
    <h1>Lista de Responsáveis</h1>
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
                <button type="button" name="create_responsible_record" id="create_responsible_record" class="btn btn-success btn-sm">Inserir Responsável</button>
            </div>

        </div>
        <div class="card-body ">
            <table  id="table_responsible" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Razão Social</th>
                    <th>CNPJ</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.responsible.modal')

@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            // Listando usuarios
            $("#table_responsible").DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('responsible.index')}}",
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
                    {data:'company_name', name:'company_name'},
                    {data:'cnpj', name:'cnpj'},
                    {data:'status', name:'status',orderable:false , width:'20%'},
                    {data:'action',name:'action'},
                ]
            });

            //cadastrando um responsável
            $('#create_responsible_record').on('click',function(e){
                e.preventDefault();

                clear();
                triggerForm();

                $('#formModalResponsible').modal('show');
                $('#modal-responsible-title').append('Cadastrar Responsável');
                $('#action_responsible_button').val("Cadastrar");
                $('#action_responsible_button').addClass('btn-primary');

                $('#responsible_form').on('submit',function(e){
                    e.preventDefault();

                    let dataForm = $('#responsible_form').serialize();

                    axios.post(`{{route('responsible.store')}}`,dataForm)
                        .then((response)=>{
                            console.log(response.data.success);
                            if(response.data.success)
                            {
                                $('#responsible_form_result').html(

                                    `<div class="alert alert-success">
                                         <p>Sucesso ao cadastrar novo responsável!</p>
                                     </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalResponsible').modal('hide');
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

                $('#formModalResponsible').modal('show');

                $('#formModalResponsible').modal('show');
                $('#modal-responsible-title').append('Editar Responsável');
                $('#action_responsible_button').val("Salvar");
                $('#action_responsible_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#responsible_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#responsible_form').serialize();

                    axios.put(`/home/responsible/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#responsible_form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao Atualizar o responsável!</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalResponsible').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.company_name) {
                            $('#companyNameError').html(errors.company_name);
                        }
                        if (errors.email) {
                            $('#cnpjError').html(errors.cnpj);
                        }
                    }).finally(() => {

                        $('#table_responsible').DataTable().ajax.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                if (confirm('Você deseja desativar esse responsável ?')) {

                    axios.delete(`/home/responsible/${id}`)
                        .then(response => {
                            console.log(response.status == 204);
                            if (response.status == 204) {
                                $('#table_responsible').DataTable().ajax.reload();
                                alert('Responsável Desativado');
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

        function clear()
        {
            $('#action_responsible_button').val('');
            $('#modal-responsible-title').html('');
            $('#action_responsible_button').removeClass('btn-primary');
            $('#action_responsible_button').removeClass('btn-warning');
            $('#form_responsible_result').html('');
        }

        function getData(id) {
            let url = "{{ route('responsible.show', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url)
                .then(response => {
                    $('#company_name').val(response.data.company_name);
                    $('#cnpj').val(response.data.cnpj);
                    $("#status > option[value=" + response.data.address.status + "]").prop("selected", true);
                })
        }
        function triggerForm()
        {
            $("#form_responsible_result").trigger('reset');
        }
    </script>
@stop
