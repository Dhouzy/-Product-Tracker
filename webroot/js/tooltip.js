






function registerTooltip($element) {
    $element.on({
        mousemove: function () {
            mouseMove($(this));
        },
        mouseover: function () {
            mouseOver($(this));
        },
        mouseleave: function () {
            mouseLeave($(this));
        }
    });
}

function removeToolTip($element) {
    $element.off('mouseMove');
    $element.off('mouseover');
    $element.off('mouseleave');
}


function mouseMove($element) {
    var left = $element.offset().left;
    var top = $element.offset().top;
    console.log(left);
    console.log(top);
    $element.children(".tooltip").css({top: top, left: left});
}

function mouseOver($element) {
    $element.children(".tooltip").css("display", "block");

    mouseMove($element);
}

function mouseLeave($element) {
    $element.children(".tooltip").css("display", "none");
}