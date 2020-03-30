id = $("#competences").val();
url = "/area-do-cliente/graficos/fislocalacummacroetapas/:id";
url = url.replace(':id', id);
axios.get(url)
    .then((response) => {
        dados = response.data;

        dados = dados[0];

        categories = [];
        periodofisprev = [];
        periodofisprevmesaatual = [];
        acumulofisreal = [];
        acumulofisprev = [];
        acumulofisproj = [];
        periodofissubprev = [];
        periodofisproj = [];


        $.each(dados, function (index, value) {
            categories.push(value.description);
            periodofisprev.push(value.fisacummacroetapas.periodofisprev);
            periodofisprevmesaatual.push(value.fisacummacroetapas.periodofisprevmesaatual);
            acumulofisreal.push(value.fisacummacroetapas.acumulofisreal);
            acumulofisprev.push(value.fisacummacroetapas.acumulofisprev);
            acumulofisproj.push(value.fisacummacroetapas.acumulofisproj);
            periodofissubprev.push(value.fisacummacroetapas.periodofissubprev);
            periodofisproj.push(value.fisacummacroetapas.periodofisproj);
        });

        console.log(categories);
        console.log(periodofisprev);
        console.log(periodofisprevmesaatual);
        console.log(acumulofisreal);
        console.log(acumulofisprev);
        console.log(acumulofisproj);
        console.log(periodofissubprev);
        console.log(periodofisproj);
        Highcharts.chart('container', {
            xAxis: {
                categories: categories
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
                name: 'Período - Fís. PREV ',
                data: periodofisprev,
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
                data: periodofisprevmesaatual,
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
                data: acumulofisreal,
                lineColor: '#434343',
                marker: {
                    lineWidth: 2,
                    lineColor: '#434343',
                    fillColor: 'white'
                }
            }, {
                type: 'spline',
                name: 'Acum - Fís. (PREV)',
                data: acumulofisprev,
                lineColor: '#182857',
                marker: {
                    lineWidth: 2,
                    lineColor: '#182857',
                    fillColor: 'white'
                }
            }, {
                type: 'spline',
                name: 'Acum - Fís. (PROJ)',
                data: acumulofisproj,
                lineColor: '#e07438',
                marker: {
                    lineWidth: 2,
                    lineColor: '#e07438',
                    fillColor: 'white'
                }
            }, {
                type: 'scatter',
                name: 'Período - Fís. (PREV)',
                data: periodofissubprev,
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
                data: periodofisproj,
                color: '#e07438 ',
                marker: {
                    radius: 4
                }, //{series.name}
                tooltip: {
                    pointFormat: '<b>{point.y}</b>'
                }
            }]
        });


    })
    .catch((error) => {
        console.log(error);
        $("#container").html("Não foi possível realizar o carregamento deste grafico.");
    });
