@extends('adminlte::page')

@section('title', 'Lista de Regionais')

@section('content_header')
    <h1>Lista de Regionais</h1>
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
                <button type="button" name="create_regional_record" id="create_regional_record" class="btn btn-success btn-sm">Inserir Regional</button>
            </div>

        </div>
        <div class="card-body ">
            <table  id="table_regional" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.regional.modal')

@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            // Listando usuarios
            $("#table_regional").DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('regional.index')}}",
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

            //cadastrando um responsável
            $('#create_regional_record').on('click',function(e){
                e.preventDefault();

                clear();
                triggerForm();

                $('#formModalRegional').modal('show');
                $('#modal-regional-title').append('Cadastrar Regional');
                $('#action_regional_button').val("Cadastrar");
                $('#action_regional_button').addClass('btn-primary');

                $('#regional_form').on('submit',function(e){
                    e.preventDefault();

                    let dataForm = $('#regional_form').serialize();

                    axios.post(`{{route('regional.store')}}`,dataForm)
                        .then((response)=>{
                            console.log(response.data.success);
                            if(response.data.success)
                            {
                                $('#regional_form_result').html(

                                    `<div class="alert alert-success">
                                         <p>Sucesso ao cadastrar novo regional!</p>
                                     </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalRegional').modal('hide');
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

                $('#formModalRegional').modal('show');

                $('#formModalRegional').modal('show');
                $('#modal-regional-title').append('Editar Regional');
                $('#action_regional_button').val("Salvar");
                $('#action_regional_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#regional_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#regional_form').serialize();

                    axios.put(`/home/regional/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#regional_form_result').html(
                                    `<div class="alert alert-success">
                                                <p>Sucesso ao Atualizar o regional!</p>
                                            </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalRegional').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.name) {
                            $('#regionalNameError').html(errors.name);
                        }
                    }).finally(() => {

                        $('#table_regional').DataTable().ajax.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let url = "{{ route('regional.destroy', ':id') }}";
                url = url.replace(':id', id);
                if (confirm('Você deseja deletar esse regional?')) {

                    axios.delete(url)
                        .then(response => {
                            console.log(response.status == 204);
                            if (response.status == 204) {
                                $('#table_regional').DataTable().ajax.reload();
                                alert('Regional Deletado');
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
            $('#action_regional_button').val('');
            $('#modal-regional-title').html('');
            $('#action_regional_button').removeClass('btn-primary');
            $('#action_regional_button').removeClass('btn-warning');
            $('#form_regional_result').html('');
        }

        function clearError() {
            $('#regionalNameError').html('');
        }

        function getData(id) {
            let url = "{{ route('regional.show', ':id') }}";

            url = url.replace(':id', id);
            axios.get(url)
                .then(response => {
                    let data = response.data;
                    data = data[0];
                    $('#name').val(data.name);
                    $("#status > option[value=" + data.status + "]").prop("selected", true);
                })
        }
        function triggerForm()
        {
            $("#form_regional_result").trigger('reset');
        }
    </script>
@stop
