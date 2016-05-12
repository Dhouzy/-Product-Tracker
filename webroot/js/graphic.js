
var chart = null;
var priceData = null;
var discountData = null;

function loadGraphics() {
    if($('#ProductPriceVariationChart')){
        $('#FromDate, #ToDate').on('change', function (e) {
            modifyGraphsDates();
        });

        setChartTheme();

        var dateFormat = $('#highcharts-date-format').val();

        $('#ProductPriceVariationChart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: $('#graph-title').val()
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    millisecond: dateFormat + " %H:%M",
                    second: dateFormat + " %H:%M",
                    minute: dateFormat + " %H:%M",
                    hour: dateFormat + " %Hh",
                    day: dateFormat,
                    week: dateFormat,
                    month: dateFormat,
                    year: dateFormat
                }
            },
            yAxis: {
                labels: {
                    enabled: true
                },
                title: {
                    text: $('#graph-yaxis-title').val()
                }
            },
            tooltip: {
                formatter: function () {
                    var date = '<b>' + Highcharts.dateFormat('%A, ' + dateFormat, this.x) + '</b><br />';
                    return date + "$" + this.y;
                }
            },
            credits: {
                enabled: false
            }
        });

        chart = $('#ProductPriceVariationChart').highcharts();

        if(chart) {
            setChartOptions();
            setDatePickerValues();

            if($("#DataForProductPriceVariationChart").length > 0) {
                priceData = $.parseJSON($("#DataForProductPriceVariationChart").val());
            }

            if($("#DataForProductPriceDiscountVariationChart").length > 0) {
                discountData = $.parseJSON($("#DataForProductPriceDiscountVariationChart").val());

            }

            modifyGraphsDates();
        }
    }
}

function setDatePickerValues(){
    $('#FromDate').datepicker({
        showOtherMonths: true,
        monthNames: $('#datepicker-months').val().split(","),
        dayNamesMin: $('#datepicker-days-min').val().split(","),
        dateFormat: 'yy-mm-dd'
    });
    $('#ToDate').datepicker({
        showOtherMonths: true,
        monthNames: $('#datepicker-months').val().split(","),
        dayNamesMin: $('#datepicker-days-min').val().split(","),
        dateFormat: 'yy-mm-dd'
    });

    var year = moment().format('YYYY');
    var month = moment().format('MM');
    var maxDays = moment().daysInMonth();
    var minDate = year + "-" + month + "-01";
    var maxDate = year + "-" + month + "-" + maxDays;

    $('#FromDate').val(minDate);
    $('#ToDate').val(maxDate);
}

function modifyGraphsDates() {
    var fromSelectedDate = $('#FromDate').val();
    var toSelectedDate = $('#ToDate').val();

    if(!(isValidDateFormat(fromSelectedDate) && isValidDateFormat(toSelectedDate))){
        window.alert(strings.chart.invalidDateFormat);
        return;
    }

    while(chart.series.length > 0)
        chart.series[0].remove(true);

    var serie1, serie2;

    //Serie 1
    if(priceData !== null) {
        var priceDataBetweenDates = tableValuesBetweenDates(priceData, fromSelectedDate, toSelectedDate);
        var tempPrice = [];
        for (var i = 0; i < priceDataBetweenDates.length; i++) {
            var element1 = {
                x :  moment(priceDataBetweenDates[i].date, "YYYY-M-D H:m:s").valueOf(),
                y : priceDataBetweenDates[i].price
            };
            tempPrice.push(element1);
        }
        serie1 = {
            name: $('#price-title').val(),
            type: 'line',
            data: tempPrice,
            color: '#adad85'
        };

        chart.addSeries(serie1);
    }

    //Serie 2
    if(discountData !== null) {
        var discountDataBetweenDates = tableValuesBetweenDates(discountData, fromSelectedDate, toSelectedDate);
        var tempDiscount = [];
        for (var y = 0; y < discountDataBetweenDates.length; y++) {
            var element2 = {
                x : moment(discountDataBetweenDates[y].date, "YYYY-M-D H:m:s").valueOf(),
                y : discountDataBetweenDates[y].price
            };
            tempDiscount.push(element2);
        }
        serie2 = {
            name: $('#discount-price-title').val(),
            type: 'line',
            data: tempDiscount,
            color: '#e00007'
        };

        chart.addSeries(serie2);
    }
}

function isValidDateFormat(strDate){
    return strDate.search(/[0-9]{4}-(0[0-9]|1[0-2])-([0-2][0-9]|3[01])/) != -1;
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

function setChartOptions() {
    Highcharts.setOptions({
        global : {
            useUTC : true
        },
        lang: {
            months: $('#highcharts-months').val().split(","),
            weekdays: $('#highcharts-days').val().split(","),
            shortMonths: $('#highcharts-short-months').val().split(","),
            decimalPoint: $('#highcharts-decimal-point').val()
        }
    });
}

// Taken from http://www.highcharts.com/demo/line-basic/dark-unica
// Highchart theme
function setChartTheme() {

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