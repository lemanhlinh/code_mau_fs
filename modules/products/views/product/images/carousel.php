<?php 
global $tmpl;
$tmpl -> addStylesheet('jquery.ad-gallery','libraries/jquery/gallery/css');
$tmpl -> addScript('jquery.ad-gallery','libraries/jquery/gallery/js');
// colox box
$tmpl -> addStylesheet('colorbox','libraries/jquery/colorbox/css');

$tmpl -> addScript('jquery.colorbox','libraries/jquery/colorbox/js');
$tmpl -> addScript('product_images_carousel','modules/products/assets/js');
$tmpl -> addStylesheet('product_images_carousel','modules/products/assets/css');
?>
<div class='frame_img'>
<?php $img = $data -> image?>
	<div id="gallery" class="ad-gallery">
		<div class="ad-image-wrapper">
	    </div>
	    <div class="ad-controls">
	    </div>
	    <div class="ad-nav">
	    		<?php  if(count($product_images)<3) { ?>
		       	 	<div class="ad-thumbs sort-thumbs" style="width:<?php echo (count($product_images)+1)*($image_small_width+17); ?>px">
		        <?php } else {?>
		       	 	<div class="ad-thumbs long-thumbs" >
		        <?php }?>
			    	 	 <ul class="ad-thumb-list">
				    	 	 <?php if($img){?>
					    	 	 <li>
									<a href="<?php echo URL_ROOT.$data->image; ?>" id='<?php echo $data->image;?>' rel="image_large" class='selected' title="<?php echo $data -> name; ?>">
										<img src="<?php echo URL_ROOT.str_replace('/original/','/small/', $data->image); ?>" longdesc="<?php echo URL_ROOT.$data->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>"  width="60" height="60" />
									</a>
					            </li>
				            <?php }else{?>
				            	<li>
									<a href="<?php echo URL_ROOT.'images/no-img.png'; ?>" id='<?php echo 'images/no-img.png';?>' rel="image_large" class='selected' title="no-title">
										<img src="<?php echo URL_ROOT.'images/no-img_thumb.png'; ?>" longdesc="<?php echo URL_ROOT.'images/no-img.png'; ?>" alt="no-title"  width="60" height="60" />
									</a>
					            </li>
				            <?php }?>
				            <?php if(count($product_images)){?>
				            	<?php for($i = 0; $i < count($product_images); $i ++ ){?>
				            		<?php $item = $product_images[$i];?>
				            		<?php $image_small_other = str_replace('/original/', '/small/', $item->image); ?>	
				            		<li>
										<a href="<?php echo URL_ROOT.$item->image; ?>" >
											<img src="<?php echo URL_ROOT.$image_small_other; ?>" longdesc="<?php echo URL_ROOT.$item->image; ?>" alt="<?php echo htmlspecialchars ($data -> name); ?>" width="60" height="60" class="image<?php echo $i;?>" />
										</a>
									</li>
				            	<?php } ?>
				            <?php } ?>
				            	<input id="page_current" type="hidden" value="<?php echo count($product_images)?>"  name="page_current" />
			    	 	 </ul>
			    <?php  if(count($product_images)<3) { ?>
		       	 	</div>
		        <?php } else {?>
		       	 	</div>
		        <?php }?>
	    </div>
	</div> 
	 <ul class="cb">
 		<?php $j = 0;?>
        <?php if($img){?>
          	<li>
				<a href="<?php echo URL_ROOT.$data->image; ?>" id='clb_<?php echo $j; ?>' rel="cb-image-link" class='selected cboxElement cb-image-link' title="<?php echo $data -> name; ?>"></a>
			</li>
			<?php $j++;?>
		<?php }?>
        <?php if(count($product_images)){?>
			<?php for($i = 0; $i < count($product_images); $i ++ ){?>
			<?php $item = $product_images[$i];?>
			<?php $image_small_other = str_replace('/original/', '/small/', $item->image); ?>
				<li>
					<a href="<?php echo URL_ROOT.$item->image; ?>"  id='clb_<?php echo $j; ?>' class='cb-image-link cboxElement'   rel="cb-image-link" >
					</a>
				</li>
				<?php $j ++; ?>	
			<?php }?>
        <?php }?>
			<input id="page_current" type="hidden" value="<?php echo count($product_images)?>"  name="page_current">
	</ul> 
</div>
