@extends('area-do-cliente.template.template')
@section('miolo')

    <section class="miolo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--<h1>
                        1.0 - RPE
                    </h1>-->
		    <h1>
			RELATÓRIO DE PERFORMANCE DE ENGENHARIA(RPE)
		    </h1>
                    <h2>
                        INDICADORES DE OBRA
                    </h2>

                </div>
            </div>
            <div class="row d-flex justify-content-between align-items-top">
                <div class="col-md-6">
                    <h3>
                        Custo Raso + Taxa
                    </h3>

                    <form class="filtro flex-column d-flex" id="filtros">
                        <label class="d-flex align-items-center">
                            Mês Referência:
                            <select name="competences" id="competences">
                                @foreach($competences as $competence => $competencedesc)
                                    <option
                                        value="{{ $competence }}" {{ in_array($competence,$competencesselected) ? "selected" : "" }}>
                                        {{ $competencedesc }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <span>
                        INCC (N-1) = {{ $incc }}


                        <a href="#" class="showhide"></a>
                    </span>
                        <select class="obras regionals" multiple id="regionals" name="regionals">
                            <option value="0">SELECIONE UM REGIONAL PARA VISUALIZAÇÃO</option>
                            @foreach($regionals as $regional => $regionalname)
                                <option
                                    value="{{ $regional }}" {{ in_array($regional,$regionalsselected) ? "selected" : "" }}>
                                    {{ $regionalname }}
                                </option>
                            @endforeach
                        </select>

                        <select class="obras constructions" multiple id="constructions" name="constructions">
                            <option value="0">SELECIONE AS OBRAS PARA VISUALIZAÇÃO</option>
                            @foreach($constructions as $construction)
                                <option
                                    value="{{ $construction->id }}" {{ in_array($construction->id,$constructionsselected) ? "selected" : "" }}>
                                    {{ $construction->name }}
                                </option>
                            @endforeach
                        </select>

                        <select class="obras businesses" multiple id="businesses" name="businesses">
                            <option value="0">SELECIONE AS EMPRESAS PARA VISUALIZAÇÃO</option>
                            @foreach($businesses as $business => $businessname)
                                <option
                                    value="{{ $business }}" {{ in_array($business,$businessesselected) ? "selected" : "" }}>
                                    {{ $businessname }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between align-items-end">
                    <div class="d-flex botoes justify-content-end align-items-center">
                        <a href="javascript:window.print()" class="print"></a>
                        <a href="{{ route('client-space.construction-report') }}" class="btn-relatorio">
                            DESEMPENHO <br>
                            FÍSICO-FINANCEIRO <br>
                            CONSOLIDADO
                        </a>
                    </div>


                    <ul class="legenda">
                        <li>
                            Condições Ideiais
                        </li>
                        <li>
                            Estado de Alerta
                        </li>
                        <li>
                            Condições Críticas
                        </li>
                    </ul>

                </div>
            </div>


            <div class="row d-flex">
                <div class="col-12">
                    <table border="0" colspan="0" rowspan="0" class="main-table">
                        <thead>
                        <tr>
                            <th colspan="5">
                                Dados Gerais
                            </th>
                            <th colspan="2">
                                Custo Obra Rev.
                            </th>
                            <th colspan="2">
                                Fluxo Desembolso
                            </th>
                            <th>
                                Físico
                            </th>
                            <th colspan="2">
                                Prazo Obra
                            </th>
                            <th>
                                Qual.
                            </th>
                            <th>
                                Seg./Org.
                            </th>
                            <th>
                                Contrat.
                            </th>
                            <th>
                                A Const.
                            </th>
                            <th>
                                A Privat.
                            </th>
                            <th rowspan="3">
                                Docs.<br> Obra
                            </th>
                            <th rowspan="3">
                                Det.<br> PDO.
                            </th>
                        </tr>

                        <tr>
                            <th class="n-obra" rowspan="2" colspan="2">
                                Nº Obra PDO<br>
                                /FASE
                            </th>
                            <th rowspan="2">
                                Empreendimento<br>
                                Nome
                            </th>
                            <th rowspan="2">
                                Área<br>
                                Constr.<br>
                                m2
                            </th>
                            <th rowspan="2">
                                Nº<br>
                                Unid.<br>
                                Qtd.
                            </th>
                            <th colspan="2">
                                Variação (+Eco.)
                            </th>
                            <th colspan="2">
                                Variação (+Eco.)
                            </th>
                            <th rowspan="2">
                                Δ (+ Eco)<br>
                                [P-R]<br>
                                Δ%
                            </th>

                            <th rowspan="2">
                                Ter. Obra<br>
                                R/Proj.<br>
                                Mês
                            </th>

                            <th rowspan="2">
                                Δ (- Eco)<br/>
                                [P-R]<br/>
                                Δ Dias
                            </th>

                            <th rowspan="2">
                                IDQ<br>
                                Obra<br>
                                Indicador
                            </th>

                            <th rowspan="2">
                                IDS<br>
                                Obra<br>
                                Indicador
                            </th>

                            <th rowspan="2">
                                %<br>
                                Contratado<br>
                                Indicador
                            </th>

                            <th rowspan="2">
                                Orc. Proj.<br>
                                Atualizado<br>
                                R$/m2
                            </th>

                            <th rowspan="2">
                                Orc. Proj.<br>
                                Atualizado<br>
                                R$/m2
                            </th>

                        </tr>
                        <tr>
                            <th>
                                [P-R]<br/>
                                Δ R$ (Atual)
                            </th>
                            <th>
                                [1 - R/P]<br/>
                                Δ R$ (Atual)
                            </th>
                            <th>
                                [P-R]<br>
                                Δ R$ (Atual)
                            </th>
                            <th>
                                [1 - R/P]<br>
                                Δ R$ (Atual)
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="linha-branca">
                            <th colspan="17">

                            </th>
                        </tr>
                        <tr class="list fullList">
                            <th colspan="3" class="text-left">
                                Obras
                            </th>

                            <th class="text-right">
                                {{ number_format($somageral->AREACONSTRM2, 0, ',', '.') }}
                            </th>
                            <th class="text-right">
                                {{ number_format($somageral->NUNITQTD, 0, ',', '.') }}
                            </th>

                            <th class="text-right">
                                ({{ number_format($somageral->CORPRRATUAL, 0, ',', '.') }})
                            </th>
                            <!--  GEOVANE, CONFERIR MUDANCAS inseri a classe text-center -->
                            <th class="text-center">
                                            <span class="leg {{ $cores[strtoupper($somageral->CORRPRATUALFAROL)]['FAROL'] }}">

                                            </span>
                                {{ $somageral->CORRPRATUALVLR }}
                            </th>
                            <th colspan="14">

                            </th>
                        </tr>
                        @foreach($dados as $dado)
                            @if(count($dado->constructions) > 0)
                                <tr class="list">
                                    <th colspan="3" class="text-left">
                                        {{ $dado->name }}
                                    </th>

                                    <th class="text-right">
                                        {{ number_format($dado->AREACONSTRM2, 0, ',', '.') }}
                                    </th>
                                    <th class="text-right">
                                        {{ number_format($dado->NUNITQTD, 0, ',', '.') }}
                                    </th>

                                    <th class="text-right">
                                        ({{ number_format($dado->CORPRRATUAL, 0, ',', '.') }})
                                    </th>
                                    <!--  GEOVANE, CONFERIR MUDANCAS inseri a classe text-center -->
                                    <th class="text-center">
                                            <span class="leg {{ $cores[strtoupper($dado->CORRPRATUALFAROL)]['FAROL'] }}">

                                            </span>
                                        {{ $dado->CORRPRATUALVLR }}
                                    </th>
                                    <th colspan="14">

                                    </th>
                                </tr>
                                @php
                                    $auxidobra = 0;
                                @endphp
                                @foreach($dado->constructions as $constructiontable)
                                    @if($auxidobra != 0 && $auxidobra != $constructiontable->construction_id)
                                        <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                                        <tr class="linha-cinza">
                                            <td colspan="19">

                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="text-left">
                                            {{ $constructiontable->work_number }}
                                        </td>
                                        <td class="text-left">
                                            {{ $constructiontable->FASE }}
                                        </td>
                                        <td class="text-left">
                                            <a href="{{ route('client-space.construction-detail', [$constructiontable->construction_id, $constructiontable->competence_id]) }}">
                                                {{ $constructiontable->construction_name }}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($constructiontable->AREACONSTRM2, 0, ',', '.') }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($constructiontable->NUNITQTD, 0, ',', '.') }}
                                        </td>

                                        <td class="text-right">
                                            ({{ number_format($constructiontable->CORPRRATUAL, 0, ',', '.') }})
                                        </td>
                                        <td>
                                            <span class="leg {{ $cores[strtoupper($constructiontable->CORRPRATUALFAROL)]['FAROL'] }}">

                                            </span>
                                            {{ $constructiontable->CORRPRATUALVLR }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($constructiontable->FXDPRRATUAL, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="leg {{ $cores[strtoupper($constructiontable->FXDRPRATUALFAROL)]['FAROL'] }}">

                                            </span>
                                            {{ $constructiontable->FXDRPRATUALVLR }}%
                                        </td>
                                        <td>
                                        <span class="leg {{ $cores[strtoupper($constructiontable->FPRPRFAROL)]['FAROL'] }}">

                                        </span>
                                            {{ $constructiontable->FPRPR }}%
                                        </td>
                                        <td>
                                        <span class="leg {{ $cores[strtoupper($constructiontable->POTEROBRARPMESFAROL)]['FAROL'] }}">

                                        </span>
                                            {{ $constructiontable->POTEROBRARPMES }}
                                        </td>
                                        <td>
                                            {{ $constructiontable->POECOPR }}
                                        </td>
                                        <td>
                                        <span class="leg {{ $cores[strtoupper($constructiontable->IDQFAROL)]['FAROL'] }}">

                                        </span>
                                        </td>
                                        <td>
                                        <span class="leg {{ $cores[strtoupper($constructiontable->IDSFAROL)]['FAROL'] }}">

                                        </span>
                                        </td>
                                        <td>
                                            {{ $constructiontable->PORCCONTRATINDIC }}%
                                        </td>
                                        <td>
                                            {{ $constructiontable->ACORCPROOJATUAL }}
                                        </td>
                                        <td>
                                            {{ $constructiontable->APORCPROOJATUAL }}
                                        </td>
                                        <td>
                                            <a href="{{ route('client-space.construction-documents', [$constructiontable->competence_id,$constructiontable->construction_id]) }}"
                                               class="doc">

                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('client-space.construction-detail', [$constructiontable->construction_id, $constructiontable->competence_id]) }}"
                                               class="det">

                                            </a>
                                        </td>
                                    </tr>
                                    @php($auxidobra = $constructiontable->construction_id)
                                @endforeach
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $("#competences").change(function () {
                let formData = "";
                formData += "competences=" + $("#competences").val();
                formData += "&regionals=" + $("#regionals").val();
                formData += "&constructions=" + $("#constructions").val();
                let url = "{{route('client-space.index', ':formData')}}";
                window.location.href = url.replace(':formData', formData);
            });
            $("#constructions").change(function () {
                let formData = "";
                formData += "competences=" + $("#competences").val();
                formData += "&regionals=" + $("#regionals").val();
                formData += "&constructions=" + $("#constructions").val();
                formData += "&businesses=" + $("#businesses").val();
                let url = "{{route('client-space.index', ':formData')}}";
                window.location.href = url.replace(':formData', formData);
            });
            $("#regionals").change(function () {
                let formData = "";
                formData += "competences=" + $("#competences").val();
                formData += "&regionals=" + $("#regionals").val();
                formData += "&constructions=" + $("#constructions").val();
                formData += "&businesses=" + $("#businesses").val();
                let url = "{{route('client-space.index', ':formData')}}";
                window.location.href = url.replace(':formData', formData);
            });
            $("#businesses").change(function () {
                let formData = "";
                formData += "competences=" + $("#competences").val();
                formData += "&regionals=" + $("#regionals").val();
                formData += "&constructions=" + $("#constructions").val();
                formData += "&businesses=" + $("#businesses").val();
                let url = "{{route('client-space.index', ':formData')}}";
                window.location.href = url.replace(':formData', formData);
            });
            $(".doc").click(function () {
                let id = $(this).attr('id');
                let comp_id = $(this).attr('data-id');

                let url = "{{ route('client-space.construction-documents', [':comp_id',':id']) }}";
                url = url.replace(':id', id);
                url = url.replace(':comp_id', comp_id);

                window.location.href = url;
            });



            $('.miolo .filtro select.obras').prop('disabled', function(i, v) { return !v; });
            $(document).delegate('.miolo .filtro span a.showhide', 'click', function(event) {
                event.preventDefault();
                $('.miolo .filtro').toggleClass('open');
                $('.miolo .filtro select.obras').prop('disabled', function(i, v) { return !v; });
            });
        });
    </script>
@stop
