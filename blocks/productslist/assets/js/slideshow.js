$(document).ready(function() {
  //var type = $('#type_block').val();  
  $(".owl-list").owlCarousel({
    autoplay: true, //Set AutoPlay to 3 seconds
    autoplaySpeed: 2000,
    loop:true,
    autoplayTimeout: 3000,
    autoplayHoverPause:true,
    animateOut: 'fadeOut',
    items : 4,
    nav:false,
    responsive:{
        0:{
            items:2,
            margin:20,
        },
       
        992:{
            items:4,
            margin:30,
        },
    }
  });
 
});