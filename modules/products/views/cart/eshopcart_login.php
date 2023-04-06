<?php 
$tmpl -> addScript('form');
$tmpl -> addScript('cart','modules/products/assets/js');
?>
<!--	INFOR buyer and saller			-->
				<div class='shopping_buyer_saller'>
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
								
									<div class="info-customer-gh">

										<!--	LOGIN FORM		-->
										<div class="login_form">
											<b class="orange">N&#7871;u b&#7841;n l&#224; th&#224;nh vi&#234;n h&#227;y &#273;&#259;ng k&#253; tr&#432;&#7899;c khi thanh to&#225;n </b>
											
											<form action="<?php echo FSRoute::_("index.php?module=users&task=login") ?>" method="post" name="login_form" class="login_form" onsubmit="javascript: return check_submit_form();">
												<table width="" class="table-false-menber">
												  <tr>
													<td width="25%" align="right" valign="top"><strong>Tên truy nhập:</strong></td>
													<td width="35%"><input class="txtinput" type="text" name="username" id='username'    /></td>
													<td width="25%" align="left">
														<input type="submit" class="" value="&#272;&#259;ng nh&#7853;p" name="submitbt" />
												  </tr>
												  <tr>
													<td width="25%" align="right" valign="top"><strong>M&#7853;t kh&#7849;u :</strong></td>
													<td width="35%"><input  class="txtinput" type="password" name="password" id='password'   /></td>
													<td width="25%" align="left"><a href="<?php echo FSRoute::_("index.php?module=users&task=forget&Itemid=8");?>" title="" class="forget-pass" >Qu&#234;n m&#7853;t kh&#7849;u</a></td>
												  </tr>
												</table>
												<input type="hidden" name = "module" value = "users" />
												<input type="hidden" name = "view" value = "users" />
												<input type="hidden" name = "redirect" value = "<?php echo base64_encode($_SERVER['REQUEST_URI']) ?>" />
												<input type="hidden" name = "task" value = "login_save" />
												<input type="hidden" name = "is_continue" id='is_continue' value = "<?php echo $session_order ? 1:0?>" />
											</form>
											<b class="orange">Nếu bạn chưa phải thành viên hãy <a href='<?php echo FSRoute::_('index.php?module=users&view=users&task=register&Itemid=12'); ?>'>Đăng kí tại đây</a></b>
										</div>
										<!--	end LOGIN FORM		-->
										
										
										<div class="test-info-next">
											<div>	
												B&#7841;n h&#227;y ki&#7875;m tra k&#7929; c&#225;c th&#244;ng tin tr&#432;&#7899;c khi ti&#7871;p t&#7909;c 
											</div>
												<a href="javascript:step_continue()" title="">B&#432;&#7899;c ti&#7871;p theo</a>
											<span>&nbsp;</span>
										</div>
														
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
				
			</div>
		<!--	end INFOR buyer and saller			-->
