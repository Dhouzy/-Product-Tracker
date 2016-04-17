


(function () {

    $(document).ready(function() {
        $("#products-list").children(".item").each(function () {
            $(this).registerTooltip();
        });

        $('a').click(function () {
            getGraphics($(this)[0].id);
        });
    });

    function getGraphics(id) {
        $.ajax({
            url : '/graphics/graphics',
            type : 'POST',
            data: {
                productId: id
            },
            dataType: "html",
            success : function(html) {
                $("#product-graph").html(html);
                loadGraphics();
            }
        });
    }

})();

