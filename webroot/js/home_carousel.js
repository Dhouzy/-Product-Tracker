/**
 * Created by M-A on 06/05/16.
 */
$(document).ready(function () {
    $('.home-carousel').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true
    });
});