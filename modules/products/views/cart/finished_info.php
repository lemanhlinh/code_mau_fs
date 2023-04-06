<!--	ORDER INFO				-->
<div class="cata-cont-step-t-liqui">
	<div class="cata-info-custo-boder">
		<div class='table_name'>
			<p><b>Th&#244;ng tin &#273;&#417;n h&#224;ng</b></p>
		</div>
		<table width="100%">
			<tr>
				<td width="50%">
					<!--  SENDER INFO -->
					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
						<tbody> 
						  <tr>
							<td colspan="3"><b class='orange'>Th&#244;ng tin ng&#432;&#7901;i &#273;&#7863;t h&#224;ng</b></td>
						  </tr>
						  <tr>
							<td width="173px"><b>T&#234;n ng&#432;&#7901;i &#273;&#7863;t h&#224;ng </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> sender_name; ?></td>
						  </tr>
						  <tr>
							<td><b>Gi&#7899;i t&#237;nh </b></td>
							<td width="5px">:</td>
							<td><?php echo ($order->sender_sex == 'female')? "N&#7919;":"Nam"; ?>
							</td>
						  </tr>
						  <tr>
							<td><b>&#272;&#7883;a ch&#7881;  </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> sender_address; ?></td>
						  </tr>
						  <tr>
							<td><b>Email </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> sender_email; ?></td>
						  </tr>
						  <tr>
							<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> sender_telephone; ?></td>
						  </tr>
						 </tbody>
					</table>
					<!--  end SENDER INFO -->
				</td>
				<td class='td_r'>
					<!--  RECIPIENT INFO -->
					<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tabl-info-customer">
						<tbody> 
							<tr>
								<td colspan="3"><b class='orange'>Th&#244;ng tin ng&#432;&#7901;i nh&#7853;n h&#224;ng</b></td>
							</tr>
						  <tr>
							<td width="173px"><b>T&#234;n ng&#432;&#7901;i nh&#7853;n h&#224;ng </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> recipients_name; ?></td>
						  </tr>
						  <tr>
							<td><b>Gi&#7899;i t&#237;nh </b></td>
							<td width="5px">:</td>
							<td><?php echo ($order->recipients_sex == 'female')? "N&#7919;":"Nam"; ?>
							</td>
						  </tr>
						  <tr>
							<td><b>&#272;&#7883;a ch&#7881;  </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> recipients_address; ?></td>
						  </tr>
						  <tr>
							<td><b>Email </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> recipients_email; ?></td>
						  </tr>
						  <tr>
							<td><b>&#272;i&#7879;n tho&#7841;i </b></td>
							<td width="5px">:</td>
							<td><?php echo $order-> recipients_telephone; ?></td>
						  </tr>
						 </tbody>
					</table>
					<!--  end RECIPIENT INFO -->
				</td>
			</tr>
		</table>
		

	</div>
</div>
<!--	end ORDER INFO				-->