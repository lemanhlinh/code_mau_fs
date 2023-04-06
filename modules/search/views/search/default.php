<?php
global $tmpl;
$tmpl->addStylesheet('search', 'modules/' . $this->module . '/assets/css');
$page = FSInput::get('page');
$keyword = FSInput::get('keyword');
$title = FSText::_('Tìm kiếm với từ khóa').' "' . $keyword . '"';
if (!$page)
    $tmpl->addTitle($title);
else
    $tmpl->addTitle($title . ' - Trang ' . $page);

$total_in_page = count($list);

$str_meta_des = $keyword;

for ($i = 0; $i < $total_in_page; $i++) {
    $item = $list[$i];
    $str_meta_des .= ',' . $item->name;
}
$tmpl->addMetakey($str_meta_des);
$tmpl->addMetades($str_meta_des);
?>
<!-- BREADCRUMBS-->
<?php if ($list or $news_list) { ?>
    <div class='search mt20'>
<!--    --><?php //if ($list) { ?>
<!--        --><?php //include_once 'default_vertical.php'; ?>
<!--    --><?php //} ?>
    <?php if ($news_list) { ?>
        <?php include_once 'default_news.php'; ?>
    <?php } ?>
    </div>
<?php } else { ?>
    <div class="container">
        <h2> <?php echo FSText::_("Không có kết quả phù hợp")?></h2>
    </div>
<?php } ?>