<?php 
global $tmpl;
$tmpl -> addTitle('Kết thúc đơn hàng');
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
?>
<div class="wapper-content-page">
<div class='eshopcart'>
	<div id="news-title">
		<h1>Thanh to&#225;n</h1>
	</div>
	<div id="news-detail">
		<div id="news-head-t">
			<div class="news-head-t-l">
				<div class="news-head-t-r">
				</div>	
			</div>	
		</div>	
		<div class="news_detail-inner">
			
			<div class="news_detail-inner-wrap shopcar_shipping">
				
					
					<!--	FIRST INFO				-->
					<div>
						<p><strong class='orange'>K&#237;nh ch&#224;o Qu&#253; kh&#225;ch</strong></p>
						<p>
							C&#7843;m &#417;n b&#7841;n &#273;&#227; mua h&#224;ng t&#7841;i <a href="<?php echo URL_ROOT;?>" ><strong><?php echo URL_ROOT; ?> </strong></a><br/>
							&#272;&#417;n h&#224;ng c&#7911;a Qu&#253; kh&#225;ch c&#243; m&#227; s&#7889; <strong>DH<?php echo str_pad($order -> id, 8 , "0", STR_PAD_LEFT);?></strong>, c&#225;c th&#244;ng tin chi ti&#7871;t v&#7873; &#273;&#417;n h&#224;ng &#273;&#432;&#7907;c li&#7879;t k&#234; d&#432;&#7899;i &#273;&#226;y:
						</p>
					</div>
					<!--	end FIRST INFO				-->
					
					<!--	ORDER INFO				-->
					<div class="cata-cont-step-t-liqui infor_shipping">
						<div class="cata-info-custo-boder">
							<div class='tab_title'>
								Th&#244;ng tin &#273;&#417;n h&#224;ng
							</div>
							<table width="100%">
								<tr>
									<td width="50%">
										<!--  SENDER INFO -->
										<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
											<tbody> 
											  <tr>
												<td colspan="3"><b class="send_info_label">Th&#244;ng tin ng&#432;&#7901;i &#273;&#7863;t h&#224;ng</b></td>
											  </tr>
											  <tr>
												<td width="173px"><b>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> sender_name; ?></td>
											  </tr>
											  <tr>
												<td><b>Gi&#7899;i t&#237;nh </b></td>
												<td width="5px">:</td>
												<td><?php echo ($order->sender_sex == 'female')? "N&#7919;":"Nam"; ?>
												</td>
											  </tr>
											  <tr>
												<td><b>&#272;&#7883;a ch&#7881;  </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> sender_address; ?></td>
											  </tr>
											  <tr>
												<td><b>Email </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> sender_email; ?></td>
											  </tr>
											  <tr>
												<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> sender_telephone; ?></td>
											  </tr>
											 </tbody>
										</table>
										<!--  end SENDER INFO -->
									</td>
									<td class='td_r'>
										<!--  RECIPIENT INFO -->
										<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
											<tbody> 
												<tr>
													<td colspan="3"><b class="receive_info_label">Th&#244;ng tin ng&#432;&#7901;i nh&#7853;n h&#224;ng</b></td>
												</tr>
											  <tr>
												<td width="173px"><b>T&#234;n ng&#432;&#7901;i nh&#7853;n h&#224;ng </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> recipients_name; ?></td>
											  </tr>
											  <tr>
												<td><b>Gi&#7899;i t&#237;nh </b></td>
												<td width="5px">:</td>
												<td><?php echo ($order->recipients_sex == 'female')? "N&#7919;":"Nam"; ?>
												</td>
											  </tr>
											  <tr>
												<td><b>&#272;&#7883;a ch&#7881;  </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> recipients_address; ?></td>
											  </tr>
											  <tr>
												<td><b>Email </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> recipients_email; ?></td>
											  </tr>
											  <tr>
												<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
												<td width="5px">:</td>
												<td><?php echo $order-> recipients_telephone; ?></td>
											  </tr>
											 </tbody>
										</table>
										<!--  end RECIPIENT INFO -->
									</td>
								</tr>
							</table>
							
				
						</div>
					</div>
					<!--	end ORDER INFO				-->
					
					<!--	ORDER DETAIL				-->
					<div class="cata-cont-step-t-liqui finished_order">
							<div class='tab_title'>
								Chi ti&#7871;t &#273;&#417;n h&#224;ng
							</div>
							<br/>
							<!--	PRODUCT LIST				-->
							<table width="100%" cellpadding="4" bordercolor="#CCC" border="1" class="table-product-pack">
								<thead>
								  <tr class="head-tr">
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
//								  $id_last = 0;
								  $total = 0;
								  $quantity = 0;
								  $total_discount = 0;
							  		foreach ($order_detail as $item) {
								  		$i++;
								  		$total_discount +=  ($item -> count* $item -> discount);
								  		$total += $item -> total;
								  		$quantity += $item -> count;
								  		$product = @$products[$item -> product_id];
								  		$link_detail_product =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&Itemid=6');
								  ?>	
								  
								   <tr>
										<td class="center-column"><?php echo $i; ?></td>
										<td class="product_image" align="center"><a href="<?php echo $link_detail_product; ?>" > 
											 <?php if($product -> image){ ?>
					                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/resized/', $product->image); ?>
					                        	<img width="80" height="100" src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>"  />
					                        <?php } else {?>
					                            <img  width="80" height="100" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars ($product -> name); ?>" />
					                        <?php }?>
										</a> </td>
										<td class="name-product"><a title='' href='<?php echo $link_detail_product; ?>' ><?php  echo @$product -> name;  ?></a></td>
										<td class="price_old" align="right"><?php  echo format_money($product -> price_old); ?> VN&#272;</td>
										<td class="price-product" align="right"><?php  echo format_money($item -> price); ?> VN&#272;</td>
										<td align="center"><?php echo $item -> count; ?></td>
										<td class="total-price" align="right"><?php echo format_money($item -> total); ?> VN&#272;</td>
								  </tr>
											  
								 <?php 
							  	}
							  	?>		  
								  <tr>
								  	<td colspan="3" >&nbsp;
									</td>
									<td colspan="2" align="right"><p class="text-left">Tổng : </p></td>
									<td class="total-quantity" align="center" ><?php echo $quantity; ?></td>
									<td class="total-price" align="right"><?php echo format_money($total);?> VN&#272;</td>
								  </tr>
								  <?php if($order -> payment_method){?>
								  <tr>
									<td colspan="3" >&nbsp;
									</td>
									<td colspan="2" ><p class="text-left">Giảm giá ( khi mua qua address): </p></td>
									<td class="total-price" align="right"><?php echo format_money($order -> total_before_discount - $order ->total_after_discount);?> VN&#272;</td>
								  </tr>
								  <tr>
									<td colspan="3" >&nbsp;
									</td>
									<td colspan="2" ><p class="text-left">Tiền phải trả: </p></td>
									<td class="total-price"><?php echo format_money($order ->total_after_discount);?> VN&#272;</td>
								  </tr>
						  <?php }?>
							<?php if(isset($order-> discount_money) && $order-> discount_money):?>
							  <tr>
								<td colspan="5" align="right"><p class="text-left">Giảm giá: </p></td>
								<td class="total-quantity"></td>
								<td class="total-price" align="right"><?php echo format_money($order -> discount_money);?> VN&#272;</td>
							  </tr>
							  <tr>
								<td colspan="5" align="right"><p class="text-left">Phải thanh toán: </p></td>
								<td class="total-quantity"></td>
								<td class="total-price" align="right"><?php echo format_money($order -> total_after_discount);?> VN&#272;</td>
							  </tr>
							  <?php endif;?>
								</tbody>
							</table>
							<!--	end PRODUCT LIST				-->
				
					</div>
					<!--	end ORDER DETAIL				-->
					
					
				<div>
<!--					<p>Th&#244;ng tin &#273;&#417;n h&#224;ng &#273;&#227; &#273;&#432;&#7907;c chuy&#7875;n t&#7899;i e-mail c&#7911;a b&#7841;n. Vui l&#242;ng thanh to&#225;n s&#7899;m &#273;&#7875; ho&#224;n th&#224;nh giao d&#7883;ch, h&#224;ng ch&#7881; &#273;&#432;&#7907;c chuy&#7875;n sau khi &#273;&#417;n h&#224;ng c&#7911;a b&#7841;n &#273;&#432;&#7907;c thanh to&#225;n.-->
<!--						</p>-->
<!--					<p><strong class='green'>Ch&#250;c b&#7841;n c&#243; m&#7897;t ng&#224;y vui v&#7867; v&#224; g&#7863;p nhi&#7873;u may m&#7855;n</strong></p>-->
				</div>
					
			</div>
		</div>
	</div>
</div>

</div>