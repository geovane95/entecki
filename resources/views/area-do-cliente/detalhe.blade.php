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
                        <img src="{{asset('images/constructions/'.$details->thumbnail)}}" alt="{{ $details->construction_name }}" title="{{ $details->construction_name }}"/>
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
                            <a href="{{ route('client-space.pictures-download', $picture->id) }}" class="pic">
                                <i></i>
                                Fotos
                            </a>
                            @endif
                            @if($report)
                            <a href="{{ route('client-space.report-download', $report->id) }}" class="rel">
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
                                    <strong>CNPJ DA SPE:</strong> {{ $details->responsible_cnpj }}
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
                                    <strong>DATA EMISSÃO:</strong> {{ $details->issuance_date }}
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
                                        <option value="{{ $competence->id }}" {{ $competence->id == $competencesselected ? "selected" : "" }}>
                                            {{ $competence->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <h4>
                                <strong>STATUS DA OBRA:</strong> {{ $details->construction_status ? 'Em Andamento' : 'Encerrada' }}
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
                                (Proj.Pref.)
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
                                (Proj.Pref.)
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
                                (Col.23)
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
                                (Col.18)
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
                                (Proj.Pref.)
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
                                Relação AP/ AC
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
                                Taxa Adm.-10,00%
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
                                Manutenção-1,50%
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
                                <span class="leg {{ $cores[strtoupper($details->INICIOPLANOBRAFAROL)]['FAROL'] }}"></span>
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
                                <span class="leg {{ $cores[strtoupper($details->PRAZOOBRAMESESFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="4">
                                EVOLUÇÃO ORÇ. (CUSTO OBRA: RASO + TAXA + OUTROS)
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
                        </tr>
                        <tr>
                            <td class="text-center">
                                {{ $details->EVOORCIDINCC }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCINIOBRAINCC,2,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCADTVINCC,2,',','.') }}
                            </td>
                            <td class="text-center">
                                {{ number_format($details->EVOORCREVOBRAINCC,2,',','.') }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-5">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="3">
                                ACOMPANHAMENTO FINANCEIRO
                            </th>
                            <th class="text-right" colspan="2">
                                INCC (N-1) IN: {{ number_format($details->ACOFINCCIN,2,',','.') }}
                            </th>
                        </tr>
                        <tr>
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
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
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
                                {{ $details->ACOFVARORCREV }}
                            </td>
                            <td rowspan="2" class="text-center">
                                {{ $details->ACOFVARORCREVVALOR }}%<br>
                                <span class="leg {{ $cores[strtoupper($details->ACOFVARORCREVFAROL)]['FAROL'] }}"></span>
                            </td>
                        </tr>
                        <tr>
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
                                {{ $details->ACOFVARORCREVINCC }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-2">
                    <table class="info">
                        <thead>
                        <tr>
                            <th colspan="2">
                                CUSTO/M2 (PROJETADO)
                            </th>
                        </tr>
                        <tr>
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
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJCONST,2,',','.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($details->CUSTOM2PROJPRIVA,2,',','.') }}
                            </td>
                        </tr>
                        <tr>
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
                        <tr>
                            <td class="text-right">
                                Projetos Exec.
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->PROJEXEC }}%;">
                                            <span>
                                                 {{ $details->PROJEXEC }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Fundação Torre
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->FUNDACAOTORRE }}%;">
                                            <span>
                                                 {{ $details->FUNDACAOTORRE }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Estrutura Torre
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->ESTRUTURATORRE }}%;">
                                            <span>
                                                 {{ $details->ESTRUTURATORRE }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Instalações
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->INSTALACOES }}%;">
                                            <span>
                                                 {{ $details->INSTALACOES }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Acabamento
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->ACABAMENTO }}%;">
                                            <span>
                                                 {{ $details->ACABAMENTO }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Revest. Fachada
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->REVFACHADA }}%;">
                                            <span>
                                                 {{ $details->REVFACHADA }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                AE/ Paisagismo
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: {{ $details->AEPAISAGISMO }}%;">
                                            <span>
                                                 {{ $details->AEPAISAGISMO }}%
                                            </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12">
                    <table class="info barras-percent chart">
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
                                    Highcharts.chart('container', {
                                        xAxis: {
                                            categories: ['Jul/18', 'Ago/18', 'Set/18', 'Out/18', 'Nov/18', 'Dez/18', 'Jan/19', 'Fev/19', 'Mar/19', 'Abr/19', 'Mai/19', 'Jun/19', 'Jul/18', 'Ago/18', 'Set/18', 'Out/18', 'Nov/18', 'Dez/18', 'Jan/19', 'Fev/19', 'Mar/19', 'Abr/19', 'Mai/19', 'Jun/19']
                                        },
                                        title: {
                                            text: ''
                                        },
                                        yAxis: {
                                            title: {
                                                enabled: false
                                            }
                                        },
                                        series: [{
                                            type: 'column',
                                            name: 'Período - Fís. PREV',
                                            data: [30, 20, 17, 38, 44, 30, 20, 17, 38, 44, 42, 48, 30, 20, 17, 38, 44, 30, 20, 17, 38, 44, 42, 48],
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
                                            data: [3, 2.67, 3, 6.33, 3.33, 3, 2.67, 3, 6.33, 3.33, 10, 15, 3, 2.67, 3, 6.33, 3.33, 3, 2.67, 3, 6.33, 3.33, 10, 15],
                                            lineColor: '#f26d23',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#f26d23',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PREV/PROJ)',
                                            data: [6.33, 3.33, 3, 2.67, 3, 2.67, 3, 3, 6.33, 3.33, 10, 15, 6.33, 3.33, 3, 2.67, 3, 2.67, 3, 3, 6.33, 3.33, 10, 15],
                                            lineColor: '#434444',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#434444',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (PREV/PROJ)',
                                            data: [35, 24, 22, 40, 45, 40, 28, 33, 43, 48, 46, 53, 35, 24, 22, 40, 45, 40, 28, 33, 43, 48, 46, 53],
                                            color: '#182857',
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
                    <table class="info barras-percent chart">
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
                                    Highcharts.chart('container2', {
                                        xAxis: {
                                            categories: ['Jul/18', 'Ago/18', 'Set/18', 'Out/18', 'Nov/18', 'Dez/18', 'Jan/19', 'Fev/19', 'Mar/19', 'Abr/19', 'Mai/19', 'Jun/19', 'Jul/18', 'Ago/18', 'Set/18', 'Out/18', 'Nov/18', 'Dez/18', 'Jan/19', 'Fev/19', 'Mar/19', 'Abr/19', 'Mai/19', 'Jun/19']
                                        },
                                        title: {
                                            text: ''
                                        },
                                        yAxis: {
                                            title: {
                                                enabled: false
                                            }
                                        },
                                        series: [{
                                            type: 'column',
                                            name: 'Período - Fís. PREV',
                                            data: [30, 20, 17, 38, 44, 30, 20, 17, 38, 44, 42, 48, 30, 20, 17, 38, 44, 30, 20, 17, 38, 44, 42, 48],
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
                                            data: [3, 2.67, 3, 6.33, 3.33, 3, 2.67, 3, 6.33, 3.33, 10, 15, 3, 2.67, 3, 6.33, 3.33, 3, 2.67, 3, 6.33, 3.33, 10, 15],
                                            lineColor: '#f26d23',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#f26d23',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'spline',
                                            name: 'Acum - Fís. (PREV/PROJ)',
                                            data: [6.33, 3.33, 3, 2.67, 3, 2.67, 3, 3, 6.33, 3.33, 10, 15, 6.33, 3.33, 3, 2.67, 3, 2.67, 3, 3, 6.33, 3.33, 10, 15],
                                            lineColor: '#6b7138',
                                            marker: {
                                                lineWidth: 2,
                                                lineColor: '#6b7138',
                                                fillColor: 'white'
                                            }
                                        }, {
                                            type: 'scatter',
                                            name: 'Período - Fís. (PREV/PROJ)',
                                            data: [35, 24, 22, 40, 45, 40, 28, 33, 43, 48, 46, 53, 35, 24, 22, 40, 45, 40, 28, 33, 43, 48, 46, 53],
                                            color: '#b09a31',
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
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fís. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 2%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
                            </td>
                        </tr>


                        <tr>
                            <td class="text-right">
                                Prev. Fís. Banco
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fís. Banco
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 2%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
                            </td>
                        </tr>


                        <tr>
                            <td class="text-right">
                                Prev. Fin. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 18%;">
                                            <span>
                                                 18%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">
                                Real. Fin. Obra
                            </td>
                            <td>
                                <div class="barra c1">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra c2">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 25%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="barra">
                                    <div class="percent" style="width: 25%;">
                                            <span>
                                                 2%
                                            </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                3,60%
                                <span class="leg verde"></span>
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
                    <div class="row">
                        <div class="col-md-3">
                            <div id="barra1" style="width: 100%; height: 300px;"></div>

                            <script type="text/javascript">
                                Highcharts.chart('barra1', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>
                        </div>
                        <div class="col-md-3">
                            <div id="barra2" style="width: 100%; height: 300px;"></div>

                            <script type="text/javascript">
                                Highcharts.chart('barra2', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>
                        </div>
                        <div class="col-md-3">

                            <div id="barra3" style="width: 100%; height: 300px;"></div>

                            <script type="text/javascript">
                                Highcharts.chart('barra3', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>
                        </div>
                        <div class="col-md-3">

                            <div id="barra4" style="width: 100%; height: 300px;"></div>

                            <script type="text/javascript">
                                Highcharts.chart('barra4', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>
                        </div>
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

                            <script type="text/javascript">
                                Highcharts.chart('barra5', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>
                        </div>
                        <div class="col-md-6">
                            <div id="barra6" style="width: 100%; height: 300px;"></div>

                            <script type="text/javascript">
                                Highcharts.chart('barra6', {
                                    chart: {
                                        type: 'column'
                                    },
                                    title: {
                                        text: 'Δ = 2,55%'
                                    },
                                    xAxis: {
                                        crosshair: true,
                                        title: {
                                            text: 'JAN/19'
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
                                        data: [1134271],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#002953'],
                                                [1, '#6c85af']
                                            ]
                                        }

                                    }, {
                                        name: 'Real (R$)',
                                        data: [684851],
                                        color: {
                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                                            stops: [
                                                [0, '#6f7124'],
                                                [1, '#ae9c20']
                                            ]
                                        }

                                    }]
                                });
                            </script>

                        </div>
                    </div>

                    </tr>
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
                                * Economia = 50% construtora 50% incorporadora / Taxa constr. 100% paga
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                * Estouro = Incoporadora até 3% (contingência), após isso 100% construtora.
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
                                R$ -
                            </td>
                            <td class="text-right">
                                0 INCC
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Incorpor.:
                            </td>
                            <td class="text-left">
                                R$ -
                            </td>
                            <td class="text-right">
                                0 INCC
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
                                <strong>DATAS MARCO:</strong> conforme contrato, o prazo de obra é de 23 meses (01 mês
                                para mobilização + 20 para execução + 02 de check list), a partir da ordem de início
                                (01/set/18), tendo as seguintes
                                datas marco a serem cumpridas (podendo acarretar a bloqueio de taxa após 30 dias de
                                atraso):<br>
                                *Conclusão das Fundações: 02/01/19 (123 dias) - Meta atingida em 26/10/18;<br>
                                *Conclusão do Apto Modelo: 12/06/19 (284 dias) - Status: Em andamento;<br>
                                *Conclusão da Estrtutura de Concreto: 04/09/19 (368 dias) - Status: Em andamento;<br>
                                *Conclusão da Montagem do 1º Elevador: 08/01/20 (494 dias) - Status: Em andamento;<br>
                                <strong>ADICIONAIS CRITÉRIOS PRÉMIOS E MULTAS:</strong><br>
                                * Adendo = estouro acima de 3% a incorporadora poderá cortar a tx. adm. e cobrar multa
                                de 2% do valor e juros de 1% ao mês calculados sobre o montante devido não pago.<br>
                                BANCO: Até o momento banco encontra-se acima do previsto e acima do físico da obra.
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="col-md-12 d-flex justify-content-center align-items-center nav-btns">
                    @if($previousConstruction && $previousConstruction != 0)
                    <a href="{{ route('client-space.construction-detail', [$previousConstruction,$details->competence_id]) }}" class="btn-nav">
                        Obra Anterior
                    </a>
                    @endif
                    <a href="{{ route('client-space.index') }}" class="btn-nav">
                        Página Inicial
                    </a>
                    @if($nextConstruction && $nextConstruction != 0)
                    <a href="{{ route('client-space.construction-detail', [$nextConstruction,$details->competence_id]) }}" class="btn-nav">
                        Obra Posterior
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            $("#competences").change(function(){
                let id = $("#competences").val();
                let url = "{{ route('client-space.construction-detail', [$details->construction_id, ':competence']) }}";
                url = url.replace(':competence',id);
                window.location.href = url;
            });
        });
        function fluxodesemb() {
            let construction = "{{ $details->construction_id }}";
            let url = "{{ route('graficos.fluxodesemb',':construction') }}";
            url = url.replace(':construction',construction);
            axios.get(url)
                .then(response => {
                    let template =
                        `                                Highcharts.chart("barra5", {\n` +
                        `                                    chart: {\n` +
                        `                                        type: "column"\n` +
                        `                                    },\n` +
                        `                                    title: {\n` +
                        `                                        text: "Δ = :delta%"\n` +
                        `                                    },\n` +
                        `                                    xAxis: {\n` +
                        `                                        crosshair: true,\n` +
                        `                                        title: {\n` +
                        `                                            text: ":competencedesc"\n` +
                        `                                        },\n` +
                        `                                        labels: {\n` +
                        `                                            enabled: false\n` +
                        `                                        }\n` +
                        `                                    },\n` +
                        `                                    yAxis: {\n` +
                        `                                        labels: {\n` +
                        `                                            enabled: false\n` +
                        `                                        },\n` +
                        `                                        title: {\n` +
                        `                                            enabled: false\n` +
                        `                                        }\n` +
                        `                                    },\n` +
                        `                                    series: [{\n` +
                        `                                        name: "Prev. Rev. (R$)",\n` +
                        `                                        data: [:valueprevrev],\n` +
                        `                                        color: {\n` +
                        `                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},\n` +
                        `                                            stops: [\n` +
                        `                                                [0, "#002953"],\n` +
                        `                                                [1, "#6c85af"]\n` +
                        `                                            ]\n` +
                        `                                        }\n` +
                        `\n` +
                        `                                    }, {\n` +
                        `                                        name: "Real (R$)",\n` +
                        `                                        data: [:valuereal],\n` +
                        `                                        color: {\n` +
                        `                                            linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},\n` +
                        `                                            stops: [\n` +
                        `                                                [0, "#6f7124"],\n` +
                        `                                                [1, "#ae9c20"]\n` +
                        `                                            ]}\n` +
                        `                                    }\n` +
                        `                                ]\n` +
                        `})`;
                    let newtemplate = template.replace(':delta',delta);
                    newtemplate = newtemplate.replace(':competencedesc',competencedesc);
                    newtemplate = newtemplate.replace(':valueprevrev', valueprevrev);
                    newtemplate = newtemplate.replace(':valuereal',valuereal);

                    $("#fluxodesemb").append(newtemplate);
                })
                .catch((error) => {

                })
                .finally(() => {

                });
            $("#fluxodesemb")
        }
    </script>
@stop
