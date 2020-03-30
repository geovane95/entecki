id = $("#competences").val();
url = "/area-do-cliente/graficos/fluxofinanobra/:id";
url = url.replace(':id', id);
axios.get(url)
    .then((response) => {
        dados = response.data;

        dados = dados[0];

        Highcharts.chart('barra1', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[3]['fluxofinanobra']['delta']+'%'
            },
            xAxis: {
                crosshair: true,
                title: {
                    text: dados[3]['description']
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
                data: [dados[3]['fluxofinanobra']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[3]['fluxofinanobra']['real']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#6f7124'],
                        [1, '#ae9c20']
                    ]
                }

            }]
        });
        Highcharts.chart('barra2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[2]['fluxofinanobra']['delta']+'%'
            },
            xAxis: {
                crosshair: true,
                title: {
                    text: dados[2]['description']
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
                data: [dados[2]['fluxofinanobra']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[2]['fluxofinanobra']['real']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#6f7124'],
                        [1, '#ae9c20']
                    ]
                }

            }]
        });
        Highcharts.chart('barra3', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[1]['fluxofinanobra']['delta']+'%'
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
                data: [dados[1]['fluxofinanobra']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[1]['fluxofinanobra']['real']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#6f7124'],
                        [1, '#ae9c20']
                    ]
                }

            }]
        });
        Highcharts.chart('barra4', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Δ = '+dados[0]['fluxofinanobra']['delta']+'%'
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
                data: [dados[0]['fluxofinanobra']['prevrev']],
                color: {
                    linearGradient: {x1: 0, x2: 0, y1: 0, y2: 1},
                    stops: [
                        [0, '#002953'],
                        [1, '#6c85af']
                    ]
                }

            }, {
                name: 'Real (R$)',
                data: [dados[0]['fluxofinanobra']['real']],
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
        $("#fluxofinanobra").html("Não foi possível realizar o carregamento destes graficos.");
    });
