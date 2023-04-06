
$(document).ready(function() {
    $('.list_image').owlCarousel({
        loop:true,
        margin:0,
        nav:true,
        dots:false,
        autoplay: true,
        smartSpeed: 1500,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })  ;

});

