
var chartPriceData = null;
var chartDiscountData = null;

function loadGraphics() {

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

    Highcharts.setOptions({
        global : {
            useUTC : true
        }
    });

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

    if($("#dataForProductPriceVariationChart").length > 0) {
        chartPriceData = $.parseJSON($("#dataForProductPriceVariationChart").val());
    }

    if($("#dataForProductPriceDiscountVariationChart").length > 0) {
        chartDiscountData = $.parseJSON($("#dataForProductPriceDiscountVariationChart").val());
    }

    var year = moment().format('YYYY');
    var month = moment().format('MM');
    var maxDays = moment().daysInMonth();
    var minDate = year + "-" + month + "-01";
    var maxDate = year + "-" + month + "-" + maxDays;

    $('#fromDatepicker').val(minDate);
    $('#toDatepicker').val(maxDate);

    modifyGraphsDates();
}

function modifyGraphsDates() {

    var fromSelectedDate = $('#fromDatepicker').val();
    var toSelectedDate = $('#toDatepicker').val();

    var chartPrice = $('#productPriceVariationChart').highcharts();

    while(chartPrice.series.length > 0)
        chartPrice.series[0].remove(true);

    var serie1, serie2;

    //Graph 1
    if(chartPriceData !== null && chartPrice) {
        var chartPriceDataBetweenDates = tableValuesBetweenDates(chartPriceData, fromSelectedDate, toSelectedDate);
        var tempPrice = [];
        for (var i = 0; i < chartPriceDataBetweenDates.length; i++) {
            var date1 = chartPriceDataBetweenDates[i].date.split("-");
            var element1 = {
                x : Date.UTC(date1[0], date1[1], date1[2]),
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
            var date2 = chartDiscountDataBetweenDates[y].date.split("-");
            var element2 = {
                x : Date.UTC(date2[0], date2[1], date2[2]),
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