$(document).ready( function(){
  $('.list_new').owlCarousel({
      loop:true,
      margin:40,
      nav:true,
      dots:false,
      autoplay: true,
      smartSpeed: 1500,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:3
          }
      }
  })  ;
    $('.list_app').owlCarousel({
        loop:true,
        margin:20,
        // nav:true,
        dots:true,
        autoplay: true,
        smartSpeed: 1500,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            991:{
                items:2
            }
        }
    })  ;
});
$(".click_app").click(function () {
    var id = $(this).attr('data-id');
    $(".click_app").removeClass('active');
    $(this).addClass('active');
    $(".item_ap").hide();
    $(".app_"+id).show(500);
});