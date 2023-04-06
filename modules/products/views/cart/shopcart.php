<?php 
global $tmpl;
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$Itemid = FSInput::get('Itemid',0,'int');
?>
<div class='shopcart'>
	<div id="news-title">
		<h1>Thanh toán</h1>
	</div>
	<div id="news-detail">
				<!--  Shopcart content -->
				<div class='shopcart_content'>
					<?php 
					
					if(isset($_SESSION['cart'])) {
						$cart = $_SESSION['cart'];
						foreach ($cart as $item) {
							$estore = $this -> getEstore($item[0]);
							if(!$estore)
								continue;
							
					?>
							<!--	INTRODUCE about estores			-->
							<div class='estore_intro'>
								<p class="addres-com"><?php // echo $this->estore_info($estore);?></p>	
							</div>
							<!--	end INTRODUCE about estores			-->
							
							<!--	Product list and price			-->
							<div class='shopcart_product'>
								<form action="#" method="post" name="shopcart" >
									<table width="100%" border="1" class="table-product-pack" bordercolor="#525252" cellpadding="4">
										<thead>
										  <tr>
											<td width="6%">TT</td>
											<td width="30%">Ảnh sản phẩm</td>
											<td width="30%">T&#234;n s&#7843;n ph&#7849;m</td>
											<td width="10%">Gi&#225; (VNĐ)</td>
											<td width="10%">S&#7889; l&#432;&#7907;ng</td>
											<td width="16%">T&#7893;ng gi&#225;</td>
											<td width="4%">X&#243;a</td>
										  </tr>
										</thead>
										<tbody>
										
										<!--  Product list -->
										  <?php
										  $i = 0; 
										  $product_list = $item[1];
										  $id_last = 0;
										  $total = 0;
										  if($product_list) {
										  	foreach ($product_list as $prd) {
										  		$i++;
										  		$product = $this -> getProductById($prd[0]);
										  		$prd_name = $product -> name;
//										  		$prd_image = $product -> image;
//										  		$prd_name = $this -> getProductName($prd[0]);
										  		$id_last = $prd[0];
										  		$cat_id_last = $product -> category_id;
										  		$total +=  $prd[2]* $prd[1];
										  		$discount_product =  $prd[1]* $prd[3];
										  		
										  		$link_del_prd =FSRoute::_('index.php?module=products&view=cart&task=del&eid='.$item[0].'&id='.$prd[0].'&Itemid='.$Itemid);
										  		$link_detail_prd =FSRoute::_('estores.php?module=products&view=product&ename='.$estore->estore_url.'&id='.$prd[0].'&Itemid=6');
										  		
										  ?>	
										  <tr>
											<td><?php echo $i; ?></td>
											<td class="product_image"><a href="<?php echo $link_detail_prd; ?>" > 
											<img alt="<?php echo $product->name?>" alt="<?php echo $product -> name;?>" src="<?php echo URL_IMG_PRODUCTS.'small'."/".$product->image; ?>" />	 
											</a> </td>
											<td class="name-product"><a href="<?php echo $link_detail_prd; ?>" > <?php  echo $prd_name;  ?> </a> </td>
											<td class="price-product"><?php  echo format_money($prd[2]); ?> VN&#272;</td>
											<td><input class="numbers-pro" type="text" height="20px" value="<?php echo $prd[1]?>" border="1" name="<?php echo 'quantity_'.$item[0].'_'.$prd[0]; ?>" /></td>
											<td class="total-price"><?php echo format_money($prd[2]* $prd[1]); ?> VN&#272;</td>
											<td><a href="<?php echo $link_del_prd; ?>" title=""><img src="<?php echo  URL_ROOT.'images/delete.jpg';?>" alt="" /></a></td>
										  </tr>
										  <?php 
										  	}	
									  	}
									  	$cat_last = $this -> getProductCategoryById($cat_id_last);
									  	$link_continue_buy = FSRoute::_('estores.php?module=products&view=cat&ename='.$estore->estore_url.'&ccode='.$cat_last->alias.'&id='.$cat_last->id.'&Itemid=2');
									  	$link_order = FSRoute::_('index.php?module=products&view=cart&task=eshopcart&eid='.$item[0].'&Itemid='.$Itemid);
									  	$link_del_all = FSRoute::_('index.php?module=products&view=cart&task=del_all&eid='.$item[0].'&Itemid='.$Itemid);
										  ?>
										  <!-- end Product list -->
										  <tr>
											<td colspan="3" class='td_buttons_area'>
												<input type="button" name="next_step" id="sub-next-buy" onclick="javascript:window.location = '<?php echo $link_continue_buy; ?>'" value="Ti&#7871;p t&#7909;c mua h&#224;ng"/>
												<input type="submit" name="re_calculate" id="sub-re-cal" value="T&#237;nh l&#7841;i" />
												<input type="button" name="remove"  value="X&#243;a h&#7871;t" onclick="javascript:window.location = '<?php echo $link_del_all; ?>'"/>
												<input type="button" name="order" id="sub-pro-liquidate" value="Thanh to&#225;n" onclick="javascript:window.location = '<?php echo $link_order; ?>'" />
												<p class="text-left">* Khi b&#7841;n &#273;&#7893;i th&#244;ng tin h&#227;y k&#237;ch v&#224;o n&#250;t<font color="#E16411"  size="-1"> T&#237;nh l&#7841;i</font> &#273;&#7875; c&#7853;p nh&#7853;t l&#7841;i gi&#7887; h&#224;ng</p>
											</td>
											<td colspan="2"  ><p class="text-left">Th&#224;nh ti&#7873;n : </p></td>
											<td colspan="1" class="total-price"><?php echo format_money($total);?> VN&#272;</td>
										  </tr>
										</tbody>
									</table>
									
									<input type="hidden" name='module' value="products" />
									<input type="hidden" name='eid' value="<?php echo $item[0]; ?>" />
									<input type="hidden" name='view' value="cart" />
									<input type="hidden" name='task' value="re_cal" id = 'task'/>
								</form>	
							</div>
							<!--	Product list and price			-->
					<?php 		
						}
					} else {
						echo "<p>Gi&#7887; h&#224;ng hi&#7879;n t&#7841;i ch&#432;a c&#243; s&#7843;n ph&#7849;m n&#224;o</p>";
					}
					
					?>
					
				</div>	
				<!--  Shopcart content -->
				
				<!--	NOTICE	-->
				<div class='notice'>
					<div class='notice-l'>
						<div class='notice-r'>
							<ul>
								<?php echo $note_in_cart; ?>
							</ul>

						</div>
					</div>
				</div>
				<!-- end 	NOTICE	-->
				
							
	</div>
</div>
