<?php if (count($news_list)) { ?>
    <div class="search_title mt20 clearfix container">
        <div class="inner">
            <h2><?php echo FSText::_("Từ khóa") ?> '<?php echo $keyword; ?>'</h2>
        </div>
        <div class="arrow-right"></div>
    </div>
    <div class="container border">
        <div class="imgtintuc row">
            <?php
            $i = 1;
            foreach ($news_list as $item) {
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                $link1 = FSRoute::_("index.php?module=news&view=cat&ccode=" . $item->category_alias . "&id=" . $item->category_id);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 mgbt">
                    <div class="bo_img">
                        <img src="<?php echo $image_resized ?>" class="img-fluid"
                             alt="<?php echo getWord(10, $item->title); ?>">
                    </div>
                    <a href="<?php echo $link ?>" class="tintuca"><?php echo  $item->title; ?></a>
                    <p class="icon_time"><?php echo date('d/m/Y', strtotime($item->created_time)) ?></p>
                    <p class="tintucb"><?php echo getWord(14, $item->summary); ?></p>
                </div>
                <?php if ($i % 4 == 0) { ?>
                    <div class="clearfix"></div>
                <?php }
                $i++; ?>
            <?php } ?>
        </div>
    </div>
<?php } ?>