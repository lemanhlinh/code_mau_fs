<?php 
    global $tmpl,$config;
    //$tmpl -> addScript('form_user');
?>
<form action="#" name="eshopcart_info" class="eshopcart_info" method="post" id="eshopcart_info" >
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h3 class="regular df"><?php echo FSText::_('Địa chỉ giao hàng') ?></h3>
            
            <input type="text" id="sender_name" name="sender_name"  value="" class="form_control" placeholder="<?php echo FSText::_("Nhập họ tên của bạn"); ?> *" />
            
            <input type="tel" id="sender_telephone" name="sender_telephone"  value="" class="form_control" placeholder="<?php echo FSText::_("Số điện thoại"); ?> *"  />
        
    		<input type="email" id="sender_email" name="sender_email"  value="" class="form_control" placeholder="<?php echo FSText::_("Email"); ?> *"  />
    	
    		<input type="text" id="sender_address" name="sender_address" value="" class="form_control" placeholder="<?php echo FSText::_("Địa chỉ giao hàng"); ?> *"  />
 
    		<textarea rows="6" id="sender_comments" cols="30" class="sender_comments" name='sender_comments' placeholder="<?php echo FSText::_("Ghi chú khác"); ?>" ></textarea>
        </div>
        
        <div class="col-xs-12 col-md-6">
            <h3 class="regular df"><?php echo FSText::_('Hình thức thanh toán') ?></h3>
            <div class="radio">
              <label>
                <input type="radio" name="ord_payment_type" id="ord_payment_type1" value="1" checked="checked" />
                <?php echo FSText::_('Mua hàng trực tiếp - thanh toán tại cửa hàng'); ?>
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="ord_payment_type" id="ord_payment_type2" value="2" />
                <?php echo FSText::_('Giao hàng - nhận tiền (COD)'); ?>
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="ord_payment_type" id="ord_payment_type3" value="3" />
                <?php echo FSText::_('Chuyển khoản ngân hàng (click vào để hiện danh sách tài khoản)'); ?>
              </label>
              <div class="ord_payment_type3" style="display: none;">
                 <?php echo $config['info_cart'] ?>
              </div>
            </div>
            
            <a class="button fl-left submitbt" id="submit-bt" style="cursor: pointer;"><?php echo FSText::_('Hoàn tất đơn hàng') ?></a>
        </div>
    </div>
    		
    <input type="hidden" name='module' value="products" />
    <input type="hidden" name='view' value="cart" />
    <input type="hidden" name='task' value="eshopcart2_save" id = 'task'/>
</form>		
	<!--	end INFOR sender and recipient		-->
<div class="row-phone row-item" style="line-height: 36px;">
    <?php echo $config['hotline_counseling'] ?>
</div><!-- END: .row-phone -->