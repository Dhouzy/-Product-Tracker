(function ($) {

    $.fn.registerTooltip = function() {
        this.on({
            mousemove: function(event) {
                mouseOver($(this), event);
            },
            mouseleave: function () {
                mouseLeave($(this));
            }
        });

        return this;
    };

    $.fn.removeToolTip = function () {
        this.off('mousemove');
        this.off('mouseleave');

        return this;
    };

}(jQuery));

function mouseOver($element, event) {
    var left;
    var top;

    if ($element.children(".tooltip").hasClass("top-tooltip")) {
        left = event.clientX - ($element.children(".tooltip").width() / 2);
        top = event.clientY - $element.children(".tooltip").height() - 50;
    } else if($element.children(".tooltip").hasClass("bottom-tooltip")) {
        left = event.clientX - ($element.children(".tooltip").width() / 2);
        top = event.clientY + 50;
    } else if($element.children(".tooltip").hasClass("left-tooltip")) {
        left = event.clientX - $element.children(".tooltip").width() - 50;
        top = event.clientY - ($element.children(".tooltip").height() / 2);
    } else if($element.children(".tooltip").hasClass("right-tooltip")) {
        left = event.clientX + 50;
        top = event.clientY - ($element.children(".tooltip").height() / 2);
    }

    $element.children(".tooltip").css({top: top, left: left});
    $element.children(".tooltip").css("display", "inline-block");
}

function mouseLeave($element) {
    $element.children(".tooltip").css("display", "none");
}