<?php 
global $tmpl;
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
?>
<div class='eshopcart'>
	<div id="news-title">
		<h1>Thanh to&#225;n</h1>
	</div>
	<div id="news-detail">
		<div id="news-head-t">
			<div class="news-head-t-l">
				<div class="news-head-t-r">
				</div>	
			</div>	
		</div>	
		<div class="news_detail-inner">
			
			<div class="news_detail-inner-wrap shopcar_shipping">
				
				<!--	3 STEP	-->
				<?php $this -> generate_step(2);?>
				<!-- end 	3 STEP	-->
				
				<!--	WELCOME  ESTORES			-->
				<!--<div class='estore_intro'>
					<p class="addres-com"><?php  echo $this->estore_info($estore);?></p>	
				</div>
				--><!--	end WELCOME  ESTORES		-->
				
				<?php 
				if(isset($_SESSION['cart'])) {
				?>
				<form action="<?php echo FSRoute::_("index.php?module=products&view=cart&task=shipping&eid=$eid&Itemid=".$Itemid); ?>" name="eshopcart_shipping" id="eshopcart_shipping" method="post" >	
					<!--	COMPANY intro				-->
					<?php include_once 'estore_info.php';?>
					<!--	end COMPANY intro				-->
					
					<!--	PAYMENT METHOD				-->
					<?php include_once 'shipping_payments.php';?>
					<!--	end PAYMENT METHOD				-->
					
					<!--	SHIPPING METHOD				-->
					<?php include_once 'shipping_transfer.php';?>
					<!--	end SHIPPING METHOD					-->
					
					
					
					<input type="hidden" name='module' value="products" />
					<input type="hidden" name='eid' value="<?php echo $eid; ?>" />
					<input type="hidden" name='view' value="cart" />
					<input type="hidden" name='task' value="shipping_save" id = 'task'/>
				</form>	
				<!--	POCILY			-->
				<?php include_once 'shipping_guarantee.php';?>
				<!--	end POCILY			-->
				
				<div class="test-info-next2">
					<div>	
						B&#7841;n h&#227;y ki&#7875;m tra k&#7929; c&#225;c th&#244;ng tin tr&#432;&#7899;c khi ti&#7871;p t&#7909;c 
					</div>
					<a href="javascript:void(0);" onclick="javascript: window.location='<?php echo FSRoute::_('index.php?module=products&view=cart&task=eshopcart&eid='.$eid.'&Itemid='.$Itemid);?>';" title="">Quay l&#7841;i b&#432;&#7899;c 1</a>
					<a href="javascript:void(0);" onclick="javascript:$('#eshopcart_shipping').submit();" title="">Ti&#7871;p theo b&#432;&#7899;c 3</a>
					<span>&nbsp;</span>
				</div>
					
				<?php 	
				} else {
					echo "<p>Gi&#7887; h&#224;ng hi&#7879;n t&#7841;i ch&#432;a c&#243; s&#7843;n ph&#7849;m n&#224;o</p>";
				}
				?>
			</div>
		</div>
	</div>
</div>

