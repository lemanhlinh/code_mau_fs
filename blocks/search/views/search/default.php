<?php
global $tmpl;
//    $tmpl -> addStylesheet("search","blocks/search/assets/css");
$tmpl->addScript("search", "blocks/search/assets/js");
$text_default = FSText::_('Nhập từ khóa tìm kiếm').'...';

$keyword = $text_default;
$module = FSInput::get('module');
if ($module == 'search') {
    $key = FSInput::get('keyword');
    if ($key) {
        $keyword = $key;
    }
}
$lang = FSInput::get('lang');
?>
<input type="hidden" id="alert_ip" value="<?= FSText::_('Bạn phải nhập từ khóa') ?>">

<?php $link = FSRoute::_('index.php?module=search&view=search'); ?>
<div class="row-item search_form" method="get" name="search_form" id="search_form">
    <input type="text" class="form-control keyword" maxlength="70" name="query" id="keyword" placeholder="<?= $text_default ?>"
           value="<?php echo @$key; ?>" data-url="<?php echo URL_ROOT ?>">
    <!--    <input type='hidden'  name="module" value="search"/>-->
    <!--    <input type='hidden'  name="module" id='link_search' value="-->
    <?php //echo FSRoute::_('index.php?module=search&view=search'); ?><!--" />-->
    <!--    <input type='hidden'  name="view" value="search"/>-->
    <!--    <input type='hidden'  name="Itemid" value="20"/>-->
    <a href="javascrip:void(0)" class="search2">
        <img src="<?php echo URL_ROOT ?>modules/news/assets/images/Path 1706.png" alt="<?=FSText::_('Tìm kiếm')?>">
    </a>
    <input type="hidden" id="url" name="search" value="<?php if($lang == 'vi') {
        echo 'tim-kiem/';} else {
        echo 'search/';} ?>">
</div>

