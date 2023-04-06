<?php
global $tmpl;
//    $tmpl -> addStylesheet('highlight','blocks/newslist/assets/css');
//    $tmpl -> addScript('script','blocks/newslist/assets/js');
$total = count($list);
$m = date('m');
$y = date('Y');
?>
<?php if(count($list)){ ?>
<section class="awe-section-7">
    <section class="section_blog_index">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wrap_blog_index row relative">
                        <div class="title_section_center left padding_15 mr_30 after_and_before">
                            <h2 class="title font_normal not_bf">
                                <a class="a-position" href="tin-tuc" title="Blog nấu ăn">
                                    Blog nấu ăn</a>
                            </h2>
                        </div>
                        <div class="wrap_owl_blog owl-carousel" data-lg-items="4" data-md-items="4" data-sm-items="2"
                             data-xs-items="1" data-height="false" data-dot="true" data-nav="false" data-margin="0" style="min-height: 273px;">
                            <?php foreach ($list as $item) {
                                $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias);
                                $image = URL_ROOT.str_replace('/original/', '/small/', $item->image);
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <article class="blog-item blog-item-grid row">
                                        <div class="wrap_blg">
                                            <div class="blog-item-thumbnail img1 col-lg-12 col-md-12 col-sm-12 col-xs-12"
                                                 onclick="window.location.href='<?php echo $link;?>';">
                                                <a href="<?php echo $link;?>">
                                                    <picture>
                                                        <source media="(max-width: 480px)"
                                                                srcset="<?= $image ?>">
                                                        <source media="(min-width: 481px) and (max-width: 767px)"
                                                                srcset="<?= $image ?>">
                                                        <source media="(min-width: 768px) and (max-width: 1023px)"
                                                                srcset="<?= $image ?>">
                                                        <source media="(min-width: 1024px) and (max-width: 1199px)"
                                                                srcset="<?= $image ?>">
                                                        <source media="(min-width: 1200px)"
                                                                srcset="<?= $image ?>">
                                                        <img src="<?= $image ?>" style="max-width:100%;" class="img-responsive" alt="<?php echo $item->title;?>">
                                                    </picture>

                                                </a>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_ar mtm">
                                                <h3 class="blog-item-name">
                                                    <a class="text2line" href="<?php echo $link;?>" title="<?php echo $item->title;?>">
                                                        <?php echo getWord(15,$item->title);?></a></h3>
                                                <div class="summary_ text2line">
                                                    <?php echo getWord(30,$item->summary) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
    </section>
</section>
<div class="clear"></div>
<?php } ?>