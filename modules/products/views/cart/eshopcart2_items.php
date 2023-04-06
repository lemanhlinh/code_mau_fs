<!--	Product list and price			-->
<form action="#" method="post" name="shopcart" >
    <div class='shopcart_product'>
		<div class="table table-hover">
			<div class="row">
				<div class="col-sm-6 col-xs-12 count-order title-order" >
                    <h4>Giỏ hàng của bạn (<?php echo count($product_list)? count($product_list):'0'; ?> sản phẩm)</h4>
                </div>
				<div class="col-sm-2 col-xs-12 price-order title-order" >Đơn giá</div>
				<div class="col-sm-2 col-xs-12 quantity-order title-order" >S&#7889; l&#432;&#7907;ng</div>
				<div class="col-sm-2 col-xs-12 title-order" >T&#7893;ng gi&#225;</div>
			</div>
			<!--  Product list -->
			  <?php
			  $i = 0; 
			  $id_last = 0;
			  $total = 0;
			  $quantity = 0;
			  $cat_id_last = 0;
			  if($product_list) {
			  	foreach ($product_list as $prd) {
	  
                    $product = $this -> getProductById($prd[0]);
                    $prd_name = $product -> name;
                    $id_last = $prd[0];
                    $cat_id_last = $product -> category_id;
                    //print_r($prd);
                    if($prd[5]){
                        $total +=  $prd[3]* $prd[1];
                    }else{
                        $total +=  $prd[2]* $prd[1];
                    }
        	  		
        	  		$quantity += $prd[1];
                    $link_del_prd =FSRoute::_('index.php?module=products&view=cart&task=edel&id='.$prd[0].'&Itemid=65');
                    $link_detail_prd =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&id='.$product -> id.'&ccode='.$product -> category_alias.'&Itemid=6');

        	   ?>
    		   <div class="tr-pro row">
					<div class="product_image col-sm-6 col-xs-12" style="text-align: left;">
						<a href="<?php echo $link_detail_prd; ?>" class="fl-left item-img" > 
							 <?php if($product -> image){ ?>
		                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/small/', $product->image); ?>
		                        	<img  src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
	                        <?php } else {?>
	                            <img  src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
	                        <?php }?>	 
						</a> 
                        <h2 class="df" >
                            <a href="<?php echo $link_detail_prd; ?>" > <?php  echo $prd_name;  ?> </a>
                        </h2>
                        
                        <span class="status"><?php echo $prd[7]? FSText::_('Còn hàng'):FSText::_('Hết hàng'); ?></span> 
                        <a class="col-delete-cart" href="<?php echo $link_del_prd; ?>" title=""> Xóa </a>
					</div>
                    
					<div class="price-product col-sm-2 col-xs-12" >
                        <?php  echo format_money($prd[3],' đ / thùng'); ?>
                    </div>
					<div class="col-sm-2 col-xs-12">
                        <input class="numbers-pro" min="1" type="number" id="numbers_<?php echo $product->id; ?>" value="<?php echo $prd[1]?>"  name="<?php echo 'quantity_'.$prd[0]; ?>" size="4" />
                    </div>
					<div class="total-price col-sm-2 col-xs-12">
                        <?php echo format_money($prd[3]* $prd[1]); ?>
                    </div>
    		  </div>
              <?php $i++; }  
              
              } ?>
              
            <?php 
			  	$cat_last = $this -> getProductCategoryById($cat_id_last);
			  	if($cat_last)
			  	$link_continue_buy = FSRoute::_('index.php?module=products&view=cat&ccode='.$cat_last->alias.'&id='.$cat_last->id.'&Itemid=4');
			  	$link_del_all =FSRoute::_('index.php?module=products&view=cart&task=del_all&Itemid=65');
			  	$link_order = '#';
		  	?>
			 <div class="fun-order row-item">
                <input class="button-cart bt-sm-1 fl-right" type="submit" name="re_calculate" id="sub-re-cal" value="+ <?php echo FSText::_('Tính lại') ?>" />
                <!--<input class="button-cart bt-sm-2 fl-right" type="button" name="remove"  value="Xóa giỏ hàng" onclick="javascript:window.location = '<?php echo $link_del_all; ?>'"/>-->
                <?php if($cat_last){?>
				     <a class="button-cart bt-sm-3 fl-left" id="sub-next-buy" href = '<?php echo $link_continue_buy; ?>'><?php echo FSText::_('Tiếp tục mua hàng') ?></a>
				<?php }?>
            </div>
            	  
			 <div class="total-order row-item">
                    <?php echo FSText::_('Tổng cộng') ?>: 
                    <span class="text-left"><?php echo format_money($total);?></span>
			 </div>	

		</div>
    </div>				
	<input type="hidden" name='Itemid' value="<?php echo $Itemid; ?>" />
	<input type="hidden" name='module' value="products" />
	<input type="hidden" name='view' value="cart" />
	<input type="hidden" name='task' value="ere_cal2" id = 'task'/>
</form>	
			
				