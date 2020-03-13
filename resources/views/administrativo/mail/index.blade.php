@extends('adminlte::page')

@section('title', 'Envio de Emails de Obras')

@section('content_header')
    <h1>Envio de Emails de Obras</h1>
    <style>
        i.vermelho{
            color: red !important;
        }
        i.amarelo{
            color: yellow !important;
        }
        i.verde{
            color: limegreen !important;
        }
    </style>
@stop

@section('content')

    <div class="container-fluid">
        <div style="display:none;" id="preloader" >
            <img  src="https://bombeirocivilonline.com.br/themes/frontend/fireman/assets/mvs/img/loading7_blue.gif" alt="preloader">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            MÊS REFERÊNCIA <select name="competence" id="competence" class="form-control col-md-3">
                @foreach($competences as $competence)
                    <option value="{{ $competence->id }}">{{ $competence->description }}</option>
                @endforeach
            </select>
            <hr/>
            <input type="checkbox" name="selectall" id="selectall"> SELECIONAR TODOS
        </div>
        <div class="card-body ">
            <table  id="table_emails" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th colspan="6">DADOS GERAIS</th>
                    <th colspan="7">INDICADORES OBRA</th>
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="2">Nº Obra/FASE</td>
                    <td>Empreendimento</td>
                    <td>Área Constr. m²</td>
                    <td>Nº Unid. Qtd.</td>
                    <td>Custo P.</td>
                    <td>Prazo</td>
                    <td>Fluxo D.</td>
                    <td>Qualidade</td>
                    <td>Seg.Org.</td>
                    <td>M.Ambi.</td>
                    <td>Acum.Contr.</td>
                    <td>E-mail enviado</td>
                </tr>
                </thead>
                <tbody>
                @foreach($constructions as $construction)
                <tr>
                    <td><input type="checkbox" name="id" id="id_{{ $construction->data_id }}" class="chkdata"></td>
                    <td>{{ $construction->work_number }}</td>
                    <td>{{ $construction->FASE }}</td>
                    <td>{{ $construction->construction_name }}</td>
                    <td>{{ $construction->AREACONSTRM2 }}</td>
                    <td>{{ $construction->NUNITQTD }}</td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->CUSTOP)]['FAROL'] }}"></i></td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->PRAZO)]['FAROL'] }}"></i></td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->FLUXOD)]['FAROL'] }}"></i></td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->QUALIDADE)]['FAROL'] }}"></i></td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->SEGORG)]['FAROL'] }}"></i></td>
                    <td><i class="fas fa-circle {{ $cores[strtoupper($construction->MAMBI)]['FAROL'] }}"></i></td>
                    <td>{{ $construction->ACUMCONTR }}%</td>
                    <td>{{ $construction->email_sended_at }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

        <br />
        <div align="center">
            <button type="button" name="enviar" id="enviar" class="btn btn-success">ENVIAR</button>
        </div>

    </div>
        </div>
    </div>
    <hr/>


@stop

@section('css')

@stop

@section('js')
    <script>


        $(document).ready(function(){

            $("#selectall").change(function () {
                $(".chkdata").prop("checked","true");
            });

            $(".chkdata").click(function () {
                if($(this).prop("checked") === "false"){
                    $("#selectall").prop("checked","false");
                }
            });

            $("#enviar").click(function () {
                ids = $(".chkdata:checked").map(function(){return $(this).attr('id').replace('id_','')});
                competence = $("#competence").val();
                url = "{{ route('email.store', [':competence',':constructions']) }}";
                url = url.replace(":competence",competence);
                url = url.replace(":constructions", Object.values(ids));
                console.log(url);
                window.location.href = url;
            });
        });
    </script>
@stop
