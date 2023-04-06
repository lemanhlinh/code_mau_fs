// function show_data_created(id){
//     $("#myModaldownload").load("/index.php?module=products&view=product&task=ajax_check_notification&raw=1", {'id':id});
// }

$(document).ready(function () {
    var alert_info = $('#alert_info').val();
    alert_info1 = alert_info ? JSON.parse(alert_info) : [];
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "contact_"+type+id;
        if (checkFormsubmit20(id,type))
        // document.contact_hot56.submit();
            document.getElementById(myForm).submit();
    })
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "dangky_"+type+id;
        if (checkFormsubmit21(id,type))
        // document.contact_hot56.submit();
            document.getElementById(myForm).submit();
    })
    $('.send').click(function () {
        id= $(this).attr("data_id");
        type= $(this).attr("data_type");
        myForm = "download_"+type+id;
        if (checkFormsubmit22(id,type))
        // document.contact_hot56.submit();
            document.getElementById(myForm).submit();
    })
    $('#btnn').click(function () {

        if (checkFormsubmit1())
            document.contact1111.submit();
    })
    $('#btnn2').click(function () {

        if (checkFormsubmit2())
            document.contact1112.submit();
    })
    $('#btnn3').click(function () {

        if (checkFormsubmit3())
            document.order100.submit();
    })
    $('#btnn4').click(function () {

        if (checkFormsubmit4())
            document.contact1113.submit();
    })
    $('#btnn5').click(function () {

        if (checkFormsubmit5())
            document.contact1114.submit();
    })
    $('#btnn6').click(function () {

        if (checkFormsubmit6())
            document.contact1116.submit();
    })
    $('#btnn7').click(function () {

        if (checkFormsubmit7())
            document.contact7.submit();
    })
    $('#btnn8').click(function () {

        if (checkFormsubmit8())
            document.contact8.submit();
    })
    $('#btnn9').click(function () {

        if (checkFormsubmit9())
            document.contact9.submit();
    })
    $('#btnn10').click(function () {

        if (checkFormsubmit10())
            document.contact10.submit();
    })
    $('#btnn11').click(function () {

        if (checkFormsubmit11())
            document.contact11.submit();
    })
    $(".search2").click(function () {
        val1 = $('#input2').val();
        if (val1) {
            link = $('#input2').attr("data-url");
            loaisp = $('#input2').attr("data-loaisp");
            ungdung = $('#input2').attr("data-ungdung");
            linhvuc = $('#input2').attr("data-linhvuc");
            hangsx = $('#input2').attr("data-hangsx");

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
            link1 = link + 'san-pham.html?key=' + val1 + url;
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert('Bạn phải nhập từ khóa');
            return false;
        }

    });
    $('#input2').keypress(function (e) {
        if (e.which == 13) {
            val1 = $('#input2').val();
            if (val1) {
                link = $('#input2').attr("data-url");
                loaisp = $('#input2').attr("data-loaisp");
                ungdung = $('#input2').attr("data-ungdung");
                linhvuc = $('#input2').attr("data-linhvuc");
                hangsx = $('#input2').attr("data-hangsx");

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
                link1 = link + 'san-pham.html?key=' + val1 + url;
                // alert(link1);
                window.location = link1;
                return false;
            } else {
                alert('Bạn phải nhập từ khóa');
                return false;
            }
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



function checkFormsubmit1() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name1", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city111", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email_contact", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email_contact", alert_info1[4])) {
            return false;
    }if (!notEmpty("phone1", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone1", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone1", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha1",alert_info1[11]))
        return false;
    // return false;
    return true;
}


function checkFormsubmit2() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name2", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city2", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email_download", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email_download", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone2", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone2", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone2", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if (!notValue("version2", alert_info1[10])) {
        return false;
    }
    if(!notEmpty("txtCaptcha2",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit3() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name3", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city3", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email_order", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email_order", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone3", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone3", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone3", "10", "12",  alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha3",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit4() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name4", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city4", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email4", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email4", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone4", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone4", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone4", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha4",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit5() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name5", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city5", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email5", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email5", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone5", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone5", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone5", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha5",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit6() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name6", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city6", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email6", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email6", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone6", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone6", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone6", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha6",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit7() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name7", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city7", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email7", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email7", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone7", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone7", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone7", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha7",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit8() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name8", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city8", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email8", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email8", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone8", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone8", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone8", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha8",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit9() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name9", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city9", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email9", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email9", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone9", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone9", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone9", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha9",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit10() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name10", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city10", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email10", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email10", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone10", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone10", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone10", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha10",alert_info1[11]))
        return false;
    // return false;
    return true;
}
function checkFormsubmit11() {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
    if (!notEmpty2("name11", alert_info1[0], alert_info1[1])) {
        return false;
    }
    if (!notValue("city11", alert_info1[2])) {
        return false;
    }
    if (!notEmpty("email11", alert_info1[3])) {
        return false;
    }
    if (!emailValidator("email11", alert_info1[4])) {
        return false;
    }if (!notEmpty("phone11", alert_info1[5])) {
        return false;
    }
    if (!isPhone("phone11", alert_info1[6])) {
        return false;
    }
    if (!lengthRestriction("phone11", "10", "12", alert_info1[7] + ' 10 ' + alert_info1[9] + ' 12 ' + alert_info1[8])) {
        return false;
    }
    if(!notEmpty("txtCaptcha11",alert_info1[11]))
        return false;

    // return false;
    return true;
}
function checkFormsubmit20(id,type) {

    $('label.label_error').prev().remove();
    $('label.label_error').remove();
    email_new = $('#email_new').val();
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
    // return false;
    return true;
}
function checkFormsubmit21(id,type) {

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
function checkFormsubmit22(id,type) {

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