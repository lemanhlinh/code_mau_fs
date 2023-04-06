$(document).ready( function(){
    var alert_info = $('#alert_info').val();
    alert_info1 = alert_info ? JSON.parse(alert_info) : [];
    $('.submitbt').click(function(){
        if(checkFormsubmit())
            document.contact.submit();
    })
    
});
function checkFormsubmit()
{
    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    // email_new = $('#email_new').val();

    // if(!notEmpty("contact_company",alert_info1[11]))
    // {
    //     return false;
    // }
    if(!notEmpty("contact_name",alert_info1[1]))
    {
        scrollTop('#contact_name');
        return false;
    }

    if(!notEmpty("contact_email", alert_info1[3])){
        scrollTop('#contact_email');
        return false;
    }
    if(!emailValidator("contact_email", alert_info1[4])){
        return false;
    }
    if(!notEmpty("contact_phone",alert_info1[5]))
        return false;

    if(!isPhone("contact_phone",alert_info1[6]))
        return false;
    if(!lengthMin("contact_phone",10,alert_info1[12]))
    {
        return false;
    }
    if(!notEmpty("message",alert_info1[13]))
    {
        return false;
    }
    return true;
}
function scrollTop(name) {
    if (!name)
        return false;
    $(name).focus();
    //var top_ = $(name).position().top;
    var offset = $(name).offset();
    $('html, body').animate({
        scrollTop: offset.top - 150
    }, 'slow');
}
	     
