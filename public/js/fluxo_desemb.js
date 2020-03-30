id = $("#competences").val();
url = "/area-do-cliente/graficos/fluxodesemb/:id";
url = url.replace(':id', id);
axios.get(url)
    .then((response) => {
        dados = response.data;

        dados = dados[0];

        Highcharts.chart('barra5', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[1]['fluxodesemb']['delta']+'%'
            },
            xAxis: {
                crosshair: true,
                title: {
                    text: dados[1]['description']
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
                data: [dados[1]['fluxodesemb']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[1]['fluxodesemb']['real']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#6f7124'],
                        [1, '#ae9c20']
                    ]
                }

            }]
        });
        Highcharts.chart('barra6', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[0]['fluxodesemb']['delta']+'%'
            },
            xAxis: {
                crosshair: true,
                title: {
                    text: dados[0]['description']
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
                data: [dados[0]['fluxodesemb']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[0]['fluxodesemb']['real']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#6f7124'],
                        [1, '#ae9c20']
                    ]
                }

            }]
        });

    })
    .catch((error) => {
        $("#fluxodesemb").html("Não foi possível realizar o carregamento destes graficos.");
    });
