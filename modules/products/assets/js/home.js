$(document).ready(function () {
    var alert_info = $('#alert_info').val();
    alert_info1 = alert_info ? JSON.parse(alert_info) : [];
// alert(alert_info);
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "contact_"+type+id;
        if (checkFormsubmit1(id,type))
            // document.contact_hot56.submit();
        document.getElementById(myForm).submit();
    })
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "dangky_"+type+id;
        if (checkFormsubmit2(id,type))
            // document.contact_hot56.submit();
        document.getElementById(myForm).submit();
    })
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "download_"+type+id;
        if (checkFormsubmit3(id,type))
        // document.contact_hot56.submit();
            document.getElementById(myForm).submit();
    })
    $(".btn_search").click(function () {

        val1 = $('#input2').val();

        // if (val1) {
            link = $('#input2').attr("data-url");
            loaisp = $('#input2').attr("data-loaisp");
            ungdung = $('#input2').attr("data-ungdung");
            linhvuc = $('#input2').attr("data-linhvuc");
            hangsx = $('#input2').attr("data-hangsx");
            lang = $('#input2').attr("data-lang");

            // if(this.value){
            url = "";
            if (loaisp) {
                url += "&loaisp=" + loaisp;
            }
            if (ungdung) {
                url += "&ungdung=" + ungdung;
            }
            if (linhvuc) {
                url += "&linhvuc=" + linhvuc;
            }
            if (hangsx) {
                url += "&hangsx=" + hangsx;
            }
            link1 = link + lang + '.html?key=' + val1 + url;
            // alert(link1);
            window.location = link1;
            return false;
        // } else {
        //     alert('Bạn phải nhập từ khóa');
        //     return false;
        // }

    });
    $('#input2').keypress(function (e) {
        if (e.which == 13) {
            val1 = $('#input2').val();
            // if (val1) {
                link = $('#input2').attr("data-url");
                loaisp = $('#input2').attr("data-loaisp");
                ungdung = $('#input2').attr("data-ungdung");
                linhvuc = $('#input2').attr("data-linhvuc");
                hangsx = $('#input2').attr("data-hangsx");
                lang = $('#input2').attr("data-lang");

                // if(this.value){
                url = "";
                if (loaisp) {
                    url += "&loaisp=" + loaisp;
                }
                if (ungdung) {
                    url += "&ungdung=" + ungdung;
                }
                if (linhvuc) {
                    url += "&linhvuc=" + linhvuc;
                }
                if (hangsx) {
                    url += "&hangsx=" + hangsx;
                }
                link1 = link + lang + '.html?key=' + val1 + url;
                // alert(link1);
                window.location = link1;
                return false;
            // } else {
            //     alert('Bạn phải nhập từ khóa');
            //     return false;
            // }
        }
    });

    // update hits
    setTimeout(function () {
        var product_id = $('#product_id').val();
        $.get(root + "index.php?module=products&view=product&task=update_hits&raw=1", {
            id: product_id
        }, function (status) {
        });
    }, 3000);

});
$(".clickmore").click(function () {

    var id = $(this).attr("data-id");

    var less = $(this).attr("data-class");


    if (less == 1) {

        $("#" + id).height("auto");

        $(this).html("Thu gọn");

        $(this).removeAttr("data-class");

    } else {

        var height = $("#" + id).attr("data-height");

        $("#" + id).height(height);

        $(this).html("Xem thông tin đầy đủ");

        $(this).attr("data-class", "1");
    }
});


$("#gach1").bind("click", function () {
    $('html, body').animate({
        scrollTop: $(".a-z").offset().top - $(".utility-content").height() - 130
    }, 1000);
});


function checkFormsubmit1(id,type) {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    // alert(alert_info__[1]);
    // return false;
    if (!notEmpty2("name_"+type+id, alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city_"+type+id, alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email_"+type+id, alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email_"+type+id, alert_info1[4])) {
            return false;
    }if (!notEmpty("phone_"+type+id, alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone_"+type+id, alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone_"+type+id, "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha_"+type+id,alert_info1[11]))
        return false;
    // $.ajax({url: "/index.php?module=users&task=ajax_check_captcha&raw=1",
    //     data: {txtCaptcha: $('#txtCaptcha_'+type+id).val()},
    //     dataType: "text",
    //     async: false,
    //     success: function(data) {
    //         console.log(data);
    //         $('label.username_check').prev().remove();
    //         $('label.username_check').remove();
    //         if(data == '0'){
    //             invalid('txtCaptcha_'+type+id,'Captcha là không chính xác.');
    //             alert('Captcha is incorrect');
    //             console.log('--------');
    //             return false;
    //         } else {
    //             valid('txtCaptcha_p');
    //             console.log('+++');
    //             document.contact_popup.submit();
    //             return true;
    //         }
    //     }
    // });
    // return false;
    return true;
}
function checkFormsubmit2(id,type) {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("namedk_"+type+id, alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("citydk_"+type+id, alert_info1[2])) {
        return false;
    }
    if (!notEmpty("emaildk_"+type+id, alert_info1[3])) {
        return false;
    }
    if (!emailValidator("emaildk_"+type+id, alert_info1[4])) {
            return false;
    }if (!notEmpty("phonedk_"+type+id, alert_info1[5])) {
        return false;
    }
    if (!isPhone("phonedk_"+type+id, alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phonedk_"+type+id, "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptchadk_"+type+id,alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit3(id,type) {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("namedl_"+type+id, alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("citydl_"+type+id, alert_info1[2])) {
        return false;
    }
    if (!notEmpty("emaildl_"+type+id, alert_info1[3])) {
        return false;
    }
    if (!emailValidator("emaildl_"+type+id, alert_info1[4])) {
        return false;
    }if (!notEmpty("phonedl_"+type+id, alert_info1[5])) {
        return false;
    }
    if (!isPhone("phonedl_"+type+id, alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phonedl_"+type+id, "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if (!notValue("versiondl_"+type+id, alert_info1[10])) {
        return false;
    }
    if(!notEmpty("txtCaptchadl_"+type+id,alert_info1[11]))
        return false;
    // return false;
    return true;
}
