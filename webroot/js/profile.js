


(function () {

    $(document).ready(function() {
        $("#products-list").children(".item").each(function () {
            registerTooltip($(this));
        });
    });



})();