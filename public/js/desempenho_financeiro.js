id = $("#competences").val();
url = "/area-do-cliente/graficos/desempfinan/:id";
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
            periodofisprev.push(value.desempfinan.periodofisprev);
            periodofisprevmesaatual.push(value.desempfinan.periodofisprevmesaatual);
            acumulofisreal.push(value.desempfinan.acumulofisreal);
            acumulofisprev.push(value.desempfinan.acumulofisprev);
            acumulofisproj.push(value.desempfinan.acumulofisproj);
            periodofissubprev.push(value.desempfinan.periodofissubprev);
            periodofisproj.push(value.desempfinan.periodofisproj);
        });

        console.log(categories);
        console.log(periodofisprev);
        console.log(periodofisprevmesaatual);
        console.log(acumulofisreal);
        console.log(acumulofisprev);
        console.log(acumulofisproj);
        console.log(periodofissubprev);
        console.log(periodofisproj);

        Highcharts.chart('container2', {
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
                name: 'Período - Fís. PREV',
                data: periodofisprev,
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
                data: periodofisprevmesaatual,
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
                data: acumulofisreal,
                lineColor: '#182857',
                marker: {
                    lineWidth: 2,
                    lineColor: '#182857',
                    fillColor: 'white'
                }
            }, {
                type: 'spline',
                name: 'Acum - Fís. (PREV)',
                data: acumulofisprev,
                lineColor: '#a9994b',
                marker: {
                    lineWidth: 2,
                    lineColor: '#a9994b',
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
                data: periodofisproj,
                color: '#e07438',
                marker: {
                    radius: 4
                },
                tooltip: {
                    pointFormat: '<b>{point.y}</b>'
                }
            }]
        });


    })
    .catch((error) => {
        console.log(error);
        $("#container2").html("Não foi possível realizar o carregamento deste grafico.");
    });
