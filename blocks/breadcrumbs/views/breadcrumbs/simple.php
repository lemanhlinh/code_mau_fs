<?php
global $tmpl, $config;
//$tmpl->addStylesheet('breadcrumbs_simple', 'blocks/breadcrumbs/assets/css');
$total = count($breadcrumbs);
?>
<section class="bread-crumb">
    <span class="crumb-border"></span>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 a-left">
                <ul class="breadcrumb">
                    <?php if (isset($breadcrumbs) && !empty($breadcrumbs)) { ?>
                        <li class="home">
                            <a itemprop="url" title='<?php echo $config['site_name'] ?>' href="<?php echo URL_ROOT ?>"
                               rel='nofollow'>
                                <span itemprop="title"><?php echo FSText::_("Trang chủ"); ?></span>
                            </a>
                        </li>
                        <?php $i = 0; ?>
                        <?php foreach ($breadcrumbs as $item) { ?>
                            <?php if (!$item[1]) { ?>
                                <li class="<?php echo $i == ($total - 1) ? 'active' : '' ?>">
<!--                                    <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>-->
<!--                                    <strong>-->
                                        <span itemprop="title">
                                            <?php echo getWord(20, $item[0]); ?>
                                        </span>
<!--                                    </strong>-->
                                </li>
                            <?php } else { ?>
                                <li class="<?php echo $i == ($total - 1) ? 'active' : '' ?>">
<!--                                    <span class="mr_lr"> <i class="fa fa-angle-right"></i> </span>-->
                                    <a itemprop="url" href="<?php echo $item[1]; ?>" title="<?php echo $item[0]; ?>">
                                        <span itemprop="title"><?php echo getWord(20, $item[0]); ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php $i++; ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<div class="clear"></div>