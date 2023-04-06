<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script> -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?v=3.exp&libraries=drawing,geometry,places&key=AIzaSyAWrSvjgRKZVUq-NKIPZExDkzG2OrCwPlA&language=vi"></script>
<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
<script type="text/javascript" src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerwithlabel/src/markerwithlabel.js"></script>
<?php
    global $tmpl;
    $tmpl->addScript('map','modules/contact/assets/js');
    $tmpl->addScript('google_map1','modules/contact/assets/js');
    
?>
<script>
    var center = [21.026951,105.792988];//[21.027764,105.83416]; 21.026951, 105.792988
    var locations = [];

<?php  foreach($address as $item){ ?>
	locations[<?php echo $item-> id; ?>] = ['<div class="item-row-map"></div>',<?php echo $item->latitude ;?>,<?php echo $item->longitude ;?>,'<?php echo $item->name ;?>','',''];
	// locations[<?php echo $item-> id; ?>] = ['<div class="item-row-map"></div>',<?php echo $item->latitude ;?>,<?php echo $item->longitude ;?>];
<?php } ?>
</script>
<div id="map-canvas" style="height: 500px;"></div>
