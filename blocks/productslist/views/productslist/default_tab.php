<?php
    global $tmpl; 

    $tmpl -> addStylesheet('default_tab','blocks/productslist/assets/css');
    $tmpl -> addScript('default_tab','blocks/productslist/assets/js');
    //$link_readmore =FSRoute::_("index.php?module=products&view=home");
?>
<!--<div class="container"> -->
    <ul class="tab row-item">
      <li><a href="javascript:void(0)" class="tablinks active" onclick="openTabproducts(event, 'is_new')"><?php echo FSText::_('Sản phẩm Mới nhất') ?></a></li>
      <li><a href="javascript:void(0)" class="tablinks" onclick="openTabproducts(event, 'is_sell')"><?php echo FSText::_('Bán chạy nhất') ?></a></li>
    </ul>
    
    <div id="is_new" class="tabcontent row-item" style="display: block;">
        <div class="row">
            <?php $i=0; foreach($list_new as $item){ 
                $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);
            ?>
            <div class="col-sm-3 col-xs-6">
                <div class="item-product" >
                    <a class="item-image" href="<?php echo $link; ?>" title="<?php echo $item->name ?>">
                        <img  class="img-responsive" alt="<?php echo $item ->name;?>" src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item->image);?>" />
                    </a>
                    <h3 class="name-pro"><a href="<?php echo $link; ?>" title="<?php echo $item->name ?>"><?php echo getWord(12,$item->name) ?></a></h3>
                    <del class="price_old-pro"><?php echo $item->discount? format_money($item->price_old,'vnđ'):'&nbsp;'; ?></del>
                    <p class="price-pro"><?php echo format_money($item->price,'vnđ') ?></p>
                    <a class="buy-medicine" href="<?php echo $link; ?>" title="<?php echo FSText::_('Đặt thuốc') ?>"><?php echo FSText::_('Đặt thuốc') ?></a>
                </div>
            </div>
            <?php $i++; } ?>
        </div>
    </div><!-- END: .tabcontent -->
    
    <div id="is_sell" class="tabcontent row-item">
        <div class="row">
        <?php $i=0; foreach($list_sell as $item){ 
                $link = FSRoute::_("index.php?module=products&view=product&id=".$item->id."&code=".$item->alias."&ccode=".$item-> category_alias);
            ?>
            <div class="col-sm-3 col-xs-6">
                <div class="item-product" >
                    <a class="item-image" href="<?php echo $link; ?>" title="<?php echo $item->name ?>">
                        <img class="img-responsive img_news" alt="<?php echo $item ->name;?>" src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item->image);?>" />
                    </a>
                    <h3 class="name-pro"><a href="<?php echo $link; ?>" title="<?php echo $item->name ?>"><?php echo getWord(12,$item->name) ?></a></h3>
                    <del class="price_old-pro"><?php echo $item->discount? format_money($item->price_old,'vnđ'):'&nbsp;'; ?></del>
                    <p class="price-pro"><?php echo format_money($item->price,'vnđ') ?></p>
                    <a class="buy-medicine" href="<?php echo $link; ?>" title="<?php echo FSText::_('Đặt thuốc') ?>"><?php echo FSText::_('Đặt thuốc') ?></a>
                </div>
            </div>
        <?php $i++; } ?>
        </div>
    </div><!-- END: .tabcontent -->
    
<!--</div><!-- END: .container -->
