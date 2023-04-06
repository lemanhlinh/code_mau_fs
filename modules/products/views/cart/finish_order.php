<?php 
    global $config,$tmpl;
    $tmpl -> addStylesheet('cart','modules/products/assets/css');
    $id = FSInput::get('id',0,'int');
    //$estore_code = 'DH';
    //$estore_code .= str_pad($order -> id, 8 , "0", STR_PAD_LEFT);
?>
<div class="finish_order">
    <h1 class="title hide"><?php echo FSText::_('Đặt hàng thành công') ?></h1>
    <?php echo $config['finish_order'] ?>
</div>
<!--
<h2 class="title-order">Chi tiết đơn hàng</h2>
<div><span class="order-code">Mã số đơn hàng: <strong><?php echo $estore_code?></strong></span></div>
<div><span class="order-code">Trạng thái đơn hàng: <strong><?php echo $this -> showStatus($order -> status); ?></strong></span></div>
<br/>
<div class='shopcart_product table-responsive'>
    <table class="table table-hover">
        <thead>
          <tr class="head-tr">
            <td width="6%">TT</td>
            <td width="30%">Tên sản phẩm</td>
            <td width="10%">Giá (vnđ)</td>
            <td width="10%">Số lượng</td>
            <td width="16%">Tổng giá</td>
          </tr>
        </thead>
        <tbody>
        <?php $stt=1; $total_price=0; 
            foreach($data as $item){?>
            	<?php $product = isset($arr_products[$item -> product_id])?$arr_products[$item -> product_id]:'';?>
            	<?php $link = FSRoute::_('index.php?module=products&view=product&id='.@$product->id.'&code='.@$product -> alias.'&ccode='.@$product->category_alias.'&Itemid=34');?>
                   <tr>
                        <td><?php echo $stt;?></td>
                        <td class="name-product">
                            <?php if(@$product -> image){ ?>
		                        	<?php $image_small = URL_ROOT.str_replace('/original/', '/small/', @$product->image); ?>
		                        	<img class="fl-left" width="100px"  src="<?php echo $image_small; ?>" alt="<?php echo htmlspecialchars (@$product -> name); ?>"  />
	                        <?php } else {?>
	                            <img class="fl-left" width="100px" src="<?php echo URL_ROOT.'images/no-img.gif'; ?>" alt="<?php echo htmlspecialchars (@$product -> name); ?>" />
	                        <?php }?>
                            <a href="<?php echo $link;?>"><?php echo @$product->name;?></a>
                        </td>
                        <td class="price-product"><?php echo format_money($item->price);?></td>
                        <td><input disabled="disabled" type="text" height="20px" border="1" name="quantity_13" value="<?php echo $item->count;?>" class="numbers-pro"></td>
                        <td class="total-price"><?php echo format_money($item->price);?></td>
                  </tr>
                <?php $total_price=$total_price+$item->price;$stt=$stt+1;?>
            <?php }?>  
          <tr>
            <td style="text-align: right;" colspan="6">Thành tiền : <span class="total-price"><?php echo format_money($total_price);?></span></td>
          </tr>
        </tbody>
    </table>
</div>

<div class='shopcart_product table-responsive'>    
    <table class="table table-hover">
      	<tbody>
    	  <tr>
    		<td colspan="2"><p class="orange upper"><strong>Thông tin người đặt hàng</strong></p></td>
    	  </tr>
    	  <tr>
    		<td width="35%" class="td-left">Tên người đặt hàng : </td>
    		<td width="65%"><?php echo $order->sender_name;?></td>
    	  </tr>
    	  <tr>
    		<td class="td-left">Địa chỉ : </td>
    		<td><?php echo $order->sender_address;?></td>
    	  </tr>
    	  <tr>
    		<td class="td-left">Email : </td>
    		<td><?php echo $order->sender_email;?></td>
    	  </tr>
    	  <tr>
    		<td class="td-left">Điện thoại : </td>
    		<td><?php echo $order->sender_telephone;?></td>
    	  </tr>
    	  <?php if(!empty($order->sender_comments)){?>
    	  <tr>
    		<td class="td-left">Ghi chú : </td>
    		<td><?php echo $order->sender_comments;?></td>
    	  </tr>
    	  <?php }?>
    	  
    	</tbody>
    </table>
</div>
-->
