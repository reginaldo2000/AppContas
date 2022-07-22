$(document).ready(() => {
    dashboardInit();
});

const dashboardInit = () => {
    loadGraficoMeses();
    loadGraficoCategorias();
    loadGraficoMediaGastos();
    loadGraficoGastoSaldo();
};

const loadGraficoMeses = () => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/grafico/meses`,
        success: response => {
            console.log(response);
            let options = {
                chart: {
                    type: 'bar'
                },
                plotOptions: {
                    bar: {
                        horizontal: true
                    }
                },
                series: [{
                    data: response.data
                }]
            }
            var chart = new ApexCharts(document.querySelector("#graficoMeses"), options);
            chart.render();
        }
    });

};

const loadGraficoCategorias = () => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/grafico/categorias`,
        success: response => {
            console.log(response);
            let options = {
                chart: {
                    type: 'donut'
                },
                series: response.data,
                labels: response.labels,
                colors: ['#f00', '#fc2', '#4d4', "#22d", "#c3e", "#f0a", "#0ee"]
            };

            var chart = new ApexCharts(document.querySelector("#graficoCategorias"), options);
            chart.render();
        }
    });

};

const loadGraficoMediaGastos = () => {
    let options = {
        chart: {
            type: 'line'
        },
        stroke: {
            curve: 'smooth',
        },
        series: [{
            name: 'sales',
            data: [30, 40, 35, 50, 49, 60, 70, 91, 125]
        }],
        xaxis: {
            categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998, 1999]
        }
    };

    var chart = new ApexCharts(document.querySelector("#graficoMediaGastos"), options);
    chart.render();
};

const loadGraficoGastoSaldo = () => {
    $.ajax({
        type: "GET",
        dataType: "JSON",
        url: `${URL_BASE}/grafico/gasto-saldo`,
        success: response => {
            console.log(response.gasto);
            let options = {
                chart: {
                    type: 'area'
                },
                series: [{
                    name: 'Gasto',
                    data: response.gasto
                }, {
                    name: 'Saldo',
                    data: response.saldo
                }],
                stroke: {
                    curve: 'smooth',
                },
                xaxis: {
                    categories: response.meses
                }
            }

            var chart = new ApexCharts(document.querySelector("#graficoSaldoGasto"), options);
            chart.render();
        }
    });

};