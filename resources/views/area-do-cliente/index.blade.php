@extends('area-do-cliente.template.template')
@section('miolo')

    <section class="miolo">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>
                    RELATÓRIO DE PERFORMANCE DE ENGENHARIA (RPE)
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

                <form class="filtro flex-column d-flex">
                    <label class="d-flex align-items-center">
                        Mês Referência:
                        <select name="competences" id="competences">
                            @foreach($competences as $competence)
                            <option value="{{ $competence->id }}" {{ in_array($competence->id,$competencesselected) ? "selected" : "" }}>
                                {{ $competence->description }}
                            </option>
                            @endforeach
                        </select>
                    </label>
                    <span>
                        INCC (N-1) = {{ $incc }}
                    </span>

                    <select class="obras constructions" multiple id="constructions">
                        <option value="0">SELECIONE AS OBRAS PARA VISUALIZAÇÃO</option>
                        @foreach($constructions as $construction)
                        <option value="{{ $construction->id }}" {{ in_array($construction->id,$construtionsselected) ? "selected" : "" }}>
                            {{ $construction->name }}
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
                        <th colspan="4">
                            Dados Gerais
                        </th>
                        <th>
                            Custo Obra Rev.
                        </th>
                        <th>
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
                        <th>
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
                            Variação (+Eco.)
                            <table>
                                <tr>
                                    <th>
                                        [P-R]<br/>
                                        Δ R$ (Atual)
                                    </th>
                                    <th>
                                        [1 - R/P]<br/>
                                        Δ R$ (Atual)
                                    </th>
                                </tr>
                            </table>
                        </th>
                        <th>
                            Variação (+Eco.)
                            <table>
                                <tr>
                                    <th>
                                        [P-R]<br>
                                        Δ R$ (Atual)
                                    </th>
                                    <th>
                                        [1 - R/P]<br>
                                        Δ R$ (Atual)
                                    </th>
                                </tr>
                            </table>
                        </th>
                        <th>
                            Δ (+ Eco)<br>
                            [P-R]<br>
                            Δ%
                        </th>

                        <th>
                            Ter. Obra<br>
                            R/Proj.<br>
                            Mês
                        </th>

                        <th>
                            Δ (- Eco)<br/>
                            [P-R]<br/>
                            Δ Dias
                        </th>

                        <th>
                            IDQ<br>
                            Obra<br>
                            Indicador
                        </th>

                        <th>
                            IDS<br>
                            Obra<br>
                            Indicador
                        </th>

                        <th>
                            %<br>
                            Contratado<br>
                            Indicador
                        </th>

                        <th>
                            Orc. Proj.<br>
                            Atualizado<br>
                            R$/m2
                        </th>

                        <th>
                            Orc. Proj.<br>
                            Atualizado<br>
                            R$/m2
                        </th>

                    </tr>
                    <tr class="linha-branca">
                        <th colspan="17">

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
                        <th>
                            <table>
                                <tr>
                                    <th class="text-right">
                                        (1.653.737)
                                    </th>
                                    <th>
                                                <span class="leg amarelo">

                                                </span>
                                        -0,6%
                                    </th>
                                </tr>
                            </table>
                        </th>
                        <th colspan="12">

                        </th>
                    </tr>


                    </thead>
                    <tbody>
                    <span style="display: none;">{{ $constLastId = 0 }}</span>
                    @foreach($constructionstable as $constructiontable)
                        <tr>
                            <td colspan="2">
                                <table>
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
                                    </tr>
                                </table>
                            </td>
                            <td class="text-right">
                                {{ number_format($constructiontable->AREACONSTRM2, 0, ',', '.') }}
                            </td>
                            <td class="text-right">
                                {{ number_format($constructiontable->NUNITQTD, 0, ',', '.') }}
                            </td>
                            <td>
                                <table class="inside">
                                    <tr>
                                        <td class="text-right">
                                            ({{ number_format($constructiontable->NUNITQTD, 0, ',', '.') }})
                                        </td>
                                        <td>
                                                <span class="leg {{ $constructiontable->CORRPRATUALFAROL }}">

                                                </span>
                                            {{ $constructiontable->CORRPRATUALVLR }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="inside">
                                    <tr>
                                        <td class="text-right">
                                            {{ $constructiontable->FXDPRRATUAL }}
                                        </td>
                                        <td>
                                                <span class="leg {{ $constructiontable->FXDRPRATUALFAROL }}">

                                                </span>
                                            {{ $constructiontable->FXDRPRATUALVLR }}%
                                        </td>
                                    </tr>
                                </table>
                            </td>

                            <td>
                                    <span class="leg {{$constructiontable->FPRPRFAROL }}">

                                    </span>
                                {{ $constructiontable->FPRPR }}%
                            </td>
                            <td>
                                    <span class="leg {{$constructiontable->POTEROBRARPMESFAROL }}">

                                    </span>
                                {{ $constructiontable->POTEROBRARPMES }}
                            </td>
                            <td>
                                {{ $constructiontable->POECOPR }}
                            </td>
                            <td>
                                    <span class="leg {{$constructiontable->IDQFAROL }}">

                                    </span>
                            </td>
                            <td>
                                    <span class="leg {{$constructiontable->IDSFAROL }}">

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
                                <a href="{{ route('client-space.construction-documents', [$constructiontable->competence_id,$constructiontable->construction_id]) }}" class="doc">

                                </a>
                            </td>
                            <td>
                                <a href="{{ route('client-space.construction-detail', [$constructiontable->construction_id, $constructiontable->competence_id]) }}" class="det">

                                </a>
                            </td>
                        </tr>
                        @if($constructiontable->construction_id != $constLastId)
                        <!--QUANDO MUDA O CÓDIGO DO NÚMERO DA OBRA INSERE ESSA LINHA CINZA PARA DIVIDIR -->
                        <tr class="linha-cinza">
                            <td colspan="17">

                            </td>
                        </tr>
                        @endif
                        {{ $constLastId = $constructiontable->construction_id }}
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </section>
    <script>
        $(document).ready(function(){
            $("#competences").change(function(){
                let id = $("#competences").val();
                let ids = $("#constructions").val();
                let url = "{{route('client-space.index.args', [':id',':ids'])}}";
                window.location.href = url.replace(':ids',ids).replace(':id',id);
            });
            $("#constructions").change(function(){
                let id = $("#competences").val();
                let ids = $("#constructions").val();
                let url = "{{route('client-space.index.args', [':id',':ids'])}}";
                if(ids != 0) {
                    window.location.href = url.replace(':ids', ids).replace(':id', id);
                }
            });
            $(".doc").click(function(){
                let id = $(this).attr('id');
                let comp_id = $(this).attr('data-id');

                let url = "{{ route('client-space.construction-documents', [':comp_id',':id']) }}"
                url = url.replace(':id', id);
                url = url.replace(':comp_id',comp_id);

                window.location.href = url;
            });
        });
    </script>
@stop
