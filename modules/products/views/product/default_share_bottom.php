<?php 
    $lang = FSInput::get('lang','vi');
?>

<div class='share_bottom row-item' >
		<div class="fb-share-button" data-href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']; ?>" data-layout="button"></div>
		<div class="fb-like" data-href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL']; ?>" data-layout="button_count" data-action="like"></div>
	    <div class="g-plusone" data-size="medium"></div>
</div><!--end: .hit_share-->
<div class="clearfix"></div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/<?php echo $lang == 'vi'? 'vi_VN':'en_EN'; ?>/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'vi'}
</script>

