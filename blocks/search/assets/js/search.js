$(document).ready(function(){
    $("#open_search").click(function(){
        $("#search_form").toggle();
    });
    $("#open_search1").click(function(){
        $("#search_form1").toggle();
    });
});
function submit_form_search() {
    var alert1 = $("#alert_ip").val();
    itemid = 20;
		url = '';
		var keyword = document.getElementById('keyword').value;
		keyword = encodeURIComponent(encodeURIComponent(keyword));
		var link_search = document.getElementById('link_search').value;
		if(keyword!= 'Tìm kiếm' && keyword != '')	{
			url += 	'&keyword='+keyword;
			var check = 1;
		}else{
			var check =0;
		}
		if(check == 0){
			alert(alert1);
			return false;
		}
//		if(link_search.indexOf("&") == '-1')
		var link = link_search+'/'+keyword+'.html';
//		else
//			var link = link_search+'&keyword='+keyword+'&Itemid=9';
		
		window.location.href=link;
		return false;
}

function submit_form_search2() {
    itemid = 20;
    url = '';
    var keyword = document.getElementById('input_search').value;
    keyword = encodeURIComponent(encodeURIComponent(keyword));
    var link_search = document.getElementById('link_search_mobile').value;
    if(keyword!= 'Tìm kiếm' && keyword != '')	{
        url += 	'&keyword='+keyword;
        var check = 1;
    }else{
        var check =0;
    }
    if(check == 0){
        alert('Bạn phải nhập tham số tìm kiếm');
        return false;
    }
//		if(link_search.indexOf("&") == '-1')
    var link = link_search+'/'+keyword+'.html';
//		else
//			var link = link_search+'&keyword='+keyword+'&Itemid=9';

    window.location.href=link;
    return false;
}
$(".search2").click(function () {
    var alert1 = $("#alert_ip").val();
    val1 = $('#keyword').val();
    search = $('#url').val();
    if (val1) {
        link = $('#keyword').attr("data-url");
        link1 = link + search + val1+'.html';
        // alert(link1);
        window.location = link1;
        return false;
    } else {
        alert(alert1);
        return false;
    }

});
$('#keyword').keypress(function (e) {
    var alert1 = $("#alert_ip").val();

    if (e.which == 13) {
        val1 = $('#keyword').val();
        search = $('#url').val();
        // alert(val1);
        if (val1) {
            link = $('#keyword').attr("data-url");
            link1 = link + search + val1+'.html';
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }
    }
});
$("#search2").click(function () {
    var alert1 = $("#alert_ip").val();
    val1 = $('#keyword1').val();
    search = $('#url').val();
    if (val1) {
        link = $('#keyword1').attr("data-url");
        link1 = link + search + val1+'.html';
        // alert(link1);
        window.location = link1;
        return false;
    } else {
        alert(alert1);
        return false;
    }

});
$('#keyword1').keypress(function (e) {
    var alert1 = $("#alert_ip").val();

    if (e.which == 13) {
        val1 = $('#keyword1').val();
        search = $('#url').val();
        // alert(val1);
        if (val1) {
            link = $('#keyword1').attr("data-url");
            link1 = link + search + val1+'.html';
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }
    }
});


