$(document).ready( function(){
	/* FORM CONTACT */
	$('#submitbt_warranty').click(function(){
		var case_number  = $("#case_number").val();
		 var serial_number  = $("#serial_number").val();

	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });
		 $.get("/index.php?module=search&view=warranty&task=fetch_pages&raw=1", {'case_number':case_number,'serial_number':serial_number}, function(html) {
			 $('#results').html(html);
			});  //initial page number to load
	
	})
	$('.contact_form #resetbt').click(function(){
		document.warranty.reset();
	})
});
$("#case_number,#serial_number").bind("keypress", {}, keypressInBox);

function keypressInBox(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) { //Enter keycode                        
        e.preventDefault();
        var case_number  = $("#case_number").val();
		 var serial_number  = $("#serial_number").val();

	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });
		 $.get("/index.php?module=search&view=warranty&task=fetch_pages&raw=1", {'case_number':case_number,'serial_number':serial_number}, function(html) {
			 $('#results').html(html);
			});  //initial page number to load
    }
};
//get object by id
function getObjectById( id ) {
	var obj = null;
	
	if( document.getElementById ) {
		obj = document.getElementById( id );
	}
	else if( document.all ) {
		obj = document.all[id];
	}
	else {
		obj = document.layer[id];
	}
	
	return obj;
}
//show hide object
function ShowHideObject( id ) {

	var obj = getObjectById( id );
	if( obj ) {
		if( obj.style.display == 'none' ) {
			obj.style.display = '';
		}
		else {
			obj.style.display = 'none';
		}	
	}
	return;
}