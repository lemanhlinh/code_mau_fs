
var markers = [];
var mypolygon;
var mypolyline;
var map;
var image = '/images/icon-map-api.png';
var image2 = '/images/icon-map-api-hover.png';
var mouseMoveHandler = null;

function initialize() {

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 15,
          center: new google.maps.LatLng(center[0], center[1]),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          mapTypeControlOptions: {
              style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
              position: google.maps.ControlPosition.TOP_RIGHT,
          },
          fullscreenControl: true
        });

        display_markers(map);

//        var btn = $('<a id="draw"  href="javascript:void(0)" title="Vẽ khoanh vùng để tìm">Vẽ khoanh vùng tìm để tìm nhà đất</a>');
//        var btn2 = $('<a id="remove_draw"  style="display:none"  href="javascript:void(0)" title="Vẽ khoanh vùng bạn vừa vẽ">Xóa khoanh vùng</a>');
//        map.controls[google.maps.ControlPosition.TOP_LEFT].push(btn[0]);
//        map.controls[google.maps.ControlPosition.TOP_LEFT].push(btn2[0]);
//
//        //draw
//        btn.bind('click', function(e){
////        $("#draw a").click(function(e) {
////        	setMapOnAll(null);
//        	$('#draw').hide();
//        	$('#remove_draw').show();
//            e.preventDefault();
//            disable(map);
//
//           drawFreeHand(map);
//        });
//
//        //remove draw
//        btn2.bind('click', function(e){
////        $("#remove_draw a").click(function(e) {
//        	$('#draw').show();
//        	$('#remove_draw').hide();
//
//        	mypolyline.setMap(null);
//        	mypolygon.setMap(null);
//        	for (var key in  markers){
//        	    	markers[key].setMap(map);
//        	    	$('#prj_item_'+key).show();
//        	}
//        });

}

function display_markers(map){
	var infowindow = new google.maps.InfoWindow();
    var marker, i;
    locations.forEach(function(item,index) {
//    	marker = new google.maps.Marker({
   	 	marker = new MarkerWithLabel({
	         position: new google.maps.LatLng(item[1], item[2]),
	         map: map,
	         icon: image,
	         store_id:index,
	         labelContent:item[5],
	         labelAnchor: new google.maps.Point(75, 0),
             labelClass: "marker_label"
	   });

	   var myListener =  google.maps.event.addListener(marker, 'click', (function(marker, i) {
	         return function() {
	               // note dữ liệu id
	               var id = index;
	               check_exist_id(id);
	               infowindow.setContent(item[0]);
	               infowindow.open(map, marker);
	               marker.setIcon(image2);
	               mouseout_activate = 0;
	         };

	   })(marker, i));

	   google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
	   	return function() {
	           if(mouseout_activate == 1){
	                 // note dữ liệu id
	                 infowindow.setContent(item[3]);
	                 infowindow.open(map, marker);
	                 marker.setIcon(image2);
	           }
	   	}
	 	})(marker, i));
	   google.maps.event.addListener(marker, 'mouseout', (function(marker, i) {
	   	return function() {
	       	if(mouseout_activate == 1){
	           	infowindow.close();
	               marker.setIcon(image);
	           }
	   	}
	 	})(marker, i));

	   google.maps.event.addListener(infowindow,'closeclick',function(){
	   	mouseout_activate = 1;
		});
	   markers[index] = marker;
    });

}



function callback(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
    }
}

function createMarker(place) {
    var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
      map: map,
      position: place.geometry.location
    });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.setContent(place.name);
      infowindow.open(map, this);
    });
}
/*
 * Draw
 */
function drawFreeHand(map){
	map.setOptions({ draggableCursor: 'crosshair' });

	 google.maps.event.addDomListener(map.getDiv(),'mousedown',function(e){
	    //the
		if(map == null ){
			return;
		}
    	mypolyline=new google.maps.Polyline({map:map,clickable:false});

	    //move-listener
	    var move=google.maps.event.addListener(map,'mousemove',function(e){
	    	if(map){
	        	mypolyline.getPath().push(e.latLng);
	    	}
	    });

	    google.maps.event.addListenerOnce(map,'mouseup',function(e){
	        var path=mypolyline.getPath();
	        if(path.length < 3){
	        	mypolyline.setPath([]);
	        	mypolyline.setMap(null);
	        	location.reload();
	        }else{
	        	 google.maps.event.removeListener(move);

	        	 mypolygon=new google.maps.Polygon({map:map,path:path});

	 	        if(mypolygon){
	 		       	 mypolyline.setMap(null);

	 		         google.maps.event.clearListeners(map.getDiv(), 'mousedown');

	 		         show_in_polygon(map,mypolygon);
	 		         enable(map);
	 	        }
	        }
	        map.setOptions({ draggableCursor: 'default' });

	    });
	});
}

    function disable(map){
        map.setOptions({
            draggable: false,
            zoomControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: false
        });
    }

    function enable(map){
        map.setOptions({
            draggable: true,
            zoomControl: true,
            scrollwheel: true,
            disableDoubleClickZoom: true
        });
    }

    function show_in_polygon(map,mypolygon){
    	for (var key in  markers){
    	    if (google.maps.geometry.poly.containsLocation(markers[key].getPosition(), mypolygon)) {
    	    	markers[key].setMap(map);
    	    	$('#prj_item_'+key).show();
    	    }else{
    	    	markers[key].setMap(null);
    	    	$('#prj_item_'+key).hide();
    	    }
    	}
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    google.maps.event.addDomListener(window, 'load', initialize);
