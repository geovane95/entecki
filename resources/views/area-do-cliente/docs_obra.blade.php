@extends('area-do-cliente.template.template')
@section('style')
    <!-- favicon -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
                            <a href="{{ route('client-space.pictures-download', [$actualcomp, $actualconst]) }}"
                               class="pic">
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
                            str_replace('JAN','JANEIRO',
                            str_replace('FEV','FEVEREIRO',
                            str_replace('MAR','MARÇO',
                            str_replace('ABR','ABRIL',
                            str_replace('MAI','MAIO',
                            str_replace('JUN','JUNHO',
                            str_replace('JUL','JULHO',
                            str_replace('AGO','AGOSTO',
                            str_replace('SET','SETEMBRO',
                            str_replace('OUT','OUTUBRO',
                            str_replace('NOV','NOVEMBRO',
                            str_replace('DEZ','DEZEMBRO',
                            $competence->description))))))))))))
                        }}
                    </h4>
                    <div class="col-md-10 offset-md-1">
                        <ul class="list-files">
                            @foreach($documents as $document)
                                <li>
                                    <a href="{{ storage_path($document->folder) }}" target="_blank"
                                       title="{{ $document->fileName }}" class="{{ $document->extension }}">
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
                                    @foreach(array_unique($competencesMonth) as $competence)
                                        <option value="{{ $competence }}">
                                            {{ $meses[$competence] }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                Ano
                                <select name="year" id="year">
                                    <option value="0">Selecione</option>
                                    @foreach(array_unique($competencesYear) as $competence)
                                        <option value="{{ $competence }}">
                                            {{ $competence }}
                                        </option>
                                    @endforeach
                                </select>
                            </label>
                        </form>
                        <div id="accordion">

                        </div>
                    </div>
                </div>
            </div>


            <div class="row tabelas-pad">

                <div class="col-md-12 d-flex justify-content-center align-items-center nav-btns">
                    <a href="docs_obra.blade.php" class="btn-nav">
                        Obra Anterior
                    </a>
                    <a href="{{ back() }}" class="btn-nav">
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

        function geraListagemAcordion() {
            let month = $("#month").val();
            let year = $("#year").val();
            let construction = '{{ $actualconst }}';
            let url = "";
            let first = true;
            if (month != 0 && year != 0) {
                url = "{{ route('competence.list', [':construction',':month',':year']) }}";

                url = url.replace(':construction', construction);

                url = url.replace(':month', month);

                url = url.replace(':year', year);
            } else if (month != 0 && year == 0) {
                url = "{{ route('competence.list.args', [':construction',':month']) }}";

                url = url.replace(':construction', construction);

                url = url.replace(':month', month);
            } else if (month == 0 && year != 0) {
                url = "{{ route('competence.list.args', [':construction',':year']) }}";

                url = url.replace(':construction', construction);

                url = url.replace(':year', year);
            }else{
                url = "{{ route('competence.list.args', [':construction',2020]) }}";

                url = url.replace(':construction', construction);

                url = url.replace(':year', year);
            }
            console.log(url);
            axios.get(url)
                .then(response => {
                    let dados = response.data;
                    let arrays = dados.success;
                    console.log(arrays);
                    let template = "<div class=\"card\">\n" +
                        "                            <div class=\"card-header\" id=\"headingThree\">\n" +
                        "                              <h5 class=\"mb-0\">\n" +
                        "                                <button class=\"btn btn-link collapsed\" data-toggle=\"collapse\" data-target=\"#:descriptionreb\" aria-expanded=\"false\" aria-controls=\":descriptionreb\">\n" +
                        "                                    :descriptionreplaceb\n" +
                        "                                </button>\n" +
                        "                              </h5>\n" +
                        "                            </div>\n" +
                        "                            <div id=\":descriptionreb\" class=\"collapse\" aria-labelledby=\"headingThree\" data-parent=\"#accordion\">\n" +
                        "                              <div class=\"card-body\">\n" +
                        "                                    <ul class=\"list-files\" id='files_:descriptionreb'>\n" +
                        "                                    </ul>\n" +
                        "                              </div>\n" +
                        "                            </div>\n" +
                        "                          </div>\n" +
                        "                        </div>";
                    let templateli =
                        "<li>\n" +
                        "    <a href=\"#\" target=\"_blank\" title=\":filename\" class=\":filetype\">\n" +
                        "        :filename\n" +
                        "    </a>\n" +
                        "</li>\n"
                    $("#accordion").html("");
                    for (let i = 0; i < arrays.length; i++) {
                        let newTemplate = template.replace(/:descriptionreb/g, arrays[i].description.replace('/', ''));
                        newTemplate = newTemplate.replace(/:descriptionreplaceb/g, arrays[i].description.replace('/', ' '));
                        $("#accordion").append(newTemplate);
                        let documents = arrays[i].documents;
                        for (let j = 0; j < documents.length; j++) {
                            if(first){
                                $("#files_" + arrays[i].description.replace('/', '')).addClass('show');
                                first = false;
                            }
                            let document = arrays[i].documents[j];
                            let newTemplateLi = templateli.replace(/:filename/g, document.fileName);
                            newTemplateLi = newTemplateLi.replace(/:filetype/g, document.extension);
                            $("#files_" + arrays[i].description.replace('/', '')).append(newTemplateLi);
                        }
                    }
                })
                .catch((error) => {

                })
                .finally(() => {

                });
        }
    </script>
@stop
