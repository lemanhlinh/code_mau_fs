<link rel="stylesheet" href="<?php  echo URL_ROOT.'/libraries/themes/ui-lightness/ui.all.css';?>" />
<link rel="stylesheet" href="<?php  echo URL_ROOT.'/libraries/themes/ui-lightness/ui.theme.css';?>" />
<link rel="stylesheet" href="<?php  echo URL_ROOT.'/libraries/jquery/datepicker/jquery-ui.css';?>" />
<link rel="stylesheet" href="<?php  echo URL_ROOT.'/libraries/jquery/datepicker/datepicker.css';?>" />
<div id="login-form" class ="frame_large" >
    <div class="frame_large_head">
        <div class="frame_large_head_l">
            <h2><?php echo $title; ?></h2>
        </div>
        <div class="frame_large_head_r">&nbsp;
        </div>
    </div>
    <div class="frame_large_body">
           
            <!--   FRAME COLOR        -->
            <div class='frame_color'>
            	 <!-- HISTORY STATITISC 	--><!--
						<?php // include_once 'list_statitisc.php';?>
						<!-- end HISTORY STATITISC 	-->
                <div class='frame_color_t'>
                    <div class='frame_color_t_r'>&nbsp; </div>
                </div>
                <div class='frame_color_m'>
                    <div class='frame_color_m_c'>
                    	<?php 
						$link_action = "index.php?module=products&view=order";
						if(FSInput::get('date_from')&& FSInput::get('date_to'))
							$link_action .= "&date_from=".FSInput::get('data_from')."&date_to=".FSInput::get('data_to');
						$link_action .= '&Itemid=45';
						$link_action = FSRoute::_($link_action);
						?>
                       		<div class='prd_search_area'>
							<form action="<?php echo $link_action?>" method="get" name="frm_search_pro_inse"  >
								<!--<p><strong>Hiển thị: </strong>
									<select name='display' id='display'>
										<option value=''  >Tất cả</option>
										<?php foreach($array_status as $key => $name){?>
											<?php $checked = ($key == $display && $display != '')?"selected = 'selected'":""?>
											<option value='<?php echo $key?>' <?php echo $checked;?>> <?php echo $name; ?></option>
										<?php }?>
									</select>
								<strong>Hình thức mua:</strong>
								<?php
										$checked_buy ='';
										$checked_buy0 ='';
										$checked_buy1 ='';
										$check = FSInput::get('buy');
										switch($check){
											case '0':
												$checked_buy0 = "selected";
												break;
											case '1':
												$checked_buy1 = "selected";
												break;
											default:
												$checked_buy = "selected";
												break;
										}
										?>
									<select name='buy' id='buy'>
										<option value='' <?php echo $checked_buy;?>> Tất cả</option>
										<option value='0' <?php echo $checked_buy0;?>> Mua trực tiếp</option>
										<option value='1' <?php echo $checked_buy1;?>> Mua qua address</option>
									</select>
								--><b>Từ ngày :</b>
								<input type="text" name='date_from' id='date_from' value ="<?php echo FSInput::get('date_from'); ?>" size ='9'/>
								<b>Đến ngày :</b>
								<input type="text" name='date_to' id='date_to' value ="<?php echo FSInput::get('date_to');?>" size ='9'/>
								
								<input type="button" lang="<?php echo $link_action?>" value="Tìm kiếm" class='button11 search-order-button' >
								<input type="hidden" name='module' value='products' />
								<input type="hidden" name='view' value='order' />
								<input type="hidden" name='Itemid' value='<?php echo FSInput::get('Itemid',1,'int'); ?>' />
							</form>
						</div>
                    	<br />
                    		
							<!-- PRODUCT LIST		-->
								<div class="form_user_footer_body">
								<table cellpadding="5" cellspacing="0"  border="1" bordercolor="#D1D1D1" width="100%" >
											<thead>
												<tr align="center" bgcolor="white">
													<th width="30"><b>STT</b></th>
													<th><b><?php echo "Thông tin đơn hàng";?></b></th>
<!--													<th width="130" ><b><?php echo "Hình thức mua hàng"; ?></b></th>-->
													<th width="117"><b><?php echo "Trạng thái"; ?></b></th>
													<th width="117"><b><?php echo "Ngày đặt hàng"; ?></b></th>
													<th width="117"><?php echo '&nbsp'; ?></th>
											  	</tr>
											  </thead>
											<tbody>
											<?php for($i = 0 ; $i < count($data); $i ++ ){?>
											<?php
												 $item = $data[$i];
												 $link_view =FSRoute::_('index.php?module=products&view=order&id='.$item->id.'&task=detail&Itemid=45');
											?>
												<tr class='row<?php echo ($i%2); ?>'>
													<td align="center">
														<strong><?php echo ($i+1); ?></strong><br/>
													</td>
													
													<td> 
														<?php 
													 	$estore_code = 'DH';
													 	$estore_code .= str_pad($item -> id, 8 , "0", STR_PAD_LEFT);
														?>
														<p>Mã đơn hàng: <span class='orange'><?php echo $estore_code ?></span><br/></p>
														<p>	Tổng tiền <strong class='total_price'><?php  echo format_money($item -> total_after_discount).' '; ?></strong></p>
													</td>
													
													<!--<td>
														<?php if($item ->payment_method ==0){
																echo "Mua trực tiếp";
														}else echo "Mua thông qua address";?>
													</td>
													--><td><?php 
														echo $this -> showStatus($item -> status);
													?></td>
													<td>
														<?php echo date('d/m/Y',strtotime($item->created_time));?>
													</td>
													<td><a class="thickbox" rel="<?php echo $estore_code;?>" href="<?php echo $link_view.'&raw=1'; ?>" rev="<?php echo $link_view; ?>"> Xem chi tiết </a></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>
											<?php if($pagination->total > $pagination->limit){?>
											<div>												
														<?php echo $pagination->showPagination_ajax();?>
											</div>
											<?php } ?>				
								</div>		
										<!-- ENd TABLE 							-->
							<!-- end PRODUCT LIST		-->
							<div class='clear'></div>
						<!--	end SEARCH AREA	-->
                    
                   <!--  end CONTENT IN FRAME      -->
           
                    </div>
                </div>
                <div class='frame_color_b'>
                    <div class='frame_color_b_r'>&nbsp; </div>
                </div>
            </div>
            <!--   end FRAME COLOR        -->
            
           
           
        
    </div>
    <div class="frame_large_footer">
        <div class="frame_large_footer_l">&nbsp;</div>
        <div class="frame_large_footer_r">&nbsp;</div>
    </div>
   </div>
		

<script src="<?php echo URL_ROOT.'libraries/jquery/datepicker/jquery.ui.core.js'; ?>" type="text/javascript" language="javascript" ></script>
<script src="<?php echo URL_ROOT.'libraries/jquery/datepicker/jquery.ui.datepicker.js'; ?>" type="text/javascript" language="javascript" ></script>
<script src="<?php echo URL_ROOT.'modules/products/assets/js/order.js'; ?>" type="text/javascript" language="javascript" ></script>
<script src="<?php echo URL_ROOT.'modules/users/includes/js/trade_history.js'; ?>" type="text/javascript" language="javascript" ></script>
<script src="<?php echo URL_ROOT.'libraries/jquery/thickbox/thickbox.js'; ?>" type="text/javascript" language="javascript" ></script>
<link rel="stylesheet" href="<?php  echo URL_ROOT.'libraries/jquery/thickbox/thickbox.css';?>" />