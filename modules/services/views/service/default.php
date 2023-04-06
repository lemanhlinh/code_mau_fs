<?php
global $tmpl, $config;
$tmpl->addScript('form1');
   $tmpl -> addStylesheet('dichvu','modules/services/assets/css');
//$tmpl->addScript('content', 'modules/contents/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
//var_dump($url);
$lang = FSInput::get('lang');
// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
?>
<section>
    <h3 class="title-module hidden">
        <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
    </h3>
    <div class="container body">
        <h2 class="breadcrum"><?php echo $data->title; ?></h2>
        <div class="bbb">
            <a href="<?php echo URL_ROOT.$lang ?>"><?php echo FSText::_("Trang chủ")?> ></a>
            <a href=""><?php echo $data->title; ?></a>
        </div>
        <div class="row cot">
            <div class="rightbody col-xs-12 col-sm-12 col-md-3">
                <div class="menubody">
                    <?php
                    foreach ($danhmuc as $item) {
                        $link = FSRoute::_("index.php?module=services&view=service&id=" . $item->id . "&code=" . $item->alias);
                        $class = '';
                        if ($link == $url) {
                            $class = 'active';
                        }
                    ?>
                    <div class="tuvan <?php echo $class; ?>">
                        <a href="<?php echo $link; ?>"><?php echo $item->title; ?></a>
                    </div>
                  <?php } ?>
                </div>
<!--                <div class="baiviet">-->
<!--                    <p>--><?php //echo FSText::_("Bài viết nổi bật")?><!--</p>-->
<!--                </div>-->
<!--                --><?php
//                    foreach ($is_home as $item) {
//                        $image_resized = URL_ROOT . str_replace('/original/', '/small/', $item->image);
//                        $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
//                        ?>
<!--                    <a href="--><?php //echo $link; ?><!--" class="baivietnoibat">-->
<!--                        <img class="imgdichvu" src="--><?php //echo $image_resized; ?><!--">-->
<!--                        <p class="luong">--><?php //echo getWord(12, $item->title); ?><!--</p>-->
<!--                    </a>-->
<!--                --><?php //} ?>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 leftbody">

                <?php echo $data->content; ?>
            </div>
        </div>
    </div>
</section>





