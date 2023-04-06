$('#submit-bt').click(function(){
	if(checkFormsubmit())
		document.eshopcart_info.submit();
})
//$('#reset-bt').click(function(){
//	document.eshopcart_info.reset();
//})

 // check checkbox
$('.radio').on('change',function(){
    //alert(123);
    var che = $('input[name=ord_payment_type]:checked', '#eshopcart_info').val();
    if(che == 3){
        $(".ord_payment_type3").show();
    }else{
        $(".ord_payment_type3").hide();
    }
    
})

function checkFormsubmit()
{
	if(!notEmpty("sender_name","Bạn phải nhập họ tên"))
	{
		return false;
	}
    if(!lengthMin("sender_name",6,'"Họ tên của bạn" phải 6 kí tự trở lên, vui lòng sửa lại!'))
	{
		return false;
	}
    if(!notEmpty("sender_telephone","Bạn chưa nhập số điện thoại"))
		return false;
        
	if(!isPhone("sender_telephone","Bạn chưa nhập đúng định dạng"))
		return false;
    if(!lengthMin("sender_telephone",8,'"Số điện thoại" phải 8 kí tự trở lên, vui lòng sửa lại!'))
	{
		return false;
	}    
	if(!notEmpty("sender_email","Bạn phải nhập email"))
		return false;
	if(!emailValidator("sender_email","Email nhập không hợp lệ")){
		return false;
	}
    
    if(!notEmpty("sender_address","Bạn chưa nhập địa chỉ"))
		return false;
        
    if(!notEmpty("sender_comments","Bạn phải nhập nội dung"))
		return false;
        
    return true;    
}
