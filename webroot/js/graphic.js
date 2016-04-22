
var chartPriceData = null;
var chartDiscountData = null;

function loadGraphics() {

    $('#FromDate').datepicker({
        showOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });
    $('#ToDate').datepicker({
        showOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });

    $('#FromDate, #ToDate').on('change', function (e) {
        modifyGraphsDates();
    });

    setChartsGlobalParameters();

    $('#ProductPriceVariationChart').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Product price variation'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                day: "%b %e, %Y",
                week: "%b %e, %Y"
            }
        },
        yAxis: {
            labels: {
                enabled: true
            },
            title: {
                text: 'Price ($)'
            }
        },
        tooltip: {
            formatter: function () {
                var date = '<b>' + Highcharts.dateFormat('%A, %b %e, %Y', this.x) + '</b><br />';
                return date + "$" + this.y;
            }
        },
        credits: {
            enabled: false
        }
    });

    if($("#DataForProductPriceVariationChart").length > 0) {
        chartPriceData = $.parseJSON($("#DataForProductPriceVariationChart").val());
    }

    if($("#DataForProductPriceDiscountVariationChart").length > 0) {
        chartDiscountData = $.parseJSON($("#DataForProductPriceDiscountVariationChart").val());
    }

    var year = moment().format('YYYY');
    var month = moment().format('MM');
    var maxDays = moment().daysInMonth();
    var minDate = year + "-" + month + "-01";
    var maxDate = year + "-" + month + "-" + maxDays;

    $('#FromDate').val(minDate);
    $('#ToDate').val(maxDate);

    modifyGraphsDates();
}

function modifyGraphsDates() {

    var fromSelectedDate = $('#FromDate').val();
    var toSelectedDate = $('#ToDate').val();

    var chartPrice = $('#ProductPriceVariationChart').highcharts();

    while(chartPrice.series.length > 0)
        chartPrice.series[0].remove(true);

    var serie1, serie2;

    //Graph 1
    if(chartPriceData !== null && chartPrice) {
        var chartPriceDataBetweenDates = tableValuesBetweenDates(chartPriceData, fromSelectedDate, toSelectedDate);
        var tempPrice = [];
        for (var i = 0; i < chartPriceDataBetweenDates.length; i++) {
            var element1 = {
                x :  moment(chartPriceDataBetweenDates[i].date, "YYYY-M-D").valueOf(),
                y : chartPriceDataBetweenDates[i].price
            };
            tempPrice.push(element1);
        }
        serie1 = {
            name: 'Price',
            type: 'line',
            data: tempPrice,
            color: '#adad85'
        };
    }

    //Graph 2
    if(chartDiscountData !== null && chartPrice) {
        var chartDiscountDataBetweenDates = tableValuesBetweenDates(chartDiscountData, fromSelectedDate, toSelectedDate);
        var tempDiscount = [];
        for (var y = 0; y < chartDiscountDataBetweenDates.length; y++) {
            var element2 = {
                x : moment(chartDiscountDataBetweenDates[y].date, "YYYY-M-D").valueOf(),
                y : chartDiscountDataBetweenDates[y].price
            };
            tempDiscount.push(element2);
        }
        serie2 = {
            name: 'Discount price',
            type: 'line',
            data: tempDiscount,
            color: '#e00007'
        };
    }

    chartPrice.addSeries(serie1);
    chartPrice.addSeries(serie2);
}

function tableValuesBetweenDates(table, date1, date2) {
    var tempTable = [];

    $.each(table, function(index, value) {
        if(value.date >= date1 && value.date <= date2) {
            tempTable.push(value);
        }
    });

    return tempTable;
}

// Taken from http://www.highcharts.com/demo/line-basic/dark-unica
// Highchart theme
function setChartsGlobalParameters() {

    Highcharts.setOptions({
        global : {
            useUTC : true
        }
    });

    Highcharts.theme = {
        colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
            "#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
        chart: {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 1, y2: 1 },
                stops: [
                    [0, '#2a2a2b'],
                    [1, '#3e3e40']
                ]
            },
            style: {
                fontFamily: "'Unica One', sans-serif"
            },
            plotBorderColor: '#606063'
        },
        title: {
            style: {
                color: '#E0E0E3',
                textTransform: 'uppercase',
                fontSize: '20px'
            }
        },
        subtitle: {
            style: {
                color: '#E0E0E3',
                textTransform: 'uppercase'
            }
        },
        xAxis: {
            gridLineColor: '#707073',
            labels: {
                style: {
                    color: '#E0E0E3'
                }
            },
            lineColor: '#707073',
            minorGridLineColor: '#505053',
            tickColor: '#707073',
            title: {
                style: {
                    color: '#A0A0A3'

                }
            }
        },
        yAxis: {
            gridLineColor: '#707073',
            labels: {
                style: {
                    color: '#E0E0E3'
                }
            },
            lineColor: '#707073',
            minorGridLineColor: '#505053',
            tickColor: '#707073',
            tickWidth: 1,
            title: {
                style: {
                    color: '#A0A0A3'
                }
            }
        },
        tooltip: {
            backgroundColor: 'rgba(0, 0, 0, 0.85)',
            style: {
                color: '#F0F0F0'
            }
        },
        plotOptions: {
            series: {
                dataLabels: {
                    color: '#B0B0B3'
                },
                marker: {
                    lineColor: '#333'
                }
            },
            boxplot: {
                fillColor: '#505053'
            },
            candlestick: {
                lineColor: 'white'
            },
            errorbar: {
                color: 'white'
            }
        },
        legend: {
            itemStyle: {
                color: '#E0E0E3'
            },
            itemHoverStyle: {
                color: '#FFF'
            },
            itemHiddenStyle: {
                color: '#606063'
            }
        },
        credits: {
            style: {
                color: '#666'
            }
        },
        labels: {
            style: {
                color: '#707073'
            }
        },

        drilldown: {
            activeAxisLabelStyle: {
                color: '#F0F0F3'
            },
            activeDataLabelStyle: {
                color: '#F0F0F3'
            }
        },

        navigation: {
            buttonOptions: {
                symbolStroke: '#DDDDDD',
                theme: {
                    fill: '#505053'
                }
            }
        },

        // scroll charts
        rangeSelector: {
            buttonTheme: {
                fill: '#505053',
                stroke: '#000000',
                style: {
                    color: '#CCC'
                },
                states: {
                    hover: {
                        fill: '#707073',
                        stroke: '#000000',
                        style: {
                            color: 'white'
                        }
                    },
                    select: {
                        fill: '#000003',
                        stroke: '#000000',
                        style: {
                            color: 'white'
                        }
                    }
                }
            },
            inputBoxBorderColor: '#505053',
            inputStyle: {
                backgroundColor: '#333',
                color: 'silver'
            },
            labelStyle: {
                color: 'silver'
            }
        },

        navigator: {
            handles: {
                backgroundColor: '#666',
                borderColor: '#AAA'
            },
            outlineColor: '#CCC',
            maskFill: 'rgba(255,255,255,0.1)',
            series: {
                color: '#7798BF',
                lineColor: '#A6C7ED'
            },
            xAxis: {
                gridLineColor: '#505053'
            }
        },

        scrollbar: {
            barBackgroundColor: '#808083',
            barBorderColor: '#808083',
            buttonArrowColor: '#CCC',
            buttonBackgroundColor: '#606063',
            buttonBorderColor: '#606063',
            rifleColor: '#FFF',
            trackBackgroundColor: '#404043',
            trackBorderColor: '#404043'
        },

        // special colors for some of the
        legendBackgroundColor: 'rgba(0, 0, 0, 0.5)',
        background2: '#505053',
        dataLabelsColor: '#B0B0B3',
        textColor: '#C0C0C0',
        contrastTextColor: '#F0F0F3',
        maskColor: 'rgba(255,255,255,0.3)'
    };

// Apply the theme
    Highcharts.setOptions(Highcharts.theme);

}