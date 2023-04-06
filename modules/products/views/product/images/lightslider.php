<?php
    global $tmpl,$config;
    $tmpl -> addStylesheet('lightgallery.min','modules/products/assets/css');
    $tmpl -> addStylesheet('lightslider','modules/products/assets/css');

    $tmpl -> addScript('lightslider','modules/products/assets/js');
    $tmpl -> addScript('lightgallery-all.min','modules/products/assets/js');

    $tmpl -> addScript('carousel','modules/products/assets/js');

    $i=0;
    $j=0;

    // $array1 = array("0" => $data);
    // $product_images_new = array_merge($array1, $product_images);
    $product_images_new = $product_images;
    $total = count($product_images_new);
?>

<?php if($total){ ?>
<div class="clearfix silde-img row-item">
    <ul id="imageGallery" >
        <?php foreach($product_images_new as $item){?>
            <?php if($item->image){ ?>
            <li data-thumb="<?php echo URL_ROOT.str_replace('/original/', '/small/', $item -> image)?>" data-src="<?php echo URL_ROOT.str_replace('/original/', '/original/', $item -> image)?>">
                <img class="img-responsive" src="<?php echo URL_ROOT.str_replace('/original/', '/large/', $item -> image)?>" alt="hình ảnh" />
            </li>
         <?php } ?>
        <?php }?>
    </ul>
</div>
<?php } ?>
