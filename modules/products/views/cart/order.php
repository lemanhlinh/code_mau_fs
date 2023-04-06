<?php 
global $tmpl;
$tmpl -> addTitle('Thanh toán');
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$tmpl -> addScript('cart','modules/products/assets/js');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
echo $Itemid;
?>
<div class='eshopcart'>
	<div id="news-title">
		<h1>Thanh to&#225;n</h1>
	</div>
	<div id="news-detail">
		<div class="news_detail-inner">
			
			<div class="news_detail-inner-wrap shopcar_shipping">
				
				<?php include_once 'order_items.php';?>
				<?php include_once 'order_payments.php';?>
				<?php include_once 'order_info.php';?>
					
				<div class='notice befoce_order'>
					<?php echo $notice_when_order;?>
				</div>
				
				<div class="test-info-next2">
					<div>	
						B&#7841;n h&#227;y ki&#7875;m tra k&#7929; c&#225;c th&#244;ng tin tr&#432;&#7899;c khi ti&#7871;p t&#7909;c 
					</div>
					<a class="button-step" href="javascript:void(0);" onclick="javascript: window.location='<?php echo FSRoute::_('index.php?module=products&view=cart&task=eshopcart2&Itemid='.$Itemid);?>';" title="">&#9668; Quay l&#7841;i b&#432;&#7899;c 1 </a>
					<a class="button-step" href="javascript:void(0);" onclick="javascript: window.location='<?php echo FSRoute::_('index.php?module=products&view=cart&task=order_save&Itemid='.$Itemid);?>';" title="">G&#7917;i &#273;&#417;n &#273;&#7863;t h&#224;ng &#9658;</a>
<!--					<a class="buy_by_nganluong" href="<?php echo $nl_url_checkout;?>" title="Thanh toán qua ngân lượng">-->
<!--						<img src="<?php echo URL_ROOT.'modules/products/assets/images/btn-paynow-122.png';?>"  />-->
<!--					 </a>-->
					<span>&nbsp;</span>
				</div>
					
				<?php 	
//				} else {
//					echo "<p>Gi&#7887; h&#224;ng hi&#7879;n t&#7841;i ch&#432;a c&#243; s&#7843;n ph&#7849;m n&#224;o</p>";
//				}
				?>
			</div>
		</div>
	</div>
</div>