$(function(){
    $('img.lazy').lazyload({
        effect : "fadeIn"
    });
});
$('.carousel-footer').owlCarousel({
    margin:10,
    loop: true,
    autoplay:true,
    nav:false,
    dots:false,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:2,
        }
    }

});
$(document).ready(function () {
    $('#rev_slider_4').revolution({
        delay: 5000,
        startwidth: 910,
        startheight:490
    });

    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('#totop').fadeIn();
        } else {
            $('#totop').fadeOut();
        }
    });


    $('#totop').click(function(){
        $('html, body').animate({scrollTop : 0},800);
        return false;
    });


});

$(function(){
    $(".dropdown").hover(
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
            $(this).toggleClass('open');
            $('b', this).toggleClass("caret caret-up");
        });
});