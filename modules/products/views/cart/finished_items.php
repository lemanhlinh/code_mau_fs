<!--	ORDER DETAIL				-->
<div class="cata-cont-step-t-liqui finished_order">
	<div class="cata-info-custo-boder">
		<div class='table_name'>
			<p><b>Chi ti&#7871;t &#273;&#417;n h&#224;ng</b></p>
		</div>
		
		<!--	PRODUCT LIST				-->
		<div class='table_order_wrapper'>
			<table width="100%" cellpadding="4" bordercolor="#525252" border="1" class="table-product-pack">
				<thead>
		  <tr class="head-tr" align="center">
			<td class="center-column" width="3%">TT</td>
			<td width="10%">Ảnh sản phẩm</td>
			<td width="15%">T&#234;n s&#7843;n ph&#7849;m</td>
			<td width="13%">Gi&#225; gốc</td>
			<td width="10%">Khuyến mại (nếu có)</td>
			<td width="10%">Giảm giá mua kèm sản phẩm (nếu có)</td>
			<td width="10%">S&#7889; l&#432;&#7907;ng</td>
			<td width="13%">T&#7893;ng gi&#225;</td>
				  </tr>
				</thead>
				<tbody>
				
				<!--  Product list -->
				  <?php
								  $i = 0; 
//								  $id_last = 0;
								  $total = 0;
								  $total_discount = 0;
							  		foreach ($order_detail as $item) {
								  		$i++;
								  		$total_discount +=  ($item -> count* $item -> discount);
								  		$total += $item -> total;
								  		$product = @$products[$item -> product_id];
								  		$link_detail_product =FSRoute::_('index.php?module=products&view=product&code='.$product->alias.'&ccode='.$product -> category_alias.'&Itemid=6');
								  ?>	
				  
		  		 	<tr align="center">
						<td class="center-column"><?php echo $i; ?></td>
						<td class="product_image"><a href="<?php echo $link_detail_product; ?>" > 
							<img alt="<?php echo @$product -> name?>" alt="<?php echo @$product -> name;?>" src="<?php echo URL_IMG_PRODUCTS.'small'."/".@$product->image; ?>" />	 
						</a> </td>
						<td class="name-product"><a title='' href='<?php echo $link_detail_product; ?>' ><?php  echo @$product -> name;  ?></a></td>
						<td class="price-product"><?php  echo format_money($item -> price); ?> </td>
						<td class="price-product"><?php  echo $item -> discount? number_format($item -> discount, 2, ',', '.'): 0; ?>% </td>
						<td class="price-product"><?php  echo $item -> discount_incentives? number_format($item -> discount_incentives, 2, ',', '.'): 0; ?>% </td>
						<td><input class="numbers-pro" type="text" height="20px" value="<?php echo $item -> count; ?>" border="1" name="quantity" /></td>
						<td class="total-price" align="right"><?php echo format_money($item -> total_after_discount); ?> </td>
				  	</tr>
							  
				 <?php 
			  	}
			  	?>		  
				  <tr >
				  	<td colspan="5" >&nbsp;
					</td>
					<td colspan="2" align="right"><p class="text-left">Tổng : </p></td>
					<td class="total-price" align="right"><?php echo format_money($order -> total_after_discount);?> </td>
				  </tr>
				  <tr>
				  	<td colspan="5">&nbsp;</td> 
					<td colspan="2" align="right">Giảm giá hạng thành viên <strong><?php echo @$member_level -> name;?></strong>:</td>
					<td class="total-price" align="right"><?php echo $order -> member_discount?($order -> member_discount):0;?> % </td>
				  </tr>
				  <tr>
		  			<td colspan="5">&nbsp;</td> 
					<td align="right" colspan="2"   ><p class="text-left">Tiền phải trả: </p></td>
					<td class="total-price" align="right"><?php echo format_money($order ->total_end);?> </td>
				  </tr>
				</tbody>
			</table>
		</div>
		<!--	end PRODUCT LIST				-->
		

	</div>
</div>
<!--	end ORDER DETAIL				-->