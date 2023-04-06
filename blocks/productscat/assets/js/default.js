$(document).ready(function() {
  $("#owl-list").owlCarousel({
    autoplay: true, //Set AutoPlay to 3 seconds
    autoplaySpeed: 500,
    loop:true,
    margin:40,
    autoplayTimeout: 3000,
    autoplayHoverPause:true,
    items : 4,
    nav:false,
    responsive:{
        0:{
            items:2,
        },
        768:{
            items:3,
        },
        992:{
            items:4,
        },
    }
  });
 
});