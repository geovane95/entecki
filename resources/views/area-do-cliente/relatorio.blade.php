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

                    <form class="filtro flex-column d-flex">
                        <label class="d-flex align-items-center">
                            Mês Referência:
                            <select>
                                <option>
                                    Mar/2019
                                </option>
                                <option>
                                    Mar/2019
                                </option>
                                <option>
                                    Mar/2019
                                </option>
                                <option>
                                    Mar/2019
                                </option>
                            </select>
                        </label>
                        <span>
                            INCC (N-1) = 773,52
                        </span>


                        <select class="obras" multiple>
                            <option>SELECIONE AS OBRAS PARA VISUALIZAÇÃO</option>

                            <option>
                                Obra 1
                            </option>
                            <option>
                                Obra 1
                            </option>
                            <option>
                                Obra 1
                            </option>
                            <option>
                                Obra 1
                            </option>
                            <option>
                                Obra 1
                            </option>
                        </select>
                    </form>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-between align-items-end">
                    <div class="d-flex botoes justify-content-end align-items-center">
                        <a  href="javascript:window.print()" class="print">

                        </a>
                        <a href="index.blade.php" class="btn-relatorio">
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
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>

                            <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                            <tr class="linha-cinza">
                                <td colspan="9">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>
                            <tr class="tot">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                TOT
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>
                            <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                            <tr class="linha-cinza">
                                <td colspan="9">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>


                            <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                            <tr class="linha-cinza">
                                <td colspan="9">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>


                            <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                            <tr class="linha-cinza">
                                <td colspan="9">

                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="text-left">
                                                BN12
                                            </td>
                                            <td class="text-left">
                                                1.0
                                            </td>
                                            <td class="text-left">
                                                <a href="detalhe.blade.php">
                                                    VIVA BENX NAÇÕES UNIDAS 1 E 2
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="text-right">
                                    31.536
                                </td>
                                <td class="text-right">
                                    642
                                </td>

                                <td>
                                    <table class="grafico">
                                        <tr>
                                            <td>
                                                P
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
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
                                                    <div class="percent" style="width: 50.8%;">
                                                        <span>
                                                            50.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td rowspan="2" class="delta">
                                                Δ<br>
                                                2,26%
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                R
                                            </td>
                                            <td>
                                                <div class="barra">
                                                    <div class="percent" style="width: 20.8%;">
                                                        <span>
                                                            20.8%
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                                <td>
                                    <a href="docs_obra.blade.php" class="doc">

                                    </a>
                                </td>
                                <td>
                                    <a href="detalhe.blade.php" class="det">

                                    </a>
                                </td>
                            </tr>
                            <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                            <tr class="linha-cinza">
                                <td colspan="9">

                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    @stop
