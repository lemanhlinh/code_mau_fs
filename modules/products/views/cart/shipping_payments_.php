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
									
									<table class="tabl-remo-formalism" border="0" cellspacing="0" cellpadding="0" width="955">
										<?php for($i = 0; $i < count($payments); $i ++ ){
											$item = $payments[$i];
											?>
											<tr class="row-reno-formalism">
												<td width="30px" align="center" valign="top">
													<input type="radio" name="payment" <?php echo (@$temporary_order-> payment_method == $item->id)?"checked='checked'":""; ?>  value='<?php echo $item->id; ?>'/>
												</td>
												<td width="110px" align="center">
													<?php if(@$item->image){?>
													<img alt="<?php echo $item->name?>" src="<?php echo URL_IMG_PAYMENT_METHOD.$item->image; ?>" /><br/>
													<?php }?>
												<td width="40px">&nbsp;</td>
												<td width="770px" valign="top">
													<p><font  class='orange'><?php echo ($i+1)?>.</font> <?php echo $item->name;?></p>
						
													<p><?php 
														if($estore->estore_type == 'discount')
															echo $item->description; 
														else
															echo isset($array_epayments[$item->id])?$array_epayments[$item->id]:'';	
													?></p>
												</td>
										  	</tr>
										<?php }?>
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