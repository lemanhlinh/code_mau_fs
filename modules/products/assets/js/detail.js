$(document).ready( function(){
    click_tab_detail(1);
	// update hits
	setTimeout(function() {
		var products_id = $('#products_id').val();
		$.get("/index.php?module=products&view=product&task=update_hits&raw=1",{id: products_id}, function(status){
		});
	}, 3000);
    
});

	     
function click_tab_detail(){
	$('.product_tabs_ul li').click(function(){
		var id=$(this).attr('id');
		$('.product_tabs_ul').find('.activated').removeClass('activated');
		$('#'+id).addClass('activated');
		$('.product_tab_content').find('.selected').removeClass('selected').addClass('hide');
		$('#'+id+'_content').removeClass('hide').addClass('selected');
	});
}
