click_tab();
countChar();
change_price();
submit_comment();
show_violate();
display_hidden_comment_form();
$(document).ready( function(){
	// update hits
	setTimeout(function() {
		var product_id = $('#product_id').val();
		$.get("/index.php?module=products&view=product&task=update_hits&raw=1",{id: product_id}, function(status){
		});
	}, 3000);

});
	
function click_tab(){
	$('.product-tab li').click(function () {
		$('.product-tab li').removeClass('selected');
		$(this).addClass('selected');
		var a = $(this).attr('data-tab');
//		alert(a);
		$("html, body").animate({
			scrollTop: $('#' +a).offset().top
		}, 600);
	});
}
function submit_comment()
{
	$('#submitbt').click(function(){
//		if(!notEmpty2("name",'Họ tên',"Bạn phải nhập họ tên"))
//			return false;
//		if(!notEmpty2("email",'Email',"Bạn phải nhập email"))
//			return false;
//		if(!emailValidator("email","Email không đúng định dạng"))
//			return false;	
		if(!notEmpty2("text-comment",'Nội dung',"Bạn phải nhập nội dung"))
			return false;
		document.comment_add_form.submit();
		return true;
	});
}
function buy_add(product_id){
	link = root + 'index.php?module=products&view=cart&task=buy_multi&id='+product_id+'&Itemid=94';
	id_add  = '';
	i = 0;
	var buy_count = parseInt($('#buy_count').val());
	if(!buy_count)
		buy_count = 1;
	link += '&buy_count='+buy_count; 
	if($('.product_incentives')){
		$('.product_incentives').each(function(index) {
			if($(this).is(':checked')){
				if(i > 0)
					id_add += ',';	
				id_add += $(this).val();	
				i ++;
			}
		});
	}
	if(id_add){
		link += '&add='+id_add
	}
	window.location = link;
}
/****** TREE COMMENTS ******/
function submit_reply(comment_id){
	if(!notEmpty2('text_'+comment_id,'Nội dung','Bạn phải nhập nội dung')){
		return false;
	}
	$('#comment_reply_form_'+comment_id).submit();
}
function display_hidden_comment_form(){
	$('.button_reply').click(function(){
		$(this).next().removeClass('hide');
		$(this).addClass('hide');
	});
	$('.button_reply_close').click(function(){
		$(this).parent().parent().parent().addClass('hide');
		$(this).parent().parent().parent().prev().removeClass('hide');
	});
}
function countChar() {
    CharacterCount = function(TextArea,FieldToCount){
    	var myField = document.getElementById(TextArea)
    	var myLabel = document.getElementById(FieldToCount); 
    	if(!myField || !myLabel){return false}; // catches errors
    	var MaxChars =  myField.maxLengh;
    	if(!MaxChars){
    		MaxChars =  myField.getAttribute('maxlength') ; 
    		}; 	
    	if(!MaxChars){
    		return false
    	};
    	var remainingChars =   MaxChars - myField.value.length
    	myLabel.innerHTML = "Bạn đã nhập "+remainingChars+" từ. Tối đa "+MaxChars+" từ"
    }
    setInterval(function(){CharacterCount('text-comment','CharCountLabel1')},55);
  };
  
  function isNumberKey(evt){
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
	    return true;
	}
function  change_price(){
	func_change_price = function(numbers_pro,price,total_price,total_price_end,quantity){
			var field_numbers_pro = document.getElementById(numbers_pro);
			var field_price = document.getElementById(price); 
			var label_total_price = document.getElementById(total_price); 
	    	var label_total_price_end = document.getElementById(total_price_end);
			
	    	if(!field_numbers_pro){return false}; // catches errors
			
	    	label_total_price.innerHTML = '<b><span>'+((field_numbers_pro.value)*(field_price.value)/1000).toFixed(3)+' VNĐ <b><span>';
			label_total_price_end.innerHTML = '<b><span>'+((field_numbers_pro.value)*(field_price.value)/1000).toFixed(3)+' VNĐ <b><span>';
			$('#'+quantity).val(field_numbers_pro.value);
	  }
	  setInterval(function(){func_change_price('numbers-pro','price-product','total-price','total-price-end','quantity')},55);
}  
function submitForm()
{
  	if(checkFormsubmit())
  	{
  		$('#eshopcart_info').submit();
  	}
  }
function checkFormsubmit()
{
	$('label.label_error').prev().remove();
	$('label.label_error').remove();
	// sender
	if(!notEmpty("sender_name","B&#7841;n ch&#432;a nh&#7853;p t&#234;n ng&#432;&#7901;i g&#7917;i"))
		return false;
	if(!notEmpty("sender_telephone","B&#7841;n ch&#432;a nh&#7853;p s&#7889; phone ng&#432;&#7901;i nh&#7853;p"))
		return false;
	if(!isPhone("sender_telephone","B&#7841;n nh&#7853;p kh&#244;ng &#273;&#250;ng &#273;&#7883;nh d&#7841;ng c&#7911;a tr&#432;&#7901;ng &#273;i&#7879;n tho&#7841;i"))
		return false;
	if(!notEmpty("sender_email","B&#7841;n ch&#432;a nh&#7853;p email ng&#432;&#7901;i g&#7917;i"))
		return false;
	if(!emailValidator("sender_email","Email ng&#432;&#7901;i &#273;&#7863;t h&#224;ng kh&#244;ng &#273;&#250;ng &#273;&#7883;nh d&#7841;ng"))
		return false;
	if(!notEmpty("sender_address","B&#7841;n ch&#432;a nh&#7853;p &#273;&#7883;a ch&#7881; ng&#432;&#7901;i g&#7917;i"))
		return false;
	return true;
}

/*
 * Báo cáo vi phạm
 */

function show_violate(){
	$('.report_violate').click(function(){
		$('.violate_area').slideToggle('slow');	
	})
}
