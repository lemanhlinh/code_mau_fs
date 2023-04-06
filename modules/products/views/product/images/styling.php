<?php 
global $tmpl;

$tmpl -> addScript('jquery.jcarousel.min','libraries/jquery/jcarousel/js');

$tmpl -> addScript('jcarousel.vert','modules/products/assets/js');
$tmpl -> addStylesheet('jcarousel.vert','modules/products/assets/css');

$tmpl -> addStylesheet('magiczoomplus','libraries/jquery/magiczoomplus');
$tmpl -> addScript('magiczoomplus','libraries/jquery/magiczoomplus');

$array1 = array("0" => $data);
$result = array_merge($array1, $product_images);
$total =count($result);

?>
<?php if($total){ ?>
<div style="position:relative; left:0px;text-align: center;margin-bottom:20px;">
	<a id="Zoomer" href="<?php echo URL_ROOT.str_replace('/original/','/original/', $data -> image); ?>" class="MagicZoomPlus" rel="disable-zoom :true;;selectors-class: active;">
		<img class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/','/large/', $data -> image); ?>" >
	</a>
</div>
<div style="width:100%;float:left;z-index:950;min-height:1px;margin-bottom:20px;">
		<div class="jcarousel-wrapper">
			<?php if($total > 4){?>
			<a class="jcarousel-control-prev" href="#" data-jcarouselcontrol="true">&nbsp;</a>
			<?php } ?>
			<div class="jcarousel"  data-jcarousel="true">
				<ul>
				   <?php foreach($result as $item){	?>
				   		<li>
					        <a href="<?php echo URL_ROOT.str_replace('/original/','/original/', $item -> image); ?>" class="Selector"  rel="zoom-id:Zoomer" rev="<?php echo URL_ROOT.str_replace('/original/','/large/', $item -> image); ?>">
					       	 	<img  class="img-thumb img-responsive" src="<?php echo URL_ROOT.str_replace('/original/','/small/', $item -> image); ?>" >
					        </a>
						</li> 
					<?php }?>
				</ul>
			</div>
			<?php if($total> 4){?>
				<a class="jcarousel-control-next" href="#" data-jcarouselcontrol="true">&nbsp;</a>
			<?php } ?>
		</div>
</div>

<?php } ?>
