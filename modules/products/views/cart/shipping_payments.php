<!--	PAYMENT METHOD				-->
					<div class='payment_method'>
						<div class="frame">
							<div class="frame_t">
								<div class="frame_t_l">
									<div class="frame_t_r">
									</div>
								</div>
							</div>
							<div class="frame_c">
								<div class="frame_c_inner">
									
									<!--	CONTENT IN FRAME	-->
									<p class='frame_title'><b class='orange'>Ph&#432;&#417;ng th&#7913;c thanh to&#225;n</b></p>
									
									<table class="tabl-remo-formalism" border="0" cellspacing="0" cellpadding="5" width="500">
									
										<tr class="row-reno-formalism">
											<td width="25" rowspan="2">
											<td width="10" align="right" valign="top">
												<?php $checked = isset($temporary_order-> payment_method)?(@$temporary_order-> payment_method?1:0):1?>
												<input type="radio" name="payment" <?php echo (!$checked)?"checked='checked'":""; ?>  value='0'/>
											</td>
											<td width="110" align="left">
												Thanh toán trực tiếp tại nơi nhận hàng
											</td>
									  	</tr>
										<tr class="row-reno-formalism">
											<td align="right" valign="top">
												<input type="radio" name="payment" <?php echo ($checked)?"checked='checked'":""; ?>  value='1'/>
											</td>
											<td align="left">
												Thanh toán qua address
											</td>
									  	</tr>
									</table>
									<!--	end CONTENT IN FRAME	-->
						
								</div>
							</div>
							<div class="frame_b">
								<div class="frame_b_l">
									<div class="frame_b_r">
									
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--	end PAYMENT METHOD				-->