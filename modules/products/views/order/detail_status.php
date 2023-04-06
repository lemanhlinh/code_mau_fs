<div class="history_order_">
	<div class="form_user_head">
		<div class="form_user_head_l">
			<div class="form_user_head_r">
				<div class="form_user_head_c">
					<span class='bold red'>Tr&#7841;ng th&#225;i &#273;&#417;n h&#224;ng</span>
				</div>
			</div>					
		</div>					
	</div>					
	<div class="form_user_footer_body">
		<!-- TABLE 							-->
		<table cellspacing="0" cellpadding="6" border="0" width="100%" class="tabl-info-customer">
			<tbody> 
			  <tr>
				<td width="173px"><b>Tr&#7841;ng th&#225;i</b></td>
				<td><span class='red'><strong><?php echo $this -> showStatus($order -> status);?></strong></span></td>
			  </tr>
			  <?php if($order->status == 0){?>
			  	<tr>
				<td width="173px">&nbsp;</td>
				<td>Bạn hãy click vào <a href="javascript: payment_for_order(<?php echo $order ->id; ?>,'<?php echo format_money($order -> total_after_discount); ?>')" ><strong class='red'> đây</strong></a> để <strong>thanh toán</strong> cho đơn hàng này</td>
			  </tr>
			  <?php } else if($order->status == 3){?>
			  		<tr>
				<td width="173px">&nbsp;</td>
				<td>Bạn hãy click vào <a href="javascript: recieved_order(<?php echo $order ->id; ?>,'<?php echo format_money($order -> total_after_discount); ?>')" ><strong class='red'> đây</strong></a> để xác nhận <strong> đã nhận hàng</strong></td>
			  </tr>
			  <?php }?>
			  <?php if($order->status < 4){?>
				<tr>
				<td width="173px">&nbsp;</td>
				<?php 
					$str_notice = '';
					$diff_time = time_diff_to_hours($order -> received_time, time());
					if($order->status < 2){
						$str_notice = 'Bạn sẽ không mất phí do gian hàng chưa xác nhận. Bạn chắc chắn muốn hủy đơn hàng này?';	
					}else if($order->status >= 2){
						if($diff_time > 24){
							$str_notice = 'Bạn sẽ mất '.$estore -> penalty_guest_before_24h. '% giá trị đơn hàng nếu bạn hủy. Bạn chắc chắn muốn hủy đơn hàng này?';
						}else if($diff_time > 12){
							$str_notice = 'Bạn sẽ mất '.$estore -> penalty_guest_before_12h. '% giá trị đơn hàng nếu bạn hủy. Bạn chắc chắn muốn hủy đơn hàng này?';
						}else {
							$str_notice = 'Bạn sẽ mất '.$estore -> penalty_guest_after_12h. '% giá trị đơn hàng nếu bạn hủy. Bạn chắc chắn muốn hủy đơn hàng này?';
						}
					}
				?>
				<td>Bạn hãy click vào <a href="javascript: cancel_order(<?php echo $order ->id; ?>,'<?php echo $str_notice; ?>')" ><strong class='red'> đây</strong></a> nếu bạn muốn <strong> hủy đơn hàng này</strong></td>
			  </tr>			  	
			  <?php }?>
			 </tbody>
		</table>
		<!-- ENd TABLE 							-->
		 <?php if($order->status < 4){?>
		<div class='notice_for_cancel'>
			<h3>Một số lưu ý khi <strong class='red'>hủy </strong>đơn hàng</h3>
			<div>
				<p>-Bạn sẽ <strong>không mất phí</strong> nếu gian hàng <strong>chưa xác nhận</strong> đơn hàng của bạn</p>
				<p>-Bạn sẽ mất <strong><?php echo $estore -> penalty_guest_before_24h. '%'?></strong> giá trị đơn hàng nếu hủy <strong>trước 24h </strong>so với thời điểm nhận</p>
				<p>-Bạn sẽ mất <strong><?php echo $estore -> penalty_guest_before_12h. '%'?></strong> giá trị đơn hàng nếu hủy <strong>trước 12h và sau 24h </strong>so với thời điểm nhận</p>
				<p>-Bạn sẽ mất <strong><?php echo $estore -> penalty_guest_after_12h. '%'?></strong> giá trị đơn hàng nếu hủy  <strong>sau 12h </strong>so với thời điểm nhận</p>
			</div>
		</div>
		<?php }?>	
	</div>
</div>
