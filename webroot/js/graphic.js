



(function () {

    $(document).ready(function() {

        setChartsParameters();

        if($("#productPriceVariationChart").length > 0) {
            var chartData1 = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: $.parseJSON($("#dataForProductPriceVariationChart").val())
                    }
                ]
            };

            var ctxChart1 = $("#productPriceVariationChart").get(0).getContext("2d");
            var productPriceVariationChart = new Chart(ctxChart1).LineAlt(chartData1, {
                scaleLabel: "          <%=value%>"
            });
        }

        if($("#productPriceDiscountVariationChart").length > 0) {
            var chartData2 = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: $.parseJSON($("#dataForProductPriceDiscountVariationChart").val())
                    }
                ]
            };

            var ctxChart2 = $("#productPriceDiscountVariationChart").get(0).getContext("2d");
            var productPriceDiscountVariationChart = new Chart(ctxChart2).LineAlt(chartData2, {
                scaleLabel: "          <%=value%>"
            });
        }
    });


    function setChartsParameters() {
        Chart.types.Line.extend({
            name: "LineAlt",
            draw: function () {
                Chart.types.Line.prototype.draw.apply(this, arguments);
                var ctx = this.chart.ctx;
                ctx.save();
                ctx.textAlign = "center";
                ctx.textBaseline = "bottom";
                ctx.fillStyle = this.options.scaleFontColor;
                var x = this.scale.xScalePaddingLeft * 0.4;
                var y = this.chart.height / 2;
                ctx.translate(x, y);
                ctx.rotate(-90 * Math.PI / 180);
                ctx.fillText(this.datasets[0].label, 0, 0);
                ctx.restore();
            }
        });

        Chart.defaults.global = {
            animation: true,
            animationSteps: 60,
            animationEasing: "easeOutQuart",
            showScale: true,
            scaleOverride: false,
            scaleSteps: null,
            scaleStepWidth: null,
            scaleStartValue: null,
            scaleLineColor: "rgba(0,0,0,.1)",
            scaleLineWidth: 1,
            scaleShowLabels: true,
            scaleLabel: "<%=value%>",
            scaleIntegersOnly: true,
            scaleBeginAtZero: false,
            scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            scaleFontSize: 12,
            scaleFontStyle: "normal",
            scaleFontColor: "#666",
            responsive: false,
            maintainAspectRatio: true,
            showTooltips: true,
            customTooltips: false,
            tooltipEvents: ["mousemove", "touchstart", "touchmove"],
            tooltipFillColor: "rgba(0,0,0,0.8)",
            tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            tooltipFontSize: 14,
            tooltipFontStyle: "normal",
            tooltipFontColor: "#fff",
            tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            tooltipTitleFontSize: 14,
            tooltipTitleFontStyle: "bold",
            tooltipTitleFontColor: "#fff",
            tooltipYPadding: 6,
            tooltipXPadding: 6,
            tooltipCaretSize: 8,
            tooltipCornerRadius: 6,
            tooltipXOffset: 10,
            tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            multiTooltipTemplate: "<%= value %>",
            onAnimationProgress: function(){},
            onAnimationComplete: function(){}
        };
    }

})();