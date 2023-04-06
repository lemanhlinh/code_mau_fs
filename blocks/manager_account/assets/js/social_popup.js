/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    //document.getElementById("form_log_popup").classList.toggle("open");
    var menu = $('#form_log_popup');
    if (menu.hasClass('open')) {
		menu.removeClass('open'); 
	}
	else{
		menu.addClass('open');
	}
}

// Close the dropdown menu if the user clicks outside of it
$(document).mouseup(function (e)
{
    var container = $(".form_log");
    var menu = $('#form_log_popup');
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        menu.removeClass('open');
        //container.addClass('show-open'); 
    }
});    