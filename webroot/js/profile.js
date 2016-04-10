


(function () {

    $(document).ready(function() {
        $("#products-list").children(".item").each(function () {
            registerTooltip($(this));
        });

        $('a').click(function () {
            getGraphics($(this)[0].id);
        });
    });

    function getGraphics(id) {
        console.log(id);
    }

})();