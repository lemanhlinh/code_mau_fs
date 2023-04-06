<?php 
if(isset($_SESSION['cart'])) {
	$product_list = $_SESSION['cart'];
?>
	<table width="100%" border="1" class="table-product-pack" bordercolor="#CCC" cellpadding="4">
		<thead>
		  <tr>
			<td class="center-column" width="6%">TT</td>
			<td width="12%">Ảnh sản phẩm</td>
			<td width="30%">T&#234;n s&#7843;n ph&#7849;m</td>
			<td width="12%">Giá gốc</td>
			<td width="12%">Giá KM(nếu có)</td>
			<td width="8%">S&#7889; l&#432;&#7907;ng</td>
			<td width="12%">T&#7893;ng gi&#225;</td>
		  </tr>
		</thead>
		<tbody>
		
		<!--  Product list -->
		  <?php
							  $i = 0; 
							  $id_last = 0;
							  $total = 0;
							  $cat_id_last = 0;
							  if($product_list) {
							  	foreach ($product_list as $prd) {
							  		$i++;
							  		$product = $this -> getProductById($prd[0]);
							  		$prd_name = $product -> name;
//							  		$prd_name = $this -> getProductName($prd[0]);
							  		
							  		$id_last = $prd[0];
							  		$cat_id_last = $product -> category_id;
							  		$total +=  $prd[2]* $prd[1];
							  		$link_del_prd =FSRoute::_('index.php?module=products&view=cart&task=edel&id='.$prd[0].'&Itemid=65');
							  		$link_detail_prd =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&Itemid=6');
							  ?>	
		  
		   <tr>
				<td class="center-column"><?php echo $i; ?></td>
				<td class="product_image" align="center">
					<a href="<?php echo $link_detail_prd; ?>" > 
						 <?php if($product -> image){ ?>
	                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
	                        	<img width="80" height="100" src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
                        <?php } else {?>
                            <img  width="80" height="100" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
                        <?php }?>	 
					</a> 
				</td>
				<td class="name-product"><a href="<?php echo $link_detail_prd; ?>" > <?php  echo $prd_name;  ?> </a> </td>
				<td class="price_old" align="right"><?php  echo format_money($product -> price_old); ?> </td>
				<td class="price-product" align="right"><?php  echo format_money($prd[2]); ?> </td>
				<td align="center"><?php echo $prd[1]?></td>
				<td class="total-price" align="right"><?php echo format_money($prd[2]* $prd[1]); ?></td>
				
		  </tr>
					  
		 <?php 
		  	}	
	  	}
	  	$cat_last = $this -> getProductCategoryById($cat_id_last);
	  	if($cat_last)
	  		$link_continue_buy = FSRoute::_('index.php?module=products&view=categories&ccode='.$cat_last->alias.'&Itemid=4');
	  	$link_del_all =FSRoute::_('index.php?module=products&view=cart&task=del_all&Itemid=65');
	  	?>		  
		   <tr>
			<td colspan="3" >&nbsp;</td>
			<td colspan="2" align="right"><p class="text-left">Tổng : </p></td>
			<td class="total-quantity" align="center"><?php echo $quantity; ?></td>
			<td class="total-price" align="right"><?php echo format_money($total);?> </td>
		  </tr>
							  <?php if(isset($session_order-> discount_money) && $session_order-> discount_money):?>
							  <tr>
								<td colspan="5" align="right"><p class="text-left">Giảm giá: </p></td>
								<td class="total-quantity"></td>
								<td class="total-price" align="right"><?php echo format_money($session_order -> discount_money);?> </td>
							  </tr>
							  <tr>
								<td colspan="5" align="right"><p class="text-left">Phải thanh toán: </p></td>
								<td class="total-quantity"></td>
								<td class="total-price" align="right"><?php echo format_money($session_order -> total_after_discount);?> </td>
							  </tr>
							  <?php endif;?>
		</tbody>
	</table>
<?php 
} else {
	echo "<p>Gi&#7887; h&#224;ng hi&#7879;n t&#7841;i ch&#432;a c&#243; s&#7843;n ph&#7849;m n&#224;o</p>";
}
?>
<!--	end PRODUCT LIST				-->
<div class='clear'></div>
					
