
var chartPriceData = null;
var chartDiscountData = null;

function loadGraphics() {

    Highcharts.setOptions({
        global : {
            useUTC : true
        }
    });

    $('#fromDatepicker').datepicker({
        showOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });
    $('#toDatepicker').datepicker({
        showOtherMonths: true,
        dateFormat: 'yy-mm-dd'
    });

    $('#fromDatepicker, #toDatepicker').on('change', function (e) {
        modifyGraphsDates();
    });

    if($("#productPriceVariationChart").length > 0) {
        chartPriceData = $.parseJSON($("#dataForProductPriceVariationChart").val());
        $('#productPriceVariationChart').highcharts({
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
    }

    if($("#productPriceDiscountVariationChart").length > 0) {
        chartDiscountData = $.parseJSON($("#dataForProductPriceDiscountVariationChart").val());
        $('#productPriceDiscountVariationChart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Product discount price variation'
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
    }

    var year = moment().format('YYYY');
    var month = moment().format('MM');
    var maxDays = moment().daysInMonth();
    var minDate = year + "-" + month + "-01";
    var maxDate = year + "-" + month + "-" + maxDays;

    $('#fromDatepicker').val(minDate);
    $('#toDatepicker').val(maxDate);

    modifyGraphsDates();

    $("#tab-graph-1")[0].click();
}

function modifyGraphsDates() {
    var fromSelectedDate = $('#fromDatepicker').val();
    var toSelectedDate = $('#toDatepicker').val();

    var chartPrice = $('#productPriceVariationChart').highcharts();
    var chartDiscount = $('#productPriceDiscountVariationChart').highcharts();

    //Graph 1
    if(chartPriceData !== null && chartPrice) {
        var chartPriceDataBetweenDates = tableValuesBetweenDates(chartPriceData, fromSelectedDate, toSelectedDate);
        if (chartPrice.series.length > 0) {
            chartPrice.series[0].remove();
        }
        var tempPrice = [];
        for (var i = 0; i < chartPriceDataBetweenDates.length; i++) {
            var date1 = chartPriceDataBetweenDates[i].x.split("-");
            var element1 = {
                x : Date.UTC(date1[0], date1[1], date1[2]),
                y : chartPriceDataBetweenDates[i].y
            };
            tempPrice.push(element1);
        }
        chartPrice.addSeries({
            name: 'Price',
            type: 'line',
            data: tempPrice,
            color: '#2f7ed8'
        });
    }

    //Graph 2
    if(chartDiscountData !== null && chartDiscount) {
        var chartDiscountDataBetweenDates = tableValuesBetweenDates(chartDiscountData, fromSelectedDate, toSelectedDate);
        if (chartDiscount.series.length > 0) {
            chartDiscount.series[0].remove();
        }
        var tempDiscount = [];
        for (var y = 0; y < chartDiscountDataBetweenDates.length; y++) {
            var date2 = chartDiscountDataBetweenDates[y].x.split("-");
            var element2 = {
                x : Date.UTC(date2[0], date2[1], date2[2]),
                y : chartDiscountDataBetweenDates[y].y
            };
            tempDiscount.push(element2);
        }
        chartDiscount.addSeries({
            name: 'Discount price',
            type: 'line',
            data: tempDiscount,
            color: '#2f7ed8'
        });
    }
}

function tableValuesBetweenDates(table, date1, date2) {
    var tempTable = [];

    $.each(table, function(index, value) {
        if(value.x >= date1 && value.x <= date2) {
            tempTable.push(value);
        }
    });

    return tempTable;
}