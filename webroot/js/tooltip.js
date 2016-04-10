






function registerTooltip($element) {
    $element.on({
        mouseover: function () {
            mouseOver($(this));
        },
        mouseleave: function () {
            mouseLeave($(this));
        }
    });
}

function removeToolTip($element) {
    $element.off('mouseover');
    $element.off('mouseleave');
}

function mouseOver($element) {
    $element.children(".tooltip").css("display", "inline-block");

    var left;
    var top;

    if ($element.children(".tooltip").hasClass("top-tooltip")) {
        left = $element.offset().left + (($element.width() / 2) - ($element.children(".tooltip").width() / 2));
        top = $element.offset().top - ($element.height() + $element.children(".tooltip").height() + 10);
    } else if($element.children(".tooltip").hasClass("bottom-tooltip")) {
        left = $element.offset().left + (($element.width() / 2) - ($element.children(".tooltip").width() / 2));
        top = $element.offset().top + $element.height() + 20;
    } else if($element.children(".tooltip").hasClass("left-tooltip")) {
        left = $element.offset().left - $element.children(".tooltip").width() - 30;
        top = $element.offset().top - ($element.children(".tooltip").height() - $element.height());
    } else if($element.children(".tooltip").hasClass("right-tooltip")) {
        left = $element.offset().left + $element.width() + 30;
        top = $element.offset().top - ($element.children(".tooltip").height() - $element.height());
    }

    $element.children(".tooltip").css({top: top, left: left});
}

function mouseLeave($element) {
    $element.children(".tooltip").css("display", "none");
}