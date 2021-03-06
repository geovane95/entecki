@extends('adminlte::page')

@section('title', 'Lista de Obras')

@section('content_header')
    <h1>Lista de Obras</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader">
            <img src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif"
                 alt="preloader">
        </div>
    </div>
    <div style="display:none;" class="card">
        <div class="card-header row">
            <div align="left" class="col-md-9">
                <button type="button" name="create_business_record" id="create_business_record"
                        class="btn btn-success btn-sm">Inserir Empresa
                </button>
                <button type="button" name="create_regional_record" id="create_regional_record"
                        class="btn btn-success btn-sm">Inserir Regional
                </button>
                <button type="button" name="create_construction_record" id="create_construction_record"
                        class="btn btn-success btn-sm">Inserir Obra
                </button>
            </div>
            <div align="right" class="col-md-3">
                <a href="{{route('upload_data.index')}}" id="create_upload_record" class="btn btn-info btn-sm">Efetuar
                    Upload de Arquivos</a>
            </div>

        </div>
        <div class="card-body ">
            <table id="table_construction" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Construtora</th>
                    <th>Foto</th>
                    <th>Empresa</th>
                    <th>Regional</th>
                    <th>Usuários</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <hr/>
    @include('administrativo.construction.modal')
    @include('administrativo.construction.modalthumbnail')
    @include('administrativo.state.modal')
    @include('administrativo.city.modal')
    @include('administrativo.business.modal')
    @include('administrativo.regional.modal')
    @include('administrativo.user_to_construction.modal')


@stop

@section('css')

@stop

@section('js')
    <script>
        function cities(){
            let id = $("#state").children(":selected").attr("id");
            let url = "{{ route('cities', ':id') }}";
            url = url.replace(':id', id);

            axios.get(url)
                .then(response => {
                    var data = response.data;
                    $('#city').html('');
                    $('#city').append(`
                                    <option value="0">Selecione uma cidade</option>
                                `);
                    $.each(data, function (index, value) {
                        $('#city').append(`
                                    <option value="${index}">${value}</option>
                                `)
                    });
                })
        }
        $(document).ready(function () {

            // Listando usuarios
            $("#table_construction").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('construction.index')}}",
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
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'company', name: 'company'},
                    {data: 'picture', name: 'picture'},
                    {data: 'business-name', name: 'business'},
                    {data: 'regional-name', name: 'regional'},
                    {data: 'users-name', name: 'users-name'},
                    {data: 'status-desc', name: 'status'},
                    {data: 'action', name: 'action'}
                ]
            });

            var idObra = '';
            $('body').on('click', '.cliente', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                let url = "{{ route('client.construction.list', ':id') }}";
                url = url.replace(':id', id);
                $('#formModalUsersToConstruction').modal('show');
                $('#constructionId').val(id);
                $('#table_users_to_construction tbody').html('');
                axios.get(url)
                    .then(response => {
                        var data = response.data;
                        $.each(data, function (index, value) {
                            $('#table_users_to_construction tbody').append(`
                                <tr>
                                    <td>${value.username}</td>
                                    <td><button id="${value.userid}" class="btn btn-danger delete-user">Deletar</button></td>
                                </tr>
                            `)
                        });
                    });
                axios.get("{{ route('users.list') }}")
                    .then(response => {
                        var data = response.data;
                        $('select#user').html('');
                        $.each(data, function (index, value) {
                            $('select#user').append(`<option id="${value.id}" value="${value.id}">${value.name}</option>`);
                        });
                    });

                $('#user_form').on('submit', function (e) {
                    e.preventDefault();
                    let userId = $('#user').children(":selected").attr('id');
                    let constructionId = $('#constructionId').val();

                    let url = "{{ route('client.construction.add', [':id',':user']) }}";
                    url = url.replace(':user', userId);
                    url = url.replace(':id', constructionId);
                    axios.get(url)
                        .then(response => {
                            var data = response.data;
                            $.each(data, function (index, value) {

                                $('#table_users_to_construction tbody').append(`
                                   <tr>
                                            <td>${value.username}</td>
                                            <td><button id="${value.userid}" class="btn btn-danger delete-user">Deletar</button></td>
                                   </tr>
                               `)
                            });

                        }).finally(() => {
                            $('#table_construction').DataTable().ajax.reload();
                        });
                });

                $(document).on('click', '.delete-user', function (e) {
                    e.preventDefault();
                    let constructionid = $('#constructionId').val();
                    let userid = $(this).attr('id');
                    let url = "{{ route('client.construction.remove', [':id',':userid']) }}";

                    url = url.replace(':id', constructionid);
                    url = url.replace(':userid', userid);
                    $('#table_users_to_construction tbody').html('');
                    axios.get(url)
                        .then(response => {
                            var data = response.data;
                            $.each(data, function (index, value) {

                                $('#table_users_to_construction tbody').append(`
                                   <tr>
                                            <td>${value.username}</td>
                                            <td><button id="${value.userid}" class="btn btn-danger delete-user">Deletar</button></td>
                                   </tr>
                               `)
                            });

                        }).finally(() => {
                            $('#table_construction').DataTable().ajax.reload();
                        });
                });
            });

            //cadastrando uma obra
            $('#create_construction_record').on('click', function (e) {
                e.preventDefault();

                clear();
                clearError();
                triggerForm();

                $('#formModalConstruction').modal('show');
                $('#modal-construction-title').append('Cadastrar Obra');
                $('#action_construction_button').val("Cadastrar");
                $('#action_construction_button').addClass('btn-primary');

                $('#construction_form').on('submit', function (e) {
                    e.preventDefault();

                    /*
                    let formElement = document.querySelector('#construction_form');
                    let dataForm = new FormData(formElement);
                    var imagefile = document.querySelector('#thumbnail');
                    dataForm.append("image", imagefile.files[0]);

                    axios.post(`{{route('construction.store')}}`, dataForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    */
                    axios.post(`{{route('construction.store')}}`, $('#construction_form').serialize())
                        .then((response) => {
                            if (response.data.success) {
                                $('#construction_form_result').html(
                                    `<div class="alert alert-success">
                                        <p>Sucesso ao cadastrar nova obra !</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    clearError();
                                    triggerForm();
                                    $('#formModalConstruction').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {
                        let errors = error.response;
                        errors = errors.data.errors;

                        if (errors.name) {
                            $('#nameError').html(errors.name);
                        }
                        if (errors.company) {
                            $('#companyError').html(errors.company);
                        }

                        if (errors.responsible) {
                            $('#responsibleError').html(errors.responsible);
                        }

                        if (errors.cnpj) {
                            $('#cnpjError').html(errors.cnpj);
                        }

                        if (errors.business) {
                            $('#businessError').html(errors.business);
                        }

                        if (errors.regional) {
                            $('#regionalError').html(errors.regional);
                        }

                        if (errors.neighborhood) {
                            $('#neighborhoodError').html(errors.neighborhood);
                        }

                        if (errors.zipCode) {
                            $('#zipCodeError').html(errors.zipCode);
                        }

                        if (errors.street) {
                            $('#streetError').html(errors.street);
                        }

                        if (errors.number) {
                            $('#numberError').html(errors.number);
                        }

                        if (errors.contract_regime) {
                            $('#contract_regimeError').html(errors.contract_regime);
                        }

                        if (errors.reporting_regime) {
                            $('#reporting_regimeError').html(errors.reporting_regime);
                        }

                        if (errors.work_number) {
                            $('#work_numberError').html(errors.work_number);
                        }
                        errors = {};
                    }).finally(() => {
                        $('#table_construction').DataTable().ajax.reload();
                        location.reload();
                    });

                });
            });

            //cadastrando um responsável
            $('#create_business_record').on('click', function (e) {
                e.preventDefault();

                clear();
                clearError();
                triggerForm();

                $('#formModalBusiness').modal('show');
                $('#modal-business-title').append('Cadastrar Empresa');
                $('#action_business_button').val("Cadastrar");
                $('#action_business_button').addClass('btn-primary');

                $('#business_form').on('submit', function (e) {
                    e.preventDefault();

                    let dataForm = $('#business_form').serialize();

                    axios.post(`{{route('business.store')}}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
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
                                location.reload();
                            }
                        }).catch((error) => {
                        let errors = error.response.data.errors;

                        if (errors.business_name) {
                            $('#business_nameError').html(errors.business_name);
                        }
                    }).finally(() => {

                    });

                });
            });


            //cadastrando um regional
            $('#create_regional_record').on('click', function (e) {
                e.preventDefault();

                clear();
                clearError();
                triggerForm();

                $('#formModalRegional').modal('show');
                $('#modal-regional-title').append('Cadastrar Responsável');
                $('#action_regional_button').val("Cadastrar");
                $('#action_regional_button').addClass('btn-primary');

                $('#regional_form').on('submit', function (e) {
                    e.preventDefault();

                    let dataForm = $('#regional_form').serialize();

                    axios.post(`{{route('regional.store')}}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
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
                                location.reload();
                            }
                        }).catch((error) => {
                        let errors = error.response.data.errors;

                        if (errors.name) {
                            $('#regionalNameError').html(errors.name);
                        }
                    }).finally(() => {

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

                $('#formModalConstruction').modal('show');

                $('#formModalConstruction').modal('show');
                $('#modal-construction-title').append('Editar Obra');
                $('#action_construction_button').val("Salvar");
                $('#action_construction_button').addClass('btn-primary');

                getData(id);


                //enviando os dados

                $('#construction_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let dataForm = $('#construction_form').serialize();

                    axios.put(`/home/construction/${id}`, dataForm)
                        .then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#construction_form_result').html(
                                    `<div class="alert alert-success">
                                        <p>Sucesso ao Atualizar Obra!</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalConstruction').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {

                        let errors = error.response.data.errors;

                        if (errors.name) {
                            $('#nameError').html(errors.name);
                        }
                        if (errors.company) {
                            $('#companyError').html(errors.company);
                        }

                        if (errors.responsible) {
                            $('#responsibleError').html(errors.responsible);
                        }

                        if (errors.regional) {
                            $('#regionalError').html(errors.regional);
                        }

                        if (errors.neighborhood) {
                            $('#neighborhoodError').html(errors.neighborhood);
                        }

                        if (errors.zipCode) {
                            $('#zipCodeError').html(errors.zipCode);
                        }

                        if (errors.street) {
                            $('#streetError').html(errors.street);
                        }

                        if (errors.number) {
                            $('#numberError').html(errors.number);
                        }

                        if (errors.contract_regime) {
                            $('#contract_regimeError').html(errors.contract_regime);
                        }

                        if (errors.reporting_regime) {
                            $('#reporting_regimeError').html(errors.reporting_regime);
                        }

                        if (errors.issuance_date) {
                            $('#issuance_dateError').html(errors.issuance_date);
                        }

                        if (errors.work_number) {
                            $('#work_numberError').html(errors.work_number);
                        }
                        errors = {};
                    }).finally(() => {
                        $('#table_construction').DataTable().ajax.reload();
                        location.reload();
                    });


                });


            });

            $('body').on('click', '.delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('id');
                if (confirm('Você tem certeza que deseja excluir essa obra?')) {

                    axios.delete(`/home/construction/${id}`)
                        .then(response => {
                            console.log(response.status == 201);
                            if (response.status == 201) {
                                alert('Obra Excluida com sucesso.');
                                $('#table_construction').DataTable().ajax.reload();
                            }
                        })

                }


            });


            //dps de carregar os ajax das páginas
            $(document).ajaxComplete(function () {
                $('#preloader').hide();
                $('.card').show();
            });


            $("#list_cities").click(function () {
                window.location = '{{ route('city.index') }}';
            });

            $("#list_states").click(function () {
                window.location = '{{ route('state.index') }}';
            });

            $("#list_businesses").click(function () {
                window.location = '{{ route('business.index') }}';
            });

            $("#list_regionals").click(function () {
                window.location = '{{ route('regional.index') }}';
            });

            function getData(id) {
                let url = "{{ route('construction.show', ':id') }}";

                url = url.replace(':id', id);
                axios.get(url)
                    .then(response => {
                        let data = response.data;

                        console.log(data);
                        $('#name').val(data.name);
                        $('#company').val(data.company);
                        $('#responsible').val(data.responsible);
                        $('#cnpj').val(data.cnpj);
                        $("#business > option[value=" + data.business.id + "]").prop("selected", true);
                        $("#regional > option[value=" + data.regional + "]").prop("selected", true);
                        $('#street').val(data.address.street);
                        $('#number').val(data.address.number);
                        $('#neighborhood').val(data.location.neighborhood);
                        $('#zipCode').val(cep(data.location.zipCode));
                        $("#state > option[value=" + data.city.state + "]").prop("selected", true);
                        cities();
                        setTimeout(function(){ $("#city > option[value=" + data.location.city + "]").prop("selected", true);}, 1000);

                        $('#contract_regime').val(data.contract_regime);
                        $('#reporting_regime').val(data.reporting_regime);
                        $('#work_number').val(data.work_number);
                        $('#issuance_date').val(data.issuance_date);

                    })
            }

            $('body').on('click', '.thumbnail', function (e) {
                let id = $(this).attr('id');
                console.log(id);

                $('#formModalConstructionThumbnail').modal('show');
                $('#modal-constructionthumbnail-title').append('Editar Foto da Obra');
                $('#action_constructionthumbnail_button').val("Salvar");
                $('#action_constructionthumbnail_button').addClass('btn-primary');

                //enviando os dados

                $('#construction_thumbnail_form').on('submit', function (e) {
                    e.preventDefault();

                    clearError();
                    let formElement = document.querySelector('#construction_thumbnail_form');
                    let dataForm = new FormData(formElement);
                    var imagefile = document.querySelector('#thumbnail');
                    dataForm.append("image", imagefile.files[0]);

                    let route = `{{route('construction.updateThumbnail',':id')}}`;

                    axios.post(route.replace(':id',id),dataForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then((response) => {
                            console.log(response.data.success);
                            if (response.data.success) {
                                $('#construction_form_result').html(
                                    `<div class="alert alert-success">
                                        <p>Sucesso ao Atualizar a Foto da Obra!</p>
                                    </div>`
                                );

                                setTimeout(() => {
                                    clear();
                                    triggerForm();
                                    $('#formModalConstructionThumbnail').modal('hide');
                                }, 1000);
                            }
                        }).catch((error) => {
                            console.log(error);
                        }).finally(() => {
                            $('#table_construction').DataTable().ajax.reload();
                            location.reload();
                        });


                });


            });
        });

        function mascaraMutuario(o) {
            v_obj = o;
            setTimeout('execmascara()', 1)
        }

        function mascaraMutuarioCep(o) {
            v_obj = o;
            setTimeout('execmascaraCep()', 1)
        }

        function execmascara() {
            v_obj.value = cnpj(v_obj.value)
        }

        function execmascaraCep() {
            v_obj.value = cep(v_obj.value)
        }

        function cnpj(v) {

            //Remove tudo o que não é dígito
            v = v.replace(/\D/g, "")

            //Coloca ponto entre o segundo e o terceiro dígitos
            v = v.replace(/^(\d{2})(\d)/, "$1.$2")

            //Coloca ponto entre o quinto e o sexto dígitos
            v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")

            //Coloca uma barra entre o oitavo e o nono dígitos
            v = v.replace(/\.(\d{3})(\d)/, ".$1/$2")

            //Coloca um hífen depois do bloco de quatro dígitos
            v = v.replace(/(\d{4})(\d)/, "$1-$2")

            return v

        }

        function cep(v) {
            //Remove tudo o que não é dígito
            v = v.replace(/\D/g, "");

            //Coloca ponto entre o segundo e o terceiro dígitos
            v = v.replace(/^(\d{5})(\d)/, "$1-$2");

            return v;
        }

        function clearError() {
            $('#nameError').html('');
            $('#companyError').html('');
            $('#responsibleError').html('');
            $('#cnpjError').html('');
            $('#company_nameError').html('');
            $('#neighborhoodError').html('');
            $('#zipCodeError').html('');
            $('#streetError').html('');
            $('#numberError').html('');
            $('#contract_regimeError').html('');
            $('#reporting_regimeError').html('');
            $('#issuance_dateError').html('');
            $('#work_numberError').html('');
        }

        function clear() {
            $('#action_construction_button').val('');
            $('#action_state_button').val('');
            $('#action_city_button').val('');
            $('#modal-construction-title').html('');
            $('#modal-state-title').html('');
            $('#modal-city-title').html('');
            $('#action_construction_button').removeClass('btn-primary');
            $('#action_state_button').removeClass('btn-primary');
            $('#action_city_button').removeClass('btn-primary');
            $('#action_construction_button').removeClass('btn-warning');
            $('#action_state_button').removeClass('btn-warning');
            $('#action_city_button').removeClass('btn-warning');
            $('#form_construction_result').html('');
            $('#form_state_result').html('');
            $('#form_city_result').html('');
        }

        function triggerForm() {
            $("#construction_form").trigger('reset');
            $("#state_form").trigger('reset');
            $("#city_form").trigger('reset');
        }
    </script>
@stop
