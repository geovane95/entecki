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
    <section class="miolo detalhe">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <!--<h1>
                        3.0 - PDO
                    </h1>-->
                    <h1>
                        PAINEL DE DESEMPENHO DA OBRA (PDO)
                    </h1>

                </div>
                <div class="col-md-3 d-flex flex-column justify-content-between align-items-end">
                    <div class="d-flex botoes justify-content-end align-items-center">
                        <a href="javascript:window.print()" class="print">

                        </a>
                    </div>
                </div>
            </div>


            <div class="row d-flex">
                <div class="col-md-4 col-lg-3">
                    <figure>
                        <img src="{{asset('public/images/constructions/'.$details->thumbnail)}}"
                             alt="{{ $details->construction_name }}" title="{{ $details->construction_name }}"/>
                    </figure>
                </div>
                <div class="col-md-8 col-lg-9 pl0 d-flex flex-column justify-content-between">
                    <div class="title-info d-flex justify-content-between align-items-center">
                        <div>
                            <h2>
                                {{ $details->construction_name }}
                            </h2>
                            <h3>
                                CONSTRUTORA: {{ $details->company }}
                            </h3>
                        </div>
                        <div class="botoes d-flex align-items-center">
                            <a href="{{ route('client-space.construction-documents', [$details->competence_id, $details->construction_id])  }}"
                               class="doc">
                                <i></i>
                                Documentos
                            </a>
                            @if($picture)
                                <a href="{{ route('client-space.pictures-download', $picture->id) }}" target="_blank"
                                   class="pic">
                                    <i></i>
                                    Fotos
                                </a>
                            @endif
                            @if($report)
                                <a href="{{ route('client-space.report-download', $report->id) }}" target="_blank"
                                   class="rel">
                                    <i></i>
                                    Relatório
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="info-geral d-flex align-items-center justify-content-between">
                        <div class="lists d-flex align-items-stretch">
                            <ul>
                                <li>
                                    <strong>LOCAL/REGIÃO:</strong> {{ $details->neighborhood }}
                                </li>
                                <li>
                                    <strong>CIDADE/ESTADO:</strong> {{ $details->city."/".$details->state }}
                                </li>
                                <li>
                                    <strong>RAZÃO SOCIAL:</strong> {{ $details->responsible_name }}
                                </li>
                                <li>
                                    <strong>CNPJ DA
                                        SPE:</strong> {{ substr($details->responsible_cnpj,0,2).".".substr($details->responsible_cnpj,2,3).".".substr($details->responsible_cnpj,5,3)."/".substr($details->responsible_cnpj,8,4)."-".substr($details->responsible_cnpj,12,2) }}
                                </li>
                                <li>
                                    <strong>ENDEREÇO:</strong> {{ $details->street.", ".$details->number }}
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <strong>REGIME CONTRATO:</strong> {{ $details->contract_regime }}
                                </li>
                                <li>
                                    <strong>REGIME RELATÓRIO:</strong> {{ $details->report_regime }}
                                </li>
                                <li>
                                    <strong>DATA EMISSÃO:</strong> {{ $details->DATAEMISSAO }}
                                </li>
                                <li>
                                    <strong>OBRA Nº:</strong> {{ $details->work_number }}
                                </li>
                            </ul>
                        </div>


                        <form class="filtro flex-column d-flex">
                            <label class="d-flex align-items-center">
                                Mês Referência:
                                <select name="competences" id="competences">
                                    @foreach($competences as $competence)
                                        <option
                                            value="{{ $competence->id }}" {{ $competence->id == $competencesselected ? "selected" : "" }}>
                                            {{ $competence->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <h4>
                                <strong>STATUS DA
                                    OBRA:</strong> {{ $details->construction_status ? 'Em Andamento' : 'Encerrada' }}
                            </h4>
                        </form>
                    </div>

                    <div class="indicadores ">
                        <div class="ttl d-flex align-items-center justify-content-between">
                            <h3>
                                INDICADORES OBRA
                            </h3>

                            <h3>
                                ACUM. CONTR.: {{ $details->ACUMCONTR }}%
                            </h3>

                        </div>
                        <table border="0" colspan="0" rowspan="0" class="ind">
                            <thead>
                            <tr>
                                <th>
                                    Custo P.
                                </th>
                                <th>
                                    Prazo
                                </th>
                                <th>
                                    Fluxo D.
                                </th>
                                <th>
                                    Qualidade
                                </th>
                                <th>
                                    Seg./Org.
                                </th>
                                <th>
                                    M. Ambi.
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->CUSTOP)]['FAROL'] }}">

                                        </span>
                                </td>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->PRAZO)]['FAROL'] }}">

                                        </span>
                                </td>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->FLUXOD)]['FAROL'] }}">

                                        </span>
                                </td>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->QUALIDADE)]['FAROL'] }}">

                                        </span>
                                </td>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->SEGORG)]['FAROL'] }}">

                                        </span>
                                </td>
                                <td>
                                        <span class="leg {{ $cores[strtoupper($details->MAMBI)]['FAROL'] }}">

                                        </span>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>


            <div class="row tabelas-pad">
                <div class="col-md-6">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="3" class="text-left">
                                ÁREAS DO EMPREENDIMENTO
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Área Terreno:
                            </td>
                            <td class="text-right">
                                {{ number_format($details->AREATERRENO,2,',','.') }} m²
                            </td>
                            <td class="text-right">
                                <!--(Proj.Pref.)-->{{ "R$ " . number_format($details->ACOFPROJCUSTO/$details->AREATERRENO,2,',','.') . " p/m²"}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Área Construída:
                            </td>
                            <td class="text-right">
                                {{ number_format($details->AREACONSTRUIDA,2,',','.') }} m²
                            </td>
                            <td class="text-right">
                                <!--(Proj.Pref.)-->{{ "R$ " . number_format($details->ACOFPROJCUSTO/$details->AREACONSTRUIDA,2,',','.') . " p/m²"}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Área Privativa:
                            </td>
                            <td class="text-right">
                                {{ number_format($details->AREAPRIVATIVA,2,',','.') }} m²
                            </td>
                            <td class="text-right">
                                <!--(Col.23)-->{{ "R$ " . number_format($details->ACOFPROJCUSTO/$details->AREAPRIVATIVA,2,',','.') . " p/m²"}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Área Equiv. NB:
                            </td>
                            <td class="text-right">
                                {{ number_format($details->AREAEQUIVNB,2,',','.') }} m²
                            </td>
                            <td class="text-right">
                                <!--(Col.18)-->{{ "R$ " . number_format($details->ACOFPROJCUSTO/$details->AREAEQUIVNB,2,',','.') . " p/m²"}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Área de Garagem
                            </td>
                            <td class="text-right">
                                {{ number_format($details->AREADEGARGAGEM,2,',','.') }} m²
                            </td>
                            <td class="text-right">
                                <!--(Proj.Pref.)-->{{ "R$ " . number_format($details->ACOFPROJCUSTO/$details->AREADEGARGAGEM,2,',','.') . " p/m²"}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Eficiê. Proj.:
                            </td>
                            <td class="text-right">
                                {{ number_format($details->EFECIEPROJ,2,',','.') }}
                            </td>
                            <td class="text-right">
                                Relação AP/AC{{-- "R$ " . number_format($details->ACOFPROJCUSTO/$details->EFECIEPROJ,2,',','.')--}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-center">
                                INFORMAÇÕES GERAIS DO EMPREENDIMENTO
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Tipo Empreend.:
                            </td>
                            <td class="text-right">
                                {{ $details->TIPOEMPREEND }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Sist. Construtivo:
                            </td>
                            <td class="text-right">
                                {{ $details->SISTCONSTRUTIVO }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Nº de Torre + Pvtos:
                            </td>
                            <td class="text-right">
                                {{ $details->NDETORRESPVTOS }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Nº Pvtos Gargagem:
                            </td>
                            <td class="text-right">
                                {{ $details->NPVTOSGARGAGEM }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                N° Unidades:
                            </td>
                            <td class="text-right">
                                {{ $details->NUNIDADES }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Área apartamentos:
                            </td>
                            <td class="text-right">
                                {{ $details->AREAAPARTAMENTOS }} m2
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-12">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-left">
                                AGENTE FINANCEIRO: {{ $details->AGENTEFINANCEIRO }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Data Vistoria: {{ $details->DATAVISTORIA }}
                            </td>
                            <td class="text-center">
                                Valor Financiamento.: {{ number_format($details->VALORFINANCIAMENTO,2,',','.') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-md-6">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="2" class="text-left">
                                ORC. CONTRATUAL - {{ $details->ORCCONTRATUAL }}
                            </th>
                            <th class="text-right">
                                {{ $details->ORCCONTRATUALINCC }}
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Custo Raso Obra
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($details->CUSTORASOOBRA,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTORASOOBRAINCC,0,',','.') }} INCC
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Taxa Adm.-{{ number_format($details->TAXAADMP,2,',','.') }}%
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($details->TAXAADM,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->TAXAADMINCC,0,',','.') }} INCC
                            </td>
                        </tr>
                        <tr class="tot">
                            <td class="text-left">
                                Custo Raso + Taxa
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($details->CUSTORASOTAXA,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTORASOTAXAINCC,0,',','.') }} INCC
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Manutenção-{{ number_format($details->MANUTENCAOP,2,',','.') }}%
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($details->MANUTENCAO,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->MANUTENCAOINCC,0,',','.') }} INCC
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Custos diversos
                            </td>
                            <td class="text-right">
                                R$ {{ number_format($details->CUSTOSDIVERSOS,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOSDIVERSOSINCC,0,',','.') }} INCC
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="info">
                        <thead>
                        <tr>
                            <th class="text-left">
                                PRAZOS (FASE: 1/1)
                            </th>
                            <th>
                                PREV.
                            </th>
                            <th>
                                REAL/PROJ
                            </th>
                            <th class="text-right">
                                DESV. DIAS
                            </th>
                            <th>

                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Início Plan. Obra:
                            </td>
                            <td class="text-center">
                                {{ $details->INICIOPLANOBRAPREV }}
                            </td>
                            <td class="text-center">
                                {{ $details->INICIOPLANOBRAREAL }}
                            </td>
                            <td class="text-right">
                                {{ $details->INICIOPLANOBRADESV }}
                            </td>
                            <td>
                                <span
                                    class="leg {{ $cores[strtoupper($details->INICIOPLANOBRAFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Térm. Plan. Obra:
                            </td>
                            <td class="text-center">
                                {{ $details->TERMPLANOBRAPREV }}
                            </td>
                            <td class="text-center">
                                {{ $details->TERMPLANOBRAREAL }}
                            </td>
                            <td class="text-right">
                                {{ $details->TERMPLANOBRADESV }}
                            </td>
                            <td>
                                <span class="leg {{ $cores[strtoupper($details->TERMPLANOBRAFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Térm. Habite-se:
                            </td>
                            <td class="text-center">
                                {{ $details->TERMHABITESEPREV }}
                            </td>
                            <td class="text-center">
                                {{ $details->TERMHABITESEREAL }}
                            </td>
                            <td class="text-right">
                                {{ $details->TERMHABITESEDESV }}
                            </td>
                            <td>
                                <span class="leg {{ $cores[strtoupper($details->TERMHABITESEFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Térm. Cliente:
                            </td>
                            <td class="text-center">
                                {{ $details->TERMCLIENTEPREV }}
                            </td>
                            <td class="text-center">
                                {{ $details->TERMCLIENTEREAL }}
                            </td>
                            <td class="text-right">
                                {{ $details->TERMCLIENTEDESV }}
                            </td>
                            <td>
                                <span class="leg {{ $cores[strtoupper($details->TERMCLIENTEFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Prazo Obra-Meses:
                            </td>
                            <td class="text-center">
                                {{ $details->PRAZOBRAMESESPREV }}
                            </td>
                            <td class="text-center">
                                {{ $details->PRAZOOBRAMESESREAL }}
                            </td>
                            <td class="text-right">
                                {{ $details->PRAZOOBRAMESESDESV }}
                            </td>
                            <td>
                                <span
                                    class="leg {{ $cores[strtoupper($details->PRAZOOBRAMESESFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <!--  GEOVANE, CONFERIR MUDANCAS  eram 3 tabelas que transformei em so 1 -->
                <div class="col-md-12">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="4">
                                EVOLUÇÃO ORÇ. (CUSTO OBRA: RASO + TAXA + OUTROS)
                            </th>
                            <th colspan="3">
                                ACOMPANHAMENTO FINANCEIRO
                            </th>
                            <th class="text-right" colspan="2">
                                INCC (N-1) IN: {{ $details->ACOFINCCIN }}
                            </th>
                            <th colspan="2">
                                CUSTO/M2 (PROJETADO)
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center">
                                Id.
                            </th>
                            <th class="text-center">
                                Orc.Ini.Obra
                            </th>
                            <th class="text-center">
                                Adtv.(+ Eco.)
                            </th>
                            <th class="text-center">
                                Orc.Rev.Obra
                            </th>
                            <th class="text-right">
                                Acum. Total
                            </th>
                            <th class="text-right">
                                Saldo Realizar
                            </th>
                            <th class="text-right">
                                Proj. Custo Obra
                            </th>
                            <th class="text-right" colspan="2">
                                Var. Orc. Rev. (+ Eco.)
                            </th>
                            <th class="text-right">
                                Construído
                            </th>
                            <th class="text-right">
                                Privativo
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                {{ $details->EVOORCID }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCINIOBRA,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCADTV,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCREVOBRA,0,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFACUMTOTAL,0,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFSALDOREAL,0,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFPROJCUSTO,0,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFVARORCREV,0,',','.') }}
                            </td>
                            <td rowspan="2" class="text-center">
                                {{ $details->ACOFVARORCREVVALOR }}%<br>
                                <span
                                    class="leg {{ $cores[strtoupper($details->ACOFVARORCREVFAROL)]['FAROL'] }}"></span>
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJCONST,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJPRIVA,2,',','.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">
                                {{ $details->EVOORCIDINCC }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCINIOBRAINCC,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCADTVINCC,0,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCREVOBRAINCC,0,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFACUMTOTALINCC,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFSALDOREALINCC,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFPROJCUSTOINCC,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->ACOFVARORCREVINCC,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJCONSTINCC,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJPRIVAINCC,2,',','.') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <table class="info barras-percent sizetd">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="2">
                                FÍSICO LOCAL ACUMULADO MACRO ETAPAS
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0;  $i < count(explode(',', $details->flameitens)); $i++)
                        <tr>
                            <td class="text-right">
                                {{ explode(',', $details->flameitens)[$i] }}
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ explode(',', $details->flamevalores)[$i] }}%;">
                                            <span>
                                                 {{ explode(',', $details->flamevalores)[$i] }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <!--  GEOVANE, CONFERIR MUDANCAS     ATENCAO: INSERI CLASSE AQUI: -->
                    <table class="info barras-percent chart full-grafico">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="2">
                                FÍSICO LOCAL ACUMULADO MACRO ETAPAS
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div id="container" style="width:100%; height:400px;"></div>
                                <script type="text/javascript">
                                    let flamemeses = '{{ $details->flamemeses }}';
                                    Highcharts.chart('container', {
                                        xAxis: {
                                            categories: flamemeses.split(',').map(function (value, index, array) {
                                                return value.toUpperCase();
                                            })
                                        },
                                        title: {
                                            text: ''
                                        },
                                        yAxis: [{
                                            min:0,
                                            max:100,
                                            title: {
                                                text: 'Acumulado'
                                            }
                                        }, {
                                            title: {
                                              text: 'Periodo'
                                            },
                                            opposite: true

                                          }],
                                        series: [{
                                            type: 'column',
                                            name: 'Período - Fís. PREV ',
                                            yAxis: 1,
                                            data: [{{ $details->flameperiodofisprev }}],
                                            color: {
                                                linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                                stops: [
                                                    [0, '#002953'],
                                                    [1, '#6c85af']
                                                ]
                                            }
                                        }, {
                                            type: 'column',
                                            name: 'Período - Fís. PREV - Mês Atual',
                                            yAxis: 1,
                                            data: [{{ $details->flameperiodofisprevmesatual }}],
                                            class: 'atual',
                                            color: {
                                                linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                                stops: [
                                                    [0, '#6f7124'],
                                                    [1, '#ae9c20']
                                                ]
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. REAL',
                                            yAxis: 0,
                                            data: [{{ $details->flameacumulofisreal }}],
                                            lineColor: '#ae9c20',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#ae9c20',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PREV)',
                                            yAxis: 0,
                                            data: [{{ $details->flameacumulofisprev }}],
                                            lineColor: '#182857',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#182857',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PROJ)',
                                            yAxis: 0,
                                            data: [{{ $details->flameacumulofisproj }}],
                                            lineColor: '#e07438',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#e07438',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (REAL)',
                                            yAxis: 1,
                                            data: [{{ $details->flameperiodofissubprev }}],
                                            color: '#182857',
                                            marker: {
                                                radius: 4
                                            }, //{series.name}
                                            tooltip: {
                                                pointFormat: '<b>{point.y}</b>'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (PROJ)',
                                            yAxis: 1,
                                            data: [{{ $details->flameperiodofisproj }}],
                                            startColumn: "{{ substr_count($details->flameperiodofisproj,',0')}}",
                                            color: '#e07438 ',
                                            marker: {
                                                radius: 4
                                            }, //{series.name}
                                            tooltip: {
                                                pointFormat: '<b>{point.y}</b>'
                                            }
                                        }]
                                    });
                                </script>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <!--  GEOVANE, CONFERIR MUDANCAS     ATENCAO: INSERI CLASSE AQUI: -->
                    <table class="info barras-percent chart full-grafico">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="2">
                                DESEMPENHO FINANCEIRO
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="grad2">
                                <div id="container2" style="width:100%; height:400px;"></div>
                                <script type="text/javascript">
                                    let dfmeses = '{{ $details->dfmeses }}';
                                    Highcharts.chart('container2', {
                                        xAxis: {
                                            categories: dfmeses.split(',').map(function (value, index, array) {
                                                return value.toUpperCase();
                                            })
                                        },
                                        title: {
                                            text: ''
                                        }
                                        yAxis: [{
                                            min:0,
                                            max:100,
                                            title: {
                                                text: 'Acumulado'
                                            }
                                        }, {
                                            title: {
                                              text: 'Periodo'
                                            },
                                            opposite: true

                                          }],
                                        series: [{
                                            type: 'column',
                                            name: 'Período - Fís. PREV',
                                            yAxis: 1,
                                            data: [{{ $details->dfperiodofisprev }}],
                                            color: {
                                                linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                                stops: [
                                                    [0, '#6f7124'],
                                                    [1, '#ae9c20']
                                                ]
                                            }
                                        }, {
                                            type: 'column',
                                            name: 'Período - Fís. PREV - Mês Atual',
                                            yAxis: 1,
                                            data: [{{ $details->dfperiodofisprevmesatual }}],
                                            class: 'atual',
                                            color: {
                                                linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                                stops: [
                                                    [0, '#002953'],
                                                    [1, '#6c85af']
                                                ]
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. REAL',
                                            yAxis: 0,
                                            data: [{{ $details->dfacumulofisreal }}],
                                            lineColor: '#182857',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#182857',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PREV)',
                                            yAxis: 0,
                                            data: [{{ $details->dfacumulofisprev }}],
                                            lineColor: '#a9994b',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#a9994b',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PROJ)',
                                            yAxis: 0,
                                            data: [{{ $details->dfacumulofisproj }}],
                                            lineColor: '#e07438',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#e07438',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (PREV)',
                                            yAxis: 1,
                                            data: [{{ $details->dfperiodofissubprev }}],
                                            color: '#a9994b',
                                            marker: {
                                                radius: 4
                                            },
                                            tooltip: {
                                                pointFormat: '<b>{point.y}</b>'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (PROJ)',
                                            yAxis: 1,
                                            data: [{{ $details->dfperiodofisproj }}],
                                            color: '#e07438',
                                            marker: {
                                                radius: 4
                                            },
                                            tooltip: {
                                                pointFormat: '<b>{point.y}</b>'
                                            }
                                        }]
                                    });
                                </script>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <table class="info barras-percent multiple">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="5">
                                ANÁLISE FÍSICA/ FINANCEIRA OBRA (RASO + TAXA)
                            </th>
                        </tr>
                        <tr>
                            <th>

                            </th>
                            <th>
                                ACUM. ANTERIOR
                            </th>
                            <th>
                                NO PERÍODO
                            </th>
                            <th>
                                ACUM. TOTAL
                            </th>
                            <th>
                                Δ
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-right">
                                Prev. Fís. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aaprevfisobra }}%;">
                                            <span>
                                                 {{ $details->aaprevfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->npprevfisobra }}%;">
                                            <span>
                                                 {{ $details->npprevfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atprevfisobra }}%;">
                                            <span>
                                                 {{ $details->atprevfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtprevfisobra }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtprevfisobrafarol)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fís. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aarealfisobra }}%;">
                                            <span>
                                                 {{ $details->aarealfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->nprealfisobra }}%;">
                                            <span>
                                                 {{ $details->nprealfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atrealfisobra }}%;">
                                            <span>
                                                 {{ $details->atrealfisobra }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtrealfisobra }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtrealfisobrafarol)]["FAROL"] }}"></span>
                            </td>
                        </tr>


                        <tr>
                            <td class="text-right">
                                Prev. Fís. Banco
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aaprevfisbanco }}%;">
                                            <span>
                                                 {{ $details->aaprevfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->npprevfisbanco }}%;">
                                            <span>
                                                 {{ $details->npprevfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atprevfisbanco }}%;">
                                            <span>
                                                 {{ $details->atprevfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtprevfisbanco }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtprevfisbancofarol)]["FAROL"] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fís. Banco
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aarealfisbanco }}%;">
                                            <span>
                                                 {{ $details->aarealfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->nprealfisbanco }}%;">
                                            <span>
                                                 {{ $details->nprealfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atrealfisbanco }}%;">
                                            <span>
                                                 {{ $details->atrealfisbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtrealfisbanco }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtrealfisbancofarol)]["FAROL"] }}"></span>
                            </td>
                        </tr>


                        <tr>
                            <td class="text-right">
                                Prev. Fin. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aaprevfinbanco }}%;">
                                            <span>
                                                 {{ $details->aaprevfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->npprevfinbanco }}%;">
                                            <span>
                                                 {{ $details->npprevfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atprevfinbanco }}%;">
                                            <span>
                                                 {{ $details->atprevfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtprevfinbanco }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtprevfinbancofarol)]["FAROL"] }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fin. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: {{ $details->aarealfinbanco }}%;">
                                            <span>
                                                 {{ $details->aarealfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: {{ $details->nprealfinbanco }}%;">
                                            <span>
                                                 {{ $details->nprealfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c3">
                                    <div class="percent" style="width: {{ $details->atrealfinbanco }}%;">
                                            <span>
                                                 {{ $details->atrealfinbanco }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $details->dtrealfinbanco }}%
                                <span
                                    class="leg {{ $cores[strtoupper($details->dtrealfinbancofarol)]["FAROL"] }}"></span>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>


                <div class="col-md-8">
                    <table class="info barras-percent vertical">
                        <thead>
                        <tr>
                            <th class="text-left">
                                FLUXO FINANCEIRO OBRA
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="row" id="fluxofinanobra">
                        <div class="col-md-3">
                            <div id="barra1" style="width: 100%; height: 300px;"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="barra2" style="width: 100%; height: 300px;"></div>
                        </div>
                        <div class="col-md-3">

                            <div id="barra3" style="width: 100%; height: 300px;"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="barra4" style="width: 100%; height: 300px;"></div>
                        </div>
                        <script type="text/javascript">
                            let ffomeses = '{{ $details->ffomeses }}';
                            ffomeses = ffomeses.split(',').map(function (value, index, array) {
                                return value.toUpperCase();
                            });
                            let ffodeltas = '{{ $details->ffodelta }}';
                            ffodeltas = ffodeltas.split(',');
                            let ffoprevrevs = '{{ $details->ffoprevrev }}';
                            ffoprevrevs = ffoprevrevs.split(',');
                            let fforeals = '{{ $details->fforeal }}';
                            fforeals = fforeals.split(',');
                            if (ffodeltas[0]) {
                                let ffoprevrev = ffoprevrevs[0];
                                let fforeal = fforeals[0];

                                Highcharts.chart('barra1', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = ' + ffodeltas[0] + '%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: ffomeses[0]
                                        },
                                        labels: {
                                            enabled: false
                                        }
                                    },
                                    yAxis: {
                                        labels: {
                                            enabled: false
                                        },
                                        title: {
                                            enabled: false
                                        }
                                    },
                                    series: [{
                                        name: 'Prev. Rev. (R$)',
                                        data: [parseInt(ffoprevrev)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [parseInt(fforeal)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                            ]
                                        }

                                    }]
                                });
                            }
                            if (ffodeltas[1]) {
                                let ffoprevrev = ffoprevrevs[1];
                                let fforeal = fforeals[1];

                                Highcharts.chart('barra2', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = ' + ffodeltas[1] + '%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: ffomeses[1]
                                        },
                                        labels: {
                                            enabled: false
                                        }
                                    },
                                    yAxis: {
                                        labels: {
                                            enabled: false
                                        },
                                        title: {
                                            enabled: false
                                        }
                                    },
                                    series: [{
                                        name: 'Prev. Rev. (R$)',
                                        data: [parseInt(ffoprevrev)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [parseInt(fforeal)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                            ]
                                        }

                                    }]
                                });
                            }
                            if (ffodeltas[2]) {
                                let ffoprevrev = ffoprevrevs[2];
                                let fforeal = fforeals[2];

                                Highcharts.chart('barra3', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = ' + ffodeltas[2] + '%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: ffomeses[2]
                                        },
                                        labels: {
                                            enabled: false
                                        }
                                    },
                                    yAxis: {
                                        labels: {
                                            enabled: false
                                        },
                                        title: {
                                            enabled: false
                                        }
                                    },
                                    series: [{
                                        name: 'Prev. Rev. (R$)',
                                        data: [parseInt(ffoprevrev)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [parseInt(fforeal)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                            ]
                                        }

                                    }]
                                });
                            }
                            if (ffodeltas[3]) {
                                let ffoprevrev = ffoprevrevs[3];
                                let fforeal = fforeals[3];

                                Highcharts.chart('barra4', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = ' + ffodeltas[3] + '%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: ffomeses[3]
                                        },
                                        labels: {
                                            enabled: false
                                        }
                                    },
                                    yAxis: {
                                        labels: {
                                            enabled: false
                                        },
                                        title: {
                                            enabled: false
                                        }
                                    },
                                    series: [{
                                        name: 'Prev. Rev. (R$)',
                                        data: [parseInt(ffoprevrev)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [parseInt(fforeal)],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                            ]
                                        }

                                    }]
                                });
                            }
                        </script>
                    </div>
                </div>


                <div class="col-md-4">
                    <table class="info barras-percent vertical v2">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="2">
                                FLUXO DESEMB.
                            </th>
                        </tr>
                        </thead>
                    </table>
                    <div class="row" id="fluxodesemb">
                        <div class="col-md-6">

                            <div id="barra5" style="width: 100%; height: 300px;"></div>

                        </div>
                        <div class="col-md-6">
                            <div id="barra6" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        let fdmeses = '{{ $details->fdmeses }}';
                        fdmeses = fdmeses.split(',').map(function (value, index, array) {
                            return value.toUpperCase();
                        });
                        let fddeltas = '{{ $details->fddelta }}';
                        fddeltas = fddeltas.split(',');
                        let fdprevrevs = '{{ $details->fdprevrev }}';
                        fdprevrevs = fdprevrevs.split(',');
                        let fdreals = '{{ $details->fdreal }}';
                        fdreals = fdreals.split(',');
                        if (fddeltas[0]) {
                            let fdprevrev = fdprevrevs[0];
                            let fdreal = fdreals[0];
                            Highcharts.chart('barra5', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Δ = ' + fddeltas[0] + '%'
                                },
                                xAxis: {
                                    crosshair: true,
                                    title: {
                                        text: fdmeses[0]
                                    },
                                    labels: {
                                        enabled: false
                                    }
                                },
                                yAxis: {
                                    labels: {
                                        enabled: false
                                    },
                                    title: {
                                        enabled: false
                                    }
                                },
                                series: [{
                                    name: 'Prev. Rev. (R$)',
                                    data: [parseInt(fdprevrev)],
                                    color: {
                                        linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                        stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                        ]
                                    }

                                }, {
                                    name: 'Real (R$)',
                                    data: [parseInt(fdreal)],
                                    color: {
                                        linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                        stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                        ]
                                    }

                                }]
                            });
                        }
                        if (fddeltas[1]) {
                            let fdprevrev = fdprevrevs[1];
                            let fdreal = fdreals[1];
                            Highcharts.chart('barra6', {
                                chart: {
                                    type: 'column'
                                },
                                title: {
                                    text: 'Δ = ' + fddeltas[1] + '%'
                                },
                                xAxis: {
                                    crosshair: true,
                                    title: {
                                        text: fdmeses[1]
                                    },
                                    labels: {
                                        enabled: false
                                    }
                                },
                                yAxis: {
                                    labels: {
                                        enabled: false
                                    },
                                    title: {
                                        enabled: false
                                    }
                                },
                                series: [{
                                    name: 'Prev. Rev. (R$)',
                                    data: [parseInt(fdprevrev)],
                                    color: {
                                        linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                        stops: [
                                                [0, '#b0b6b9'],
                                                [1, '#b9bfc2']
                                        ]
                                    }

                                }, {
                                    name: 'Real (R$)',
                                    data: [parseInt(fdreal)],
                                    color: {
                                        linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                        stops: [
                                                [0, '#1c3156'],
                                                [1, '#405372']
                                        ]
                                    }

                                }]
                            });
                        }
                    </script>
                </div>


                <div class="col-md-7">
                    <table class="info">
                        <thead>
                        <tr>
                            <th class="text-left">
                                CRITÉRIOS DE PREMIO E MULTA CONTRATUAIS
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                * Economia = {{ $details->critpremultaconteco }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                * Estouro = {{ $details->critpremultacontest }}.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="info">
                        <thead>
                        <tr>
                            <th class="text-left" colspan="3">
                                PREVISÃO PRÊMIO (+)/ MULTA(-)
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td class="text-left">
                                Construt.:
                            </td>
                            <td class="text-left">
                                R$ {{ $details->prevpremultaconstincc }}
                            </td>
                            <td class="text-right">
                                {{ $details->prevpremultaconstincc }} INCC
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Incorpor.:
                            </td>
                            <td class="text-left">
                                R$ {{ $details->prevpremultaincorrs }}
                            </td>
                            <td class="text-right">
                                {{ $details->prevpremultaincorincc }} INCC
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <table class="info">
                        <thead>
                        <tr>
                            <th class="text-left">
                                FATOS RELEVANTES
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="tot">
                            <td class="text-left">
                                {!! str_replace(']','</strong>',str_replace('[','<strong>',str_replace('|','<br/>',$details->fatosrelevantes))) !!}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12 d-flex justify-content-center align-items-center nav-btns">
                    @if($previousConstruction && $previousConstruction != 0)
                        <a href="{{ route('client-space.construction-detail', [$previousConstruction,$details->competence_id]) }}"
                           class="btn-nav">
                            Obra Anterior
                        </a>
                    @endif
                    <a href="{{ route('client-space.index') }}" class="btn-nav">
                        Página Inicial
                    </a>
                    @if($nextConstruction && $nextConstruction != 0)
                        <a href="{{ route('client-space.construction-detail', [$nextConstruction,$details->competence_id]) }}"
                           class="btn-nav">
                            Obra Posterior
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        var construction = "{{ $details->construction_id }}";
        jQuery(function () {
            setTimeout(
                function () {
                    jQuery('.full-grafico .highcharts-series-group > .highcharts-column-series.highcharts-series-1 > rect.highcharts-point').each(function (index) {
                        var $width = jQuery(this).attr('width');
                        jQuery(this).attr('style', 'transform:translateX(-' + $width + 'px)');


                    });
                    jQuery('.full-grafico .highcharts-series-group > .highcharts-column-series > rect.highcharts-point').each(function (index) {
                        var wd = jQuery(this).attr('width');


                        jQuery(this).attr('width', 2 * wd);

                    });


                }, 2000);


        });
    </script>
@stop
