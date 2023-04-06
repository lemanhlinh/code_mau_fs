$(document).ready( function(){
	/* FORM CONTACT */
	$('#submitbt_serial').click(function(){
//		document.serial.submit();
		 var serial_number  = $("#serial_number").val();
		 
		  	  $(document).ajaxStart(function(){
			    $("#wait").css("display","block");
			  });
			  $(document).ajaxComplete(function(){
			    $("#wait").css("display","none");
			  });
			$("#results").load("/index.php?module=search&view=serial&task=fetch_pages&raw=1", {'page':0,'serial_number':serial_number}, function() {$("#1-page").addClass('active');});  //initial page number to load
	})
	$('.contact_form #resetbt').click(function(){
		document.serial.reset();
	})
});

$("#serial_number").bind("keypress", {}, keypressInBox);

function keypressInBox(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) { //Enter keycode                        
        e.preventDefault();

        var serial_number  = $("#serial_number").val();

	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });
		$("#results").load("/index.php?module=search&view=serial&task=fetch_pages&raw=1", {'page':0,'serial_number':serial_number}, function() {$("#1-page").addClass('active');});  //initial page number to load
    }
};