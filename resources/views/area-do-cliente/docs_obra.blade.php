@extends('area-do-cliente.template.template')
@section('style')
    <!-- favicon -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="{{url('js/axios.js')}}"></script>
    <script src="{{url('js/jquery.js')}}"></script>
@stop
@section('miolo')

    <section class="miolo detalhe">
        <div class="container-fluid">


            <div class="row d-flex">
                <div class="col-md-12 d-flex flex-column justify-content-between">
                    <div class="title-info d-flex justify-content-between align-items-center">
                        <div>
                            <h2>
                                {{ $construction->name }}
                            </h2>
                            <h3>
                                CONSTRUTORA: {{ $construction->company }}
                            </h3>
                        </div>
                        <div class="botoes d-flex align-items-center">
                            <a href="{{ route('client-space.construction-documents', [$actualcomp, $actualconst])  }}"
                               class="doc active">
                                <i></i>
                                Documentos
                            </a>
                            <a href="{{ route('client-space.pictures-download', [$actualcomp, $actualconst]) }}" class="pic">
                                <i></i>
                                Fotos
                            </a>
                            <a href="{{ route('client-space.construction-report', $actualconst) }}" class="rel">
                                <i></i>
                                Relatório
                            </a>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 mt30">
                    <h1>
                        DOCUMENTOS
                    </h1>
                </div>



                <div class="col-md-12 files atual">
                    <h4>
                        {{
                            str_replace('JAN','JANEIRO ',
                            str_replace('FEV','FEVEREIRO ',
                            str_replace('MAR','MARÇO ',
                            str_replace('ABR','ABRIL ',
                            str_replace('MAI','MAIO ',
                            str_replace('JUN','JUNHO ',
                            str_replace('JUL','JULHO ',
                            str_replace('AGO','AGOSTO ',
                            str_replace('SET','SETEMBRO ',
                            str_replace('OUT','OUTUBRO ',
                            str_replace('NOV','NOVEMBRO ',
                            str_replace('DEZ','DEZEMBRO ',
                            $competence->description))))))))))))
                        }}
                    </h4>
                    <div class="col-md-10 offset-md-1">
                        <ul class="list-files">
                            @foreach($documents as $document)
                            <li>
                                <a href="{{ storage_path($document->folder) }}" target="_blank" title="{{ $document->fileName }}" class="{{ $document->extension }}">
                                    {{ $document->fileName }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 files">
                    <h4>
                       MESES ANTERIORES
                    </h4>

                    <div class="col-md-10 offset-md-1">
                        <form class="filtro-mes-ano d-flex align-items-center">
                             <strong>Buscar</strong>
                            <label>
                                Mês
                                <select name="month" id="month">
                                    <option value="0">Selecione</option>
                                    @foreach($competences as $competence)
                                        <option value="{{ $competence->month }}">
                                            {{ $competence->month }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                Ano
                                <select name="year" id="year">
                                    <option value="0">Selecione</option>
                                    @foreach($competences as $competence)
                                        <option value="{{ $competence->year }}">
                                            {{ $competence->year }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </form>
                        <div id="accordion">
                          <div class="card">
                            <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#nov19" aria-expanded="false" aria-controls="nov19">
                                  Novembro 2019
                                </button>
                              </h5>
                            </div>
                            <div id="nov19" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                              <div class="card-body">
                                    <ul class="list-files">
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.ppt" class="ppt">
                                                Nonoononononononononno.ppt
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.doc" class="doc">
                                                Nonoononononononononno.doc
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.xls" class="xls">
                                                Nonoononononononononno.xls
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.zip" class="zip">
                                                Nonoononononononononno.zip
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.doc" class="doc">
                                                Nonoononononononononno.doc
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.xls" class="xls">
                                                Nonoononononononononno.xls
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.zip" class="zip">
                                                Nonoononononononononno.zip
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.ppt" class="ppt">
                                                Nonoononononononononno.ppt
                                            </a>
                                        </li>
                                    </ul>
                              </div>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#dez19" aria-expanded="false" aria-controls="dez19">
                                    Dezembro 2019
                                </button>
                              </h5>
                            </div>
                            <div id="dez19" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div class="card-body">
                                    <ul class="list-files">
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.ppt" class="ppt">
                                                Nonoononononononononno.ppt
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.doc" class="doc">
                                                Nonoononononononononno.doc
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.xls" class="xls">
                                                Nonoononononononononno.xls
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.zip" class="zip">
                                                Nonoononononononononno.zip
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.doc" class="doc">
                                                Nonoononononononononno.doc
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.xls" class="xls">
                                                Nonoononononononononno.xls
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.zip" class="zip">
                                                Nonoononononononononno.zip
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.pdf" class="pdf">
                                                Nonoononononononononno.pdf
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank" title="Nonoononononononononno.ppt" class="ppt">
                                                Nonoononononononononno.ppt
                                            </a>
                                        </li>
                                    </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row tabelas-pad">

                <div class="col-md-12 d-flex justify-content-center align-items-center nav-btns">
                    <a href="docs_obra.blade.php" class="btn-nav">
                        Obra Anterior
                    </a>
                    <a href="detalhe.blade.php" class="btn-nav">
                        Voltar
                    </a>
                    <a href="docs_obra.blade.php" class="btn-nav">
                        Obra Anterior
                    </a>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function () {
            geraListagemAcordion();

            $("#month").change(function () {
                geraListagemAcordion();
            });

            $("#year").change(function () {
                geraListagemAcordion();
            });
        });
        function geraListagemAcordion(){
            let month = $("#month").val();
            let year = $("#year").val();
            let construction = '{{ $actualconst }}';

            url = "{{ route('listacompetencias', [':construction',':month',':year']) }}";

            url = url.replace(':construction',construction);

            url = url.replace(':month',month);

            url = url.replace(':year',year);

            axios.get(url)
                .then(response => {
                console.log(response);
            })
                .catch((error) => {

            })
                .finally(() => {

            });
        }
    </script>
@stop
