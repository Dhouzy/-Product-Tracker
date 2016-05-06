/**
 * Created by Vincent on 22/04/2016.
 */
$(document).ready(function() {
    createGraphic();

    function createGraphic() {
        $.ajax({
            url : '/graphics/graphics',
            type : 'POST',
            data: {
                productId: productUid
            },
            dataType: "html",
            success : function(html) {
                $("#chart").html(html);
                loadGraphics();
                $('#chart').find('.btn').hide();
            }
        });
    }
});