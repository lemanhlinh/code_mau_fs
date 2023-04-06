<?php
global $config, $tmpl;
?>
<?php if ($data->is_status) { ?>
    <div class="group-status hidden">
    <span class="first_status">
        Tình trạng: <span class="status_name availabel">Còn hàng</span>
    </span>
    </div>
<?php } ?>
<div class="price-box">
    <?php if ($data->discount) { ?>
        <span class="special-price">
            <span class="price product-price" itemprop="price"><?php echo format_money($data->price, '₫/KG'); ?></span>
            <meta itemprop="priceCurrency" content="VND">
        </span> <!-- Giá Khuyến mại -->
        <span class="old-price">
            <del class="price product-price-old sale" itemprop="priceSpecification"><?php echo format_money($data->price_old, '₫'); ?></del>
            <meta itemprop="priceCurrency" content="VND">
        </span> <!-- Giá gốc -->
    <?php } else { ?>
        <span class="special-price">
            <span class="price product-price" itemprop="price"><?php echo $item->price ? format_money($item->price, '₫/KG') : 'Liên hệ'; ?></span>
            <meta itemprop="priceCurrency" content="VND">
        </span> <!-- Giá Khuyến mại -->
    <?php } ?>
</div>
<?php if ($data->is_status) { ?>
    <div class="taxable">
        (Tình trạng: <span class="status_name availabel">Còn hàng</span>)
    </div>
<?php } ?>

<div class="product-summary product_description">
    <div class="rte description text3line">
        <?php echo $data->summary; ?>
    </div>
</div>