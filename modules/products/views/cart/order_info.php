<div class='infor_shipping'>
	<!--	SENDER INFO				-->
	<div class="cata-cont-step-t-liqui info-customer-gh-send">
		<div class="cata-info-custo-boder">
			<div class='table_name'>
				<p class='send_info_label'><b>Th&#244;ng tin ng&#432;&#7901;i &#273;&#7863;t h&#224;ng</b></p>
				<a title="" class='green' href="<?php echo FSRoute::_("index.php?module=products&view=cart&task=eshopcart2&eid=$eid&Itemid=".$Itemid)?>">Thay &#273;&#7893;i &#187;</a>								
			</div>
			<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
				<tbody> 
				  <tr>
					<td width="173px"><b>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> sender_name; ?></td>
				  </tr>
				  <tr>
					<td><b>Gi&#7899;i t&#237;nh </b></td>
					<td width="5px">:</td>
					<td><?php echo (@$session_order->sender_sex == 'female')? "N&#7919;":"Nam"; ?>
					</td>
				  </tr>
				  <tr>
					<td><b>&#272;&#7883;a ch&#7881;  </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> sender_address; ?></td>
				  </tr>
				  <tr>
					<td><b>Email </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> sender_email; ?></td>
				  </tr>
				  <tr>
					<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> sender_telephone; ?></td>
				  </tr>
				 </tbody>
			</table>

		</div>
	</div>
	<!--	end SENDER INFO				-->
	<!--	RECIPIENCE INFO				-->
	<div class="cata-cont-step-t-liqui info-customer-gh-receive">
		<div class="cata-info-custo-boder">
			<div class='table_name'>
				<p class='receive_info_label'><b>Th&#244;ng tin ng&#432;&#7901;i nh&#7853;n h&#224;ng</b></p>
					<a title="" class='green' href="<?php echo FSRoute::_("index.php?module=products&view=cart&task=eshopcart2&eid=$eid&Itemid=".$Itemid)?>">Thay &#273;&#7893;i &#187;</a>								
			</div>
			<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
				<tbody> 
				  <tr>
					<td width="173px"><b>T&#234;n ng&#432;&#7901;i nh&#7853;n h&#224;ng </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> recipients_name; ?></td>
				  </tr>
				  <tr>
					<td><b>Gi&#7899;i t&#237;nh </b></td>
					<td width="5px">:</td>
					<td><?php echo (@$session_order->recipients_sex == 'female')? "N&#7919;":"Nam"; ?>
					</td>
				  </tr>
				  <tr>
					<td><b>&#272;&#7883;a ch&#7881;  </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> recipients_address; ?></td>
				  </tr>
				  <tr>
					<td><b>Email </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> recipients_email; ?></td>
				  </tr>
				  <tr>
					<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
					<td width="5px">:</td>
					<td><?php echo @$session_order-> recipients_telephone; ?></td>
				  </tr>
				  <tr>
					<td><b>Th&#7901;i gian nh&#7853;n h&#224;ng  </b></td>
					<td width="5px">:</td>
					<td><?php if(@$session_order-> received_time)
							$hour = date('H',strtotime($session_order-> received_time));
							if($hour)
								echo $hour." h, ";
							echo "ng&#224;y ". date('d/m/Y',strtotime($session_order-> received_time));
					?></td>
				  </tr>
				 </tbody>
			</table>

		</div>
	</div>
	<!--	end RECIPIENCE INFO				-->
</div>	
<div class='clear'></div>
					
