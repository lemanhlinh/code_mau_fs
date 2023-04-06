<?php
global $tmpl, $config;
$tmpl->addScript('form1');
$tmpl->addStylesheet('thuvienanh', 'modules/images/assets/css');
$tmpl->addScript('images', 'modules/images/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
$return = base64_encode($url);
$lang = FSInput::get('lang');
// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
$alert_info = array(
    0 => FSText::_('Album đã hết'),
);
?>


<input type="hidden" id="alert_info" value='<?php echo json_encode($alert_info) ?>'/>


<section>
    <div class="container body">
        <h2 class="breadcrum"><?php echo FSText::_("Thư viện ảnh") ?></h2>
        <div class="bbb">
            <a href="<?php if ($lang == 'vi') { echo URL_ROOT;}else{echo URL_ROOT.'en';} ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href=""><?php echo FSText::_('Thư viện ảnh')?></a>
        </div>
        <div class="row cot">
            <div class="rightbody col-sm-12 col-md-3">
                <div class="menubody">
                    <?php
                    $Itemid = FSInput::get('Itemid', 1, 'int');
                    //                    var_dump($Itemid);
                    $total = count($menusitem);
                    $i = 0;
                    $count_children = 0;
                    $summner_children = 0;
                    foreach ($menusitem as $item) {
                        $link = $item->link ? FSRoute::_($item->link) : '';
//                  var_dump($link);
                        $class = '';
                        if ($link == $url) {
                            $class = 'active';
                        }
                        if ($i == ($total - 1))
                            $class .= ' last-item';

                        $count_children++;

                        if ($count_children == $summner_children && $summner_children)
                            $class .= ' last-item';
                        echo "<div class='tuvan  item $class'>
                  <a class='muiten' target='" . $item->target . "' href='" . $link . "' >" . $item->name . "</a>
                </div>";
                        $i++;
                    } ?>
                </div>
            </div>
            <div class=" col-sm-12 col-md-9 leftbody">
                <div class="leftbody1 row">
                    <?php
                    $i = 1;
                    foreach ($image as $item) {
                        $link = FSRoute::_("index.php?module=images&view=img&id=" . $item->id . "&code=" . $item->alias);
                        $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);

                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-4 thuvienanh">
                            <a href="" type="button" data-target="#myModal<?php echo $i; ?>" data-toggle="modal"
                               role="dialog">
                                <img src="<?php echo $image_resized; ?>" alt="<?php echo $item->name; ?>">
                                <h3 class="img_title"><?php echo $item->name; ?></h3>
                            </a>
                            <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                <div class="modal-dialog size">
                                    <div class="modal-content size1">
                                        <div class="header-modal">

                                            <div id="carousel-example-generic<?php echo $item->id; ?>"
                                                 class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php
                                                    $j = 1;
                                                    $imagechitiet = $model->getimageschitiet($item->id);
                                                    //var_dump($imagechitiet);
                                                    foreach ($imagechitiet as $key) {
                                                        $image_resized = URL_ROOT . str_replace('/original/', '/original/', $key->image);
                                                        $active = '';
                                                        if ($j == 1) {
                                                            $active = 'active';
                                                        }
                                                        ?>

                                                        <div class="item <?php echo $active ?>">
                                                            <img src="<?php echo $key->image; ?>" alt="hình ảnh">
                                                        </div>

                                                        <?php $j++;
                                                    } ?>

                                                </div>

                                                <!-- Controls -->
                                                <a class="left carousel-control prev"
                                                   href="#carousel-example-generic<?php echo $item->id; ?>"
                                                   role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                                </a>
                                                <a class="right carousel-control next"
                                                   href="#carousel-example-generic<?php echo $item->id; ?>"
                                                   role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                                </a>
                                            </div>
                                            <div class="modal-header row">
                                                <div class="col-xs-10 col-sm-10 col-md-3">

                                                </div>
                                                <div class="col-xs-2 col-sm-2 col-md-9">
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $i++;
                    } ?>
                </div>
                <div class="is-hotel hotel_more">

                </div>
                <!--					<div class="taithem1">-->
                <!--						<a href="" type="button" class="btn btn-info taithem">Tải thêm</a>-->
                <?php if (count($all_list) > 6) { ?>
                    <div class="c-view-more bg-white is-margin taithem1">
                        <a class="load_more btn btn-info taithem" href="javascript:void(0)" data-pagecurrent="1"
                           data-nextpage="2" limit="6">
                            <?= FSText::_('Tải thêm'); ?>
                        </a>
                    </div>
                <?php } else
                //            echo ' <div class="c-ourbrand-space bg-white is-margin hidden-lg"></div>';
                ?>
                <!--					</div>-->
            </div>
        </div>
    </div>
</section>



