/**
 * Created by Vincent on 22/04/2016.
 */
$(document).ready(function() {
    $('tabs');

    createGraphic();

    function createGraphic() {
        var id = $('input[name=product_uid]').val();

        $.ajax({
            url : '/graphics/graphics',
            type : 'POST',
            data: {
                productId: id
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