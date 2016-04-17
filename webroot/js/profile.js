


(function () {

    $(document).ready(function() {
        $("#products-list").children(".item").each(function () {
            $(this).registerTooltip();
        });

        $('.item-list a').click(function (event) {
            getGraphics($(this)[0].id);
            event.preventDefault();
            event.stopPropagation();
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

