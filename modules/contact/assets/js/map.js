var mouseout_activate = 1;

function clickActive(location, show) {
    $(".col-item-event").click(function() {

        // If this isn't already active
        if (!$(this).hasClass("active-col")) {
            // Remove the class from anything that is active
            $("div.active-col").removeClass("active-col");
            // And make this active
            $(this).addClass("active-col");
        }
    });
    check_exist_id(location);
    getLocation(location, show);
}

function check_exist_id(id){
	$.ajax({
    		type : 'POST',
        dataType: 'json',
    		url : root +'index.php?module=contact&view=contact&raw=1&task=map',
    		data: 'id='+id,
            success : function(data){
                if(data.error == false){
                    $('.item-row-map').html(data.html);
                } else {
                    alert('Không load được dữ liệu');
                }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert('Không có dữ liệu');
            }
    	});
}

$(window).on("load", function() {
    //    var location = 0;
    //    getLocation(location,false);
    hover_projects_right();
});



function hover_projects_right() {
    $(".prj_item").mouseover(function() {
        //lert('mouseover');
        if (mouseout_activate == 1) {
            rid = $(this).attr('id');
            rid = parseInt(rid.replace('prj_item_', ''));
            google.maps.event.trigger(markers[rid], "mouseover", {});
        }
    });
    $(".prj_item").mouseout(function() {
        //alert('mouseout');
        if (mouseout_activate == 1) {
            rid = $(this).attr('id');
            rid = parseInt(rid.replace('prj_item_', ''));
            google.maps.event.trigger(markers[rid], "mouseout", {});
        }

    });

    $(".prj_item").click(function() {
        //alert('click');
        rid = $(this).attr('id');
        rid = parseInt(rid.replace('prj_item_', ''));
        google.maps.event.trigger(markers[rid], "click", {});
        mouseout_activate = 0;
    });
}


function readload() {

    var connector = function(itemNavigation, carouselStage) {
        return carouselStage.jcarousel('items').eq(itemNavigation.index());
    };

    $(function() {

        var carouselStage = $('.carousel-stage').jcarousel();
        var carouselNavigation = $('.carousel-navigation').jcarousel();

        carouselNavigation.jcarousel('items').each(function() {
            var item = $(this);

            var target = connector(item, carouselStage);

            item
                .on('jcarouselcontrol:active', function() {
                    carouselNavigation.jcarousel('scrollIntoView', this);
                    item.addClass('active');
                })
                .on('jcarouselcontrol:inactive', function() {
                    item.removeClass('active');
                })
                .jcarouselControl({
                    target: target,
                    carousel: carouselStage
                });
        });

        $('.prev-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.next-navigation')
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
            });
    });


}

function readload_slide() {

    var pages = $('#container_respon li'),
        current = 0;
    var currentPage, nextPage;
    var handler = function() {
        $('#container_respon .button').unbind('click');
        currentPage = pages.eq(current);
        if ($(this).hasClass('prevButton')) {
            if (current <= 0)
                current = pages.length - 1;
            else
                current = current - 1;
        } else {

            if (current >= pages.length - 1)
                current = 0;
            else
                current = current + 1;
        }
        nextPage = pages.eq(current);
        currentPage.fadeTo('slow', 0.3, function() {
            nextPage.fadeIn('slow', function() {
                nextPage.css("opacity", 1);
                currentPage.hide();
                currentPage.css("opacity", 1);
                $('#container_respon .button').bind('click', handler);
            });
        });
    }

    $('#container_respon .button').click(handler);
}
