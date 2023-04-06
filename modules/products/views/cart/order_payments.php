<br/><br/>
<!--	PAYMENT method and SHIPPING method				-->
<div class="cata-cont-step-t-liqui">
	<div class='table_name'>
		Phương thức Thanh to&#225;n
	</div>
	<?php 
		if($session_order -> payment_method == 1){
			echo 'Thanh toán trực tuyến bằng tài khoản ngân hàng thông qua <strong>OnePay Nội địa</strong>';
		}else if($session_order -> payment_method == 2){
			echo 'Thanh toán trực tuyến bằng tài khoản ngân hàng thông qua <strong>OnePay Quốc tế</strong>';
		}else{
			echo 'Thanh toán <strong>trực tiếp</strong> khi nhận hàng';
		}
		
	?>
</div>
<!--	end PAYMENT method and SHIPPING method				-->
					
				