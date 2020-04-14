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

    <div class="row">
        <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            MÊS REFERÊNCIA <select name="competence" id="competence" class="form-control col-md-3">
                @foreach($competences as $competence)
                    <option value="{{ $competence->id }}" {{ $competence->id == $competenceSelected ? "selected" : ""}}>{{ $competence->description }}</option>
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
            <div style="display:none;" id="preloader">
                <img  src="https://mk0supsystic186fa3rj.kinstacdn.com/wp-content/uploads/2018/09/upload-file-feature-contact-form-300x300.gif" alt="preloader" style="width: 50px;">
            </div>
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
                let ids = $(".chkdata:checked").map(function(){return $(this).attr('id').replace('id_','')});
                let url = "{{ route('email.store', ':data') }}";
                url = url.replace(":data", Object.values(ids));
                url = url.replace(/,\d+\,\[object Object]/gm,"");

                $("#preloader").show();
                axios.get(url)
                .then((success) => {
                    let data = success.data;

                    alert('E-mails enviados com sucesso para os responsáveis');
                    location.reload();
                })
                .catch((error) => {
                    alert('Não foi possível realizar o envio do e-mail!')
                })
                .finally(() =>{
                    $("#preloader").hide();
                });
            });

            $("#competence").change(function () {
                let id = $(this).val();
                let url = "{{ route('email.index.args', ':id') }}";
                url = url.replace(':id', id);

                window.location.href = url;
            });
        });
    </script>
@stop
