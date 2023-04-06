				<!--	COMPANY intro				-->
					<div class='company_intro'>
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
									<p class='frame_title'><b class='orange'>Th&#244;ng tin c&#244;ng ty </b></p>
									<table class="info-company" width="100%" border="0" cellspacing="4" cellpadding="4">
									  <tr>
										<td rowspan="5" width="125px">
										
										<!--  Logo -->
										<?php if($estore -> logo && file_exists(PATH_IMG_ESTORES_LOGO."/".$estore->logo)){ ?>
												<img class='logo' alt="<?php echo $estore->logo; ?>" src="<?php echo URL_IMG_ESTORES_LOGO."/".$estore->logo; ?>" />
										<?php } ?>
										<!--  Logo -->
										
										<td width="200px" align="justify"><b>T&#234;n gian hàng </b></td>
										<td>:</td>
										<td><?php echo @$estore -> estore_name; ?></td>
									  </tr>
									  <tr>
										<td width="200px" align="justify"><b>Gian h&#224;ng tr&#234;n adderss.vn</b></td>
										<td>:</td>
										<td>
											<?php
											$link =FSRoute::_('estores.php?module=home&ename='.$estore->estore_url.'');
											$website = $link;?>
											<a href='<?php echo $link; ?>'> <?php echo $website; ?></a>
										</td>
									  </tr>
									  <tr>
										<td width="200px" align="justify"><b>&#272;&#7883;a ch&#7881;</b></td>
										<td>:</td>
										<td><?php echo @$estore -> address; ?></td>
									  </tr>
									  <tr>
										<td width="200px" align="justify"><b>Th&#224;nh ph&#7889;</b></td>
										<td>:</td>
										<td><?php echo @$city->name; ?></td>
									  </tr>
									  <tr>
										<td width="200px" align="justify"><b>&#272;i&#7879;n tho&#7841;i</b></td>
										<td>:</td>
										<td><?php echo @$estore -> telephone; ?></td>
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
					<!--	end COMPANY intro				-->