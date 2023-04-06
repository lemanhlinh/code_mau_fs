<?php 
    global $tmpl;
    $tmpl -> addTitle('Thanh toán đơn hàng');
    $tmpl -> addStylesheet('cart','modules/products/assets/css');
    $tmpl -> addScript('form');
    $tmpl -> addScript('eshopcart2','modules/products/assets/js');
    $Itemid = FSInput::get('Itemid');
?>
<h1 class="title-module hide">
    <span class="title-item"><?php echo FSText::_('Đặt hàng') ?></span>
</h1>
<div class='eshopcart row-item'>
		<?php
		if(isset($_SESSION['cart'])) {
			$product_list = $_SESSION['cart'];
            
			if(count($product_list)){
				  include_once 'eshopcart2_items.php';
                  include_once 'eshopcart_info.php';
			}else{
			     echo "<h4>".FSText::_('Giỏ hàng hiện tại chưa có sản phẩm nào')."</h4>";
			}	 
		} else {
			echo "<h4>".FSText::_('Giỏ hàng hiện tại chưa có sản phẩm nào')."</h4>";
		}
		?>		
</div>
