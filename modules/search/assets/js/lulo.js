// $Header: /cvsroot/phpldapadmin/phpldapadmin/htdocs/js/pla_ajax.js,v 1.2 2007/12/15 07:50:31 wurley Exp $

/**
 * @package phpLDAPadmin
 * @author The phpLDAPadmin development team
 * @author Xavier Bruyet
 */

// current request
var http_request = null;
var http_request_success_callback = '';
var http_request_error_callback = '';

// include html into a component
function includeHTML(component, html) {
	if (typeof(component) == 'string')
		component = getObjectById(component);
	
	if (typeof(component) != 'object' || typeof(html) != 'string')
		return;
	
	if( html.indexOf(":#:LoginPage") >= 0 || html.indexOf(":#:ErrorPage") >= 0 ) {
		window.location.href = 'index.php';
		return;
	}
	
	component.innerHTML = html;

	var scripts = component.getElementsByTagName('script');
	if (!scripts) return;

	// load scripts
	for (var i = 0; i < scripts.length; i++) {
		var scriptclone = document.createElement('script');
		if (scripts[i].attributes.length > 0) {
			for (var j in scripts[i].attributes) {
				if (typeof(scripts[i].attributes[j]) != 'undefined'
				    && typeof(scripts[i].attributes[j].nodeName) != 'undefined'
				    && scripts[i].attributes[j].nodeValue != null
				    && scripts[i].attributes[j].nodeValue != '') {
					    scriptclone.setAttribute(scripts[i].attributes[j].nodeName, scripts[i].attributes[j].nodeValue);
				}
			}
		}
		scriptclone.text = scripts[i].text;
		scripts[i].parentNode.replaceChild(scriptclone, scripts[i]);
		eval(scripts[i].innerHTML);
	}
}

// callback function
function alertHttpRequest() {
	if (http_request && (http_request.readyState == 4)) {		
		if (http_request.status == 200) {
			response = http_request.responseText;
			http_request = null;
			//alert(response);
			if (http_request_success_callback) {
				eval(http_request_success_callback + '(response)');
			}
		} else {
			alert('There was a problem with the request.');
			cancelHttpRequest();
		}
	}
}

function cancelHttpRequest() {
	if (http_request) {
		http_request = null;
		if (http_request_error_callback) {
			eval(http_request_error_callback + '()');
		}
	}
}

// resquest
function makeGETRequest(url, parameters, successCallbackFunctionName, errorCallbackFunctionName) {
	makeHttpRequest(url, parameters, 'GET', successCallbackFunctionName, errorCallbackFunctionName);
}

function makePOSTRequest(url, parameters, successCallbackFunctionName, errorCallbackFunctionName) {
	makeHttpRequest(url, parameters, 'POST', successCallbackFunctionName, errorCallbackFunctionName);
}

function makeHttpRequest(url, parameters, meth, successCallbackFunctionName, errorCallbackFunctionName) {
	cancelHttpRequest();

	http_request_success_callback = successCallbackFunctionName;
	http_request_error_callback = errorCallbackFunctionName;

	if (window.XMLHttpRequest) { // Mozilla, Safari,...
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/html');
		}
	}
	else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {}
		}
	}

	if (!http_request) {
		alert('Cannot create XMLHTTP instance.');
		return false;
	}

	http_request.onreadystatechange = window['alertHttpRequest'];
	if (meth == 'GET')
		url = url + '?' + parameters;
	
	http_request.open(meth, url, true);

	http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http_request.setRequestHeader("Content-length", parameters.length);
	http_request.setRequestHeader("Connection", "close");

	if (meth == 'GET')
		parameters = null;
	
	http_request.send(parameters);
}

// -------------------------- // -------------------------- //
/*
 * something function in ajax
 * created 2008/05/21
 * created by thuyqt
 */
 
var isIE = isSupportedIE();
var OLns4 = (navigator.appName=='Netscape' && parseInt(navigator.appVersion)==4);
var ns = (navigator.appName.indexOf("Netscape") != -1);

function isSupportedIE() {
	var userAgent = navigator.userAgent.toLowerCase() ;

	// IE Check supports ActiveX controls
	if (userAgent.indexOf("msie") != -1 && userAgent.indexOf("mac") == -1 && userAgent.indexOf("opera") == -1) {
		var version = navigator.appVersion.match(/MSIE (.\..)/)[1] ;
		if(version >= 5.5 ) {
			return true;
		}
		else {
			return false;
		}
	}
}

// find obj's position
function findElementPos(obj) {
	var x = 0;
	var y = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			x += obj.offsetLeft;
			y += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}//if offsetParent exists
	else if (obj.x && obj.y) {
		y += obj.y;
		x += obj.x;
	}
	return new coordinate(x, y);
}//findElementPos
		
function findElementPosX(el) {
	curleft = 0;
	if (el.offsetParent) {
		while (el.offsetParent) {
			curleft += el.offsetLeft;
			el = el.offsetParent;
		}
	}//if offsetParent exists
	else if (el.x)
		curleft += el.x;
		
	return curleft;
}

function findElementPosY(el) {
	curtop = 0;
	if (el.offsetParent) {
		while (el.offsetParent) {
			curtop += el.offsetTop;
			el = el.offsetParent;
		}
	}//if offsetParent exists
	else if (el.y)
		curtop += el.y;
		
	return curtop;
}

/**
 * coordinate class
 **/
function coordinate(_x, _y) {
  var x = _x;
  var y = _y;
  this.add = add;
  this.sub = sub;
  this.x = x;
  this.y = y;

  function add(rh) {
    return new position(this.x + rh.x, this.y + rh.y);
  }

  function sub(rh) {
    return new position(this.x + rh.x, this.y + rh.y);
  }
}

function disableBody( status ) {
	if( typeof(status) == 'undefined' ) {
		status = true;
	}
	
	if( !getObjectById('lulo_overlay') ) {
		var objBody = document.getElementsByTagName("body").item(0);
		
		var objOverlay = document.createElement("div");
		objOverlay.id = 'lulo_overlay';
		objOverlay.className = 'overlay';
		objOverlay.style.display = 'none';
		objBody.appendChild(objOverlay);
	}
	
	var overlayDuration = 0.2;
	var overlayOpacity = 0.8;
	
	var objOverlay = getObjectById('lulo_overlay');
	
	if( status == true ) {
		var arrayPageSize = getPageSize();
		
		objOverlay.style.width = arrayPageSize[0] +'px';
		objOverlay.style.height = arrayPageSize[1] +'px';
		
		objOverlay.style.display = 'block';
	}
	else {
		objOverlay.style.display = 'none';
		
		objOverlay.style.width = '0px';
		objOverlay.style.height = '0px';
	}
}

// define Lusi class
var LUSI = function() {
	return {
		/**
		 * AJAX status class 
		 */ 
		ajaxStatusClass: {},
		/**
		 * AJAX Login class 
		 */ 
		ajaxLoginClass: {},
		/**
		 * General namespace for Lusi utils
		 */
		util: {},
		/**
		 * Tab selector utils
		 */ 
		tabChooser: {}
	}
}();

/**
 * General Lusi Utils
 */ 
LUSI.util = function () {
	return {
		evalScript:function(text) {
			objRegex = /<\s*script[^>]*>((.|\s|\v|\0)*?)<\s*\/script\s*>/igm;
			result = objRegex.exec(text)
				
			while(result) {
				try{
					eval(result[1]);
				} 
				catch(e) {}
				result = objRegex.exec(text);
			}
		},

		getViewportWidth: function() {
			 var width = -1;
			 var mode = document.compatMode;

			 if (mode || isIE) { // (IE, Gecko, Opera)
					switch (mode) {
						case 'CSS1Compat': // Standards mode
							 width = document.documentElement.clientWidth;
							 break;
	
						default: // Quirks
							 width = document.body.clientWidth;
							 break;
					}
			 }
			 else { // Safari
					width = self.innerWidth;
			 }
			 return width;
		},

		getViewportHeight: function() {
			 var height = -1;
			 var mode = document.compatMode;

			 if (mode || isIE) { // (IE, Gecko, Opera)
					switch (mode) {
						case 'CSS1Compat': // Standards mode
							 height = document.documentElement.clientHeight;
							 break;
	
						default: // Quirks
							 height = document.body.clientHeight;
							 break;
					}
			 }
			 else { // Safari
					height = self.innerHeight;
			 }
			 return height;
		},
		
		getRegion:function(el) {
			var height 	= parseInt(OLns4 ? el.clip.height : el.offsetHeight);
			var width 	= parseInt(OLns4 ? el.clip.width : el.offsetWidth);
			
			var Region = {width:width, height:height};	
			return Region;
		},
		
		getXY:function(el) {
			var left 	= findElementPosX(el);
			var top 	= findElementPosY(el);
			
			var XY = {left:left, top:top};	
			return XY;
		}
	};
}();

// --- begin ajax status class
LUSI.ajaxStatusClass = function() {};
LUSI.ajaxStatusClass.prototype.statusDiv = null;
LUSI.ajaxStatusClass.prototype.oldOnScroll = null;
LUSI.ajaxStatusClass.prototype.shown = false; // state of the status window

// reposition the status div, top and centered
LUSI.ajaxStatusClass.prototype.positionStatus = function() {
	var scrollTop = 0;
	if (document.documentElement && document.documentElement.scrollTop)
		scrollTop = ns ? pageYOffset : document.documentElement.scrollTop;
	else if (document.body)
		scrollTop = ns ? pageYOffset : document.body.scrollTop;
		
	this.statusDiv.style.top = (scrollTop + 50) + 'px';
	statusDivRegion = LUSI.util.getRegion(this.statusDiv);
	statusDivWidth = statusDivRegion.width;
	
	this.statusDiv.style.left = (LUSI.util.getViewportWidth() / 2 - statusDivRegion.width / 2) + 'px';
}

// private func, create the status div
LUSI.ajaxStatusClass.prototype.createStatus = function(text) {
	statusDiv = document.createElement('div');
	statusDiv.className = 'loading';
	statusDiv.style.position = 'absolute';
	
	statusDiv.style.opacity = .8;
	statusDiv.style.filter = 'alpha(opacity=80)';
	statusDiv.id = 'ajaxStatusDiv';
	document.body.appendChild(statusDiv);
	this.statusDiv = getObjectById('ajaxStatusDiv');
}

// public - show the status div with text
LUSI.ajaxStatusClass.prototype.showStatus = function(text) {
	if (typeof text == 'undefined') {
		if (typeof strLoading == 'string') {
			text = strLoading;
		}
		else {
			text = 'Loading...';
		}
	}
	
	if(!this.statusDiv) {
		this.createStatus(text);	
	}
	else {
		this.statusDiv.style.display = '';
	}
	this.statusDiv.innerHTML = '&nbsp;<b>' + text + '</b>&nbsp;';
	this.positionStatus();
	
	if(!this.shown) {
		this.shown = true;
		this.statusDiv.style.display = '';
		
		if(window.onscroll)
			this.oldOnScroll = window.onscroll; // save onScroll
		window.onscroll = this.positionStatus;		
	}
}

// public - hide it
LUSI.ajaxStatusClass.prototype.hideStatus = function(text) {
	if(!this.shown)
		return;
		
	this.shown = false;
	
	if(this.oldOnScroll)
		window.onscroll = this.oldOnScroll;
	else
		window.onscroll = '';
	this.statusDiv.style.display = 'none';
}

LUSI.ajaxStatusClass.prototype.flashStatus = function(text, time) {
	this.showStatus(text);
	
	window.setTimeout('ajaxStatus.hideStatus();', time);
}
// --- end ajax status class
var ajaxStatus = new LUSI.ajaxStatusClass();
// ----------------- // ----------------- //

// --- begin ajax login form class
LUSI.ajaxLoginClass = function() {};
LUSI.ajaxLoginClass.prototype.loginDiv = null;
LUSI.ajaxLoginClass.prototype.oldOnScroll = null;
LUSI.ajaxLoginClass.prototype.shown = false; // state of the status window

// private func, create the status div
LUSI.ajaxLoginClass.prototype.createLogin = function( width, height ) {
	var loginDiv = document.createElement('div');
	
	loginDiv.id = 'ajaxLoginDiv';
	loginDiv.className = 'login_form';
	loginDiv.style.position = 'absolute';	
	loginDiv.style.opacity = .8;
	loginDiv.style.filter = 'alpha(opacity=80)';
	loginDiv.style.width = width +'px';
	loginDiv.style.height = height +'px';
	
	document.body.appendChild(loginDiv);
	this.loginDiv = getObjectById('ajaxLoginDiv');
}

// public - show the status div with text
LUSI.ajaxLoginClass.prototype.showLogin = function( params, width, height, url ) {
	if( typeof (params) == 'undefined' ) {
		params = 'option=com_login';
	}
	if( typeof (width) == 'undefined' ) {
		width = 350;
	}
	if( typeof (height) == 'undefined' ) {
		height = 250;
	}
	if( typeof (url) == 'undefined' ) {
		url = 'index3.php';
	}
	
	if( !this.loginDiv ) {
		this.createLogin( width, height );	
	}
	else {
		this.loginDiv.style.display = '';
	}
	this.loginDiv.innerHTML = '<table width="100%" height="100%"><tr><td style="text-align:center;"><img border="0" src="images/loading_128x128.gif"></td></tr></table>';
	
	if( !this.shown ) {
		disableBody( true );
		
		this.shown = true;
		this.loginDiv.style.display = 'block';
		
		makeGETRequest( url, params, 'showLoginRequest', 'cancelLoginRequest');
		
		if( window.onscroll )
			this.oldOnScroll = window.onscroll; // save onScroll
		window.onscroll = this.positionLogin;
	}
	this.positionLogin();
}

// public - hide it
LUSI.ajaxLoginClass.prototype.hideLogin = function() {
	if( !this.shown )
		return;
		
	this.shown = false;
	
	if( this.oldOnScroll )
		window.onscroll = this.oldOnScroll;
	else
		window.onscroll = '';
	
	this.loginDiv.style.display = 'none';
}

// reposition the status div, top and centered
LUSI.ajaxLoginClass.prototype.positionLogin = function() {
	if( typeof(this.loginDiv) == 'undefined' ) {
		this.loginDiv = getObjectById('ajaxLoginDiv');
	}
	
	var scrollTop = 0;
	if (document.documentElement && document.documentElement.scrollTop)
		scrollTop = ns ? pageYOffset : document.documentElement.scrollTop;
	else if (document.body)
		scrollTop = ns ? pageYOffset : document.body.scrollTop;
	
	var loginDivRegion = LUSI.util.getRegion(this.loginDiv);
	
	this.loginDiv.style.top = ((LUSI.util.getViewportHeight() / 2 - loginDivRegion.height / 2) + scrollTop) + 'px';	
	this.loginDiv.style.left = (LUSI.util.getViewportWidth() / 2 - loginDivRegion.width / 2) + 'px';
}

function cancelLoginRequest() {
	disableBody( false );
	ajaxLogin.hideLogin();
}

function showLoginRequest( html ) {
	var loginDiv = getObjectById('ajaxLoginDiv');
	loginDiv.innerHTML = html;
}
// --- end ajax login form class
var ajaxLogin = new LUSI.ajaxLoginClass();
// ----------------- // ----------------- //