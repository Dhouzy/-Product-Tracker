
(function () {
    $(document).ready(function() {
        $("#products-list").find(".item").each(function () {
            $(this).registerTooltip();
        });

        $('#products-list a').click(function (event) {
            $("#products-list .item").removeClass("selected");
            $(this).parent().addClass("selected");
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

