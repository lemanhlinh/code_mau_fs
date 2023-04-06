<?php 
global $tmpl;
$tmpl -> addStylesheet('cart','modules/products/assets/css');
$eid = FSInput::get('eid',0,'int');
$Itemid = FSInput::get('Itemid');
?>
<h3 class="title-col-shopping">
    <span>Quý khách có thể gọi đến cửa hàng gần nhất để đặt hàng trực tiếp!</span>
</h3>
<h4 class="system-fruits">
    <span>Hệ thống trái cây tươi Klever Fruits</span>
</h4>
<div class="shop-system row">
    <?php $i =1; foreach($adress as $item){ ?>
        <div class="col-wp-system">
            <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12"><?php echo $i; ?>.<?php echo $item->name ?></div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12"><?php echo $item->phone; ?></div>
        </div>
    <?php $i++;  } ?>  
</div>

