<!-- HEAD -->
<?php
	$title = @$order ? FSText :: _('Xem đơn hàng ').'DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT): FSText :: _('Add'); 
	global $toolbar;
	$toolbar->setTitle($title);
//	$toolbar->addButton('apply',FSText :: _('Apply'),'','apply.png'); 
	$toolbar->addButton('',FSText :: _('Print'),'','print.png',0,1); 
	$toolbar->addButton('back',FSText :: _('Cancel'),'','cancel.png');   
	?>
<!-- END HEAD-->

<!-- BODY-->

<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-cog"></i> 
                Mã đơn hàng: <strong><?php echo 'DH'.str_pad($order -> id, 8 , "0", STR_PAD_LEFT); ?></strong>
            </div>
            <div class="panel-body">
                <?php $print = FSInput::get('print',0,'int');?>
                <?php if(!$print){?>
                <?php include_once 'detail_status.php';?>
                <?php }?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-cog"></i> 
                <?php echo FSText::_('Thông tin người đặt hàng') ?>
            </div>
            <div class="panel-body">
                <!--  SENDER INFO -->
                <?php include_once 'detail_buyer.php';?>
                <!--  end SENDER INFO --> 
            </div>
        </div>
    </div>
</div>

<div class="form_body">
    
</div>
<?php 

    
?>
    <form action="index.php?module=<?php echo $this -> module;?>&view=<?php echo $this -> view;?>"
    	name="adminForm" method="post" enctype="multipart/form-data">
        <table class="table table-striped table-bordered table-hover">
    	<thead>
    		<tr>
    			<th width="30">STT</th>
    			<th width="40%"><?php echo FSText::_('Tên sản phẩm') ?></th>
    			<th><?php echo "Giá(VNĐ)"; ?></th>
    			<th ><?php echo "Số lượng"; ?></th>
    			<th ><?php echo "Tổng giá tiền"; ?></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?php 
    		$total_money = 0;
    		$total_discount = 0;
    		for($i = 0 ; $i < count($data); $i ++ ){?>
    		<?php
    			 $item = $data[$i];
    			 $link_view_product = FSRoute::_('index.php?module=products&view=product&code='.$item -> product_alias.'&id='.$item->product_id.'&ccode='.$item -> category_alias.'&Itemid=6');
    			 if($item -> discount > 0){
                    $total_money += $item -> discount_incentives;
                 }else{
                    $total_money += $item -> total;
                 }
                    
    			 $total_discount += $item -> discount * $item -> count;
    		?>
    			<tr class='row<?php echo ($i%2); ?>'>
    			<td align="center"><strong><?php echo ($i+1); ?></strong><br /></td>
    			<td>
                    <a href="<?php echo $link_view_product; ?>" target="_blank">
                        <?php echo $item -> product_name; ?>
                    </a>
                </td>
    			<!--		PRICE 	-->
    			<td>
                    <?php if($item -> discount > 0){ ?>
    						<?php echo format_money($item -> discount,' VNĐ');  ?>
                    <?php } else { ?>
                            	<?php echo format_money($item -> price,' VNĐ');  ?>
                    <?php } ?>
                </td>
    			<td>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo FSText::_('Số lượng'); ?>" value="<?php echo $item->count; ?>" disabled="">
                </td>
    			<td>
                    <span class='red'>
                        <?php if($item -> discount > 0){ ?>
    							<?php echo format_money($item -> discount_incentives,' VNĐ');  ?>
                        <?php } else { ?>
                                <?php echo format_money($item -> total,' VNĐ');  ?>
                        <?php } ?>
                    </span>
                </td>
    		</tr>
    		<?php } ?>
    		<tr>
    			<td colspan="4" align="right">
                    <strong>T&#7893;ng ti&#7873;n:</strong>
                </td>
    			<td>
                    <strong class='red'><?php echo format_money($total_money,' VNĐ'); ?>
    			</td>
    		</tr>
    		</tbody>
        </table>
    		<?php if(@$data->id) { ?>
    		<input type="hidden" value="<?php echo $data->id; ?>" name="id">
    		<?php }?>
    		<input type="hidden" value="<?php echo $this -> module;?>" name="module"> 
            <input type="hidden" value="<?php echo $this -> view;?>" name="view"> 
            <input type="hidden" value="" name="task"> 
            <input type="hidden" value="0" name="boxchecked">
    </form>
<!-- end FORM	MAIN - ORDER						-->
 
<!--  ESTORE INFO -->
<?php // include_once 'detail_estore.php';?>
<!--  end ESTORE INFO -->



<!--  RECIPIENT INFO -->
<?php //include_once 'detail_recipient.php';?>
<!--  end RECIPIENT INFO --> 

<?php // include_once 'detail_payment.php';?>
</div>
<!-- END BODY-->

<script  type="text/javascript" language="javascript">
	print_page();
	function print_page(){
		var width = 800;
		var centerWidth = (window.screen.width - width) / 2;
//	    var centerHeight = (window.screen.height - windowHeight) / 2;
		$('.Print').click(function(){
			link = window.location.href;
			link += '&print=1';
			window.open(link, "","width="+width+",menubar=0,resizable=1,scrollbars=1,statusbar=0,titlebar=0,toolbar=0',left="+ centerWidth + ",top=0");
		});
	}
</script>
