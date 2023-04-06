

$(document).ready(function() {
    var $width = $( window ).width();
    if($width < 769){
        $('.libraries-carousel').carousel({
            num: 3,
            maxWidth: 230,
            maxHeight: 130,
            distance: 60,
            scale: 0.6,
            animationTime: 1000,
            showTime: 3000,
            // autoPlay: false
        });
    }
    else {
    $('.libraries-carousel').carousel({
        num: 3,
        maxWidth: 550,
        maxHeight: 330,
        distance: 300,
        scale: 0.6,
        animationTime: 1000,
        showTime: 3000,
        // autoPlay: false
    });
    }
});