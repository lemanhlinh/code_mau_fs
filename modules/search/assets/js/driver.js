$(document).ready( function(){
	/* FORM CONTACT */
	$('#submitbt_driver').click(function(){
		var product_name  = $("#product_name").val();
		 var prd_id  = $("#prd_id").val();
	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });

	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });
		 $.get("/index.php?module=search&view=driver&task=fetch_pages&raw=1", {'product_name':product_name}, function(html) {
			 $('#results').html(html);
		});  //initial page number to load
	})
});
$("#product_name").bind("keypress", {}, keypressInBox);

function keypressInBox(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) { //Enter keycode                        
        e.preventDefault();
        var product_name  = $("#product_name").val();
		 var prd_id  = $("#prd_id").val();

	  	  $(document).ajaxStart(function(){
		    $("#wait").css("display","block");
		  });
		  $(document).ajaxComplete(function(){
		    $("#wait").css("display","none");
		  });
		 $.get("/index.php?module=search&view=driver&task=fetch_pages&raw=1", {'product_name':product_name}, function(html) {
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

