@extends('area-do-cliente.template.template')
@section('style')
    <!-- favicon -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@stop
@section('miolo')
    <!-- MIOLO -->

    <section class="miolo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>
                        DESEMPENHO FÍSICO-FINANCEIRO (DFF)
                    </h1>
                    <h2>
                        CONSOLIDADO
                    </h2>

                </div>
            </div>
            <div class="row d-flex justify-content-between align-items-top">
                <div class="col-md-6">
                    <h3>
                        Obra + Taxa
                    </h3>

                    <form class="filtro flex-column d-flex" method="get" action="{{ route('client-space.construction-report') }}">
                        <label class="d-flex align-items-center">
                            Mês Referência:
                            <select name="competences" id="competences">
                                @foreach($competences as $competence)
                                    <option value="{{ $competence->id }}" {{ $actualComp ? in_array($competence->id,$actualComp) ? "selected" : "" : "" }}>
                                        {{ $competence->description }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <span>
                            INCC (N-1) = {{ $incc }}
                        </span>

                        <select class="obras constructions" multiple id="constructions">
                            <option>SELECIONE AS OBRAS PARA VISUALIZAÇÃO</option>
                            @foreach($constructions as $construction)
                                <option value="{{ $construction->id }}" {{ $actualConst ? in_array($construction->id,$actualConst) ? "selected" : "" : "" }}>
                                    {{ $construction->name }}
                                </option>
                            @endforeach
                        </select><br/>
                        <input type="submit" value="Buscar" class="btn col-md-2"/>
                    </form>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between align-items-end">
                    <div class="d-flex botoes justify-content-end align-items-center">
                        <a  href="javascript:window.print()" class="print">

                        </a>
                        <a href="{{ route('client-space.construction-report', $construction->id) }}" class="btn-relatorio">
                            RELATÓRIO DE<br>
                            PERFORMANCE DE<br>
                            ENGENHARIA (RPE)
                        </a>
                    </div>

                </div>
            </div>




            <div class="row d-flex">
                <div class="col-12">
                    <table border="0" colspan="0" rowspan="0" class="main-table">
                        <thead>
                            <tr>
                                <th colspan="4">
                                    Dados Gerais
                                </th>
                                <th>
                                    FÍSICO BANCO
                                </th>
                                <th>
                                    FÍSICO OBRA
                                </th>
                                <th>
                                    FINANCEIRO OBRA
                                </th>
                                <th rowspan="2">
                                    Docs.<br> Obra
                                </th>
                                <th rowspan="2">
                                    Det.<br> PDO.
                                </th>
                            </tr>

                            <tr>
                                <th class="n-obra">
                                    Nº Obra PDO<br>
                                    /FASE
                                </th>
                                <th >
                                   Empreendimento<br>
                                   Nome
                                </th>
                                <th>
                                    Área<br>
                                    Constr.<br>
                                    m2
                                </th>
                                <th>
                                    Nº<br>
                                    Unid.<br>
                                    Qtd.
                                </th>
                                <th>
                                    DESEMPENHO BANCO<br>
                                    Previsto (P) x Realizado (R)<br>
                                    (%) - NO ACUMULADO
                                </th>
                                <th>
                                    DESEMPENHO BANCO<br>
                                    Previsto (P) x Realizado (R)<br>
                                    (%) - NO ACUMULADO
                                </th>
                                <th>
                                    DESEMPENHO BANCO<br>
                                    Previsto (P) x Realizado (R)<br>
                                    (%) - NO ACUMULADO
                                </th>
                            </tr>
                            <tr class="linha-branca">
                                <th colspan="9">

                                </th>
                            </tr>
                            <tr class="list">
                                <th colspan="2" class="text-left">
                                    São Paulo
                                </th>

                                <th class="text-right">
                                    137.956
                                </th>
                                <th class="text-right">
                                    2.146
                                </th>
                                <th colspan="5">

                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            {{ $constLastId = 0 }}
                            @foreach($reports as $report)
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                {{ $report->work_number }}
                                            </td>
                                            <td class="text-left">
                                                {{ $report->FASE }}
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    {{ $report->construction_name }}
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    {{ number_format($report->AREACONSTRM2, 0, ',', '.') }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($report->NUNITQTD, 0, ',', ' ') }}
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FBP, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FBP, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                {{ number_format($report->FBD, 2, ',', '') }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FBR, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FBR, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FOP, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FOP, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                {{ number_format($report->FOD, 2, ',', '') }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FOR, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FOR, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FOBP, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FOBP, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                {{ number_format($report->FOBD, 2, ',', '') }}%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: {{ number_format($report->FOBR, 2, '.', '') }}%;">
                                                        <span>
                                                            {{ number_format($report->FOBR, 2, ',', '') }}%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="{{ route('client-space.construction-documents',[$report->competence_id,$report->construction_id]) }}" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('client-space.construction-detail', $report->construction_id) }}" class="det">

                                    </a>
                                </td>
                            </tr>
                            @if($report->construction_id != $constLastId)
                                <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                                <tr class="linha-cinza">
                                    <td colspan="17">

                                    </td>
                                </tr>
                            @endif
                            {{ $constLastId = $report->construction_id }}
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    @stop
