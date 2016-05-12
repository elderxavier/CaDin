/* * *********************************************************
 * @ Package Cadin Graficos
 * @ Date 20016/04/18 
 * @Created update 2016/04/18
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This script mount all charts in Graficos page;
 * ********************************************************* */
(function ($) {
    var GRAFICOS = window.GRAFICOS || {};


    GRAFICOS.chartEntradaSaida = function (recebido, gasto) {
        var rec = recebido;
        var gas = gasto;

        var chart2 = new CanvasJS.Chart("chartEntradaSaida", {
            title: {
                text: "Valores Recebidos e Gastos"

            },
            animationEnabled: true,
            axisX: {
                interval: 1,
                gridThickness: 0,
                labelFontSize: 10,
                labelFontStyle: "normal",
                labelFontWeight: "normal",
                labelFontFamily: "Lucida Sans Unicode"

            },
            axisY2: {
                interlacedColor: "rgba(1,77,101,.2)",
                gridColor: "rgba(1,77,101,.1)"

            },
            data: [
                {
                    type: "bar",
                    name: "companies",
                    axisYType: "secondary",
                    color: "#014D65",
                    dataPoints: [
                        {y: rec, label: "Recebido", color:'blue'},
                        {y: gas, label: "Gasto",color:'red'}

                    ]
                }

            ]
        });
        chart2.render();
    };



    GRAFICOS.chartEntradaSaidaPer = function (recebido, gastos) {

        var total = (recebido + gastos);
        rec = (recebido * 100) / total;
        gas = (gastos * 100) / total;

        var chart = new CanvasJS.Chart("chartEntradaSaidaPer", {
            title: {
                text: "Recebimentos x Gastos"
            },
            exportFileName: "Recebimentos x Gastos",
            exportEnabled: true,
            animationEnabled: true,
            legend: {
                verticalAlign: "bottom",
                horizontalAlign: "center"
            },
            data: [
                {
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{legendText}: <strong>{y}%</strong>",
                    indexLabel: "{label} {y}%",
                    dataPoints: [
                        {y: rec, legendText: "Total Recebido", exploded: true, label: "Recebido"},
                        {y: gas, legendText: "Total Gasto", label: "Gasto"},
                    ]
                }
            ]
        });
        chart.render();
    };

    GRAFICOS.initCharts = function () {
        window.onload = function () {
            var recebido = 0;
            var gastos = 0;
            var parse = 0;
            $('#example tr').each(function () {
                var comp = $(this).find('td:eq(1) select option:selected').val();
                var parse = String($(this).find('td:eq(2) input').val());
                parse = parse.replace(' ', '').replace('.', '').replace(',', '.');
                parse = new Number(parse);
                if (!isNaN(parse)) {
                    if (comp == 1) {
                        recebido += parse;
                    } else {
                        gastos += parse;
                    }
                }
            });
            recebido =  recebido.toFixed(2);
            gastos =  gastos.toFixed(2);
            GRAFICOS.chartEntradaSaidaPer(parseFloat(recebido), parseFloat(gastos));
            GRAFICOS.chartEntradaSaida(parseFloat(recebido), parseFloat(gastos));
        };

    };

    GRAFICOS.init = function () {
        GRAFICOS.initCharts();
    };
    GRAFICOS.init();

})(jQuery);