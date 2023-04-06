	<?php 
	global $tmpl; 
	$tmpl -> addStylesheet('cat_gridalicious','modules/'.$this -> module.'/assets/css');
	$tmpl -> addStylesheet('productlist','templates/default/css');
	$tmpl -> addScript('jquery.grid-a-licious','libraries/jquery/gridalicious/');
	$tmpl -> addScript('home_gridalicious','modules/'.$this -> module.'/assets/js');
	$tmpl -> addScript('follow','templates/default/js','top');
	?>
<div class='product-cat'>
		<h1><span><?php echo FSText::_('Tất cả các sản phẩm'); ?></span></h1>
		<div class="block_products_subcat  block ">
			 <?php  $tmpl -> load_direct_blocks('products_subcat'); ?>
		 </div>

    	<?php include_once 'default_vertical.php';?>
</div>

<input type="hidden" value="<?php echo FSInput::get ( 'keyword' ); ?>" id="keyword">
<input type="hidden" value="<?php echo count($list); ?>" id="pagecurrent">
<input type="hidden" value="<?php echo $total; ?>" id="total_record">