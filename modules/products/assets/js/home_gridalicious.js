$(function () {
	listproductpage2.init();
});
listproductpage2 = (function () {
	function init() {
	    handler();
	    loadmore();
	}
	function handler() {
	 	$(".productlist").gridalicious({
			gutter: 20,
			animate: true,
			animationOptions: {
				speed: 200, 
    			duration: 300
			},
		});
			  
	}

	function loadmore() {
		var pagecurrent =  $('#pagecurrent').val(); //total loaded record group(s)
		pagecurrent = parseInt(pagecurrent);
		var total =  $('#total_record').val(); //total loaded record group(s)
		var filter =  $('#filter').val(); //total loaded record group(s)
		
		$(window).scroll(function() { //detect page scroll
			if($(window).scrollTop() + $(window).height() > $(document).height() - 100){
				if(pagecurrent <= total ) //there's more data to load
				{
					$.get("/index.php?module=products&view=home&task=fetch_pages&raw=1", { pagecurrent:pagecurrent,filter:filter}, function (data) {	             
		            	if(data){
			            	data = JSON.parse(data);
			            	$element = $(data.content);
		                	// $('.productlist').append($element).masonry('appended', $element);
		                	$(".productlist").gridalicious('append', $element); 
		                }
		            });
		            pagecurrent += 4;
		        }
		    }
		});
	}
    return {
        init: init,
    };
})();
