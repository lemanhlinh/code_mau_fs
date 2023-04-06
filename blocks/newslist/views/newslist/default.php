<?php
global $tmpl;
//$tmpl->addStylesheet('highlight', 'blocks/newslist/assets/css');
//$link_readmore =FSRoute::_("index.php?module=news&view=home");
?>
<div class="aside-item">
    <div>
        <div class="title_module"><h2><a href="tin-tuc" title="Tin tức nổi bật">Tin tức nổi bật</a></h2></div>
        <div class="list-blogs">
            <div class="blog_list_item">
                <?php foreach ($list as $item) {
                    $link = FSRoute::_("index.php?module=news&view=news&id=".$item->id."&code=".$item->alias);
                    $image = URL_ROOT.str_replace('/original/', '/small/', $item->image);
                    ?>
                    <article class="blog-item blog-item-list ">
                        <div class="blog-item-thumbnail img1"
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
                        <div class="ct_list_item">
                            <h3 class="blog-item-name text1line_fix text1line"><a
                                <a class="text2line" href="<?php echo $link;?>" title="<?php echo $item->title;?>">
                                    <?php echo getWord(15,$item->title);?></a></h3>
                            <div class="summary_ text2line">
                                <?php echo getWord(30,$item->summary) ?>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            </div>
        </div>
    </div>
</div>