$(document).ready(function () {
    setTimeout(function () {
        var news_id = $('#news_id').val();
        $.get("/index.php?module=news&view=news&task=update_hits&raw=1", {id: news_id}, function (status) {
        });
    }, 3000);
    $(".btn_search").click(function () {
        var alert1 = $("#alert_ip").val();
        val1 = $('#input2').val();
        if (val1) {
            link = $('#input2').attr("data-url");
            lang = $('#input2').attr("data-lang");

            // if(this.value){

            link1 = link + lang + '.html?key=' + val1;
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }

    });
    $(".btn_search1").click(function () {
        var alert1 = $("#alert_ip").val();
        val1 = $('#input3').val();
        if (val1) {
            link = $('#input3').attr("data-url");
            lang = $('#input3').attr("data-lang");

            // if(this.value){

            link1 = link + lang + '.html?key=' + val1;
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }

    });
});
$('#input2').keypress(function (e) {
    if (e.which == 13) {
        var alert1 = $("#alert_ip").val();
        val1 = $('#input2').val();
        if (val1) {
            link = $('#input2').attr("data-url");
            // alert(sort1);
            lang = $('#input2').attr("data-lang");

            // if(this.value){

            link1 = link + lang + '.html?key=' + val1;
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }
    }
});
$('#input3').keypress(function (e) {
    if (e.which == 13) {
        var alert1 = $("#alert_ip").val();
        val1 = $('#input3').val();
        if (val1) {
            link = $('#input3').attr("data-url");
            // alert(sort1);
            lang = $('#input3').attr("data-lang");

            // if(this.value){

            link1 = link + lang + '.html?key=' + val1;
            // alert(link1);
            window.location = link1;
            return false;
        } else {
            alert(alert1);
            return false;
        }
    }
});