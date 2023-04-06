<?php
global $tmpl, $config;
$total_relative = count(@$relate_products_list);
$tmpl->addStylesheet('sanphamchitiet', 'modules/products/assets/css');
$Itemid = 6;
$noWord = 80;
$url = $_SERVER['REQUEST_URI'];
$return = base64_encode($url);
FSFactory::include_class('FSString');

$tmpl->addScript('product', 'modules/products/assets/js');
$return = $_SERVER['REQUEST_URI'];
// $return = base64_encode($url);
$lang = FSInput::get('lang');
$alert_info = array(
    0 => FSText::_('Nhập Từ Khóa'),
    1 => FSText::_('Bạn chưa nhập từ khóa'),
    2 => FSText::_('Bạn chưa chọn tỉnh thành'),
    3 => FSText::_('Bạn chưa nhập email'),
    4 => FSText::_('Email không hợp lệ'),
    5 => FSText::_('Bạn chưa nhập số điện thoại'),
    6 => FSText::_('Số điện thoại không hợp lệ'),
    7 => FSText::_('Vui lòng nhập từ'),
    8 => FSText::_('số'),
    9 => FSText::_('đến'),
    10 => FSText::_('Bạn chưa chọn phiên bản'),
    11 => FSText::_('Nhập mã bảo mật'),

);
?>

<input type="hidden" id="alert_info" value='<?php echo json_encode($alert_info) ?>'/>

<section>
    <!--    --><?php //echo $tmpl->load_direct_blocks('onlinesupport', array('style' => 'default')); ?>

    <div class="container body">
        <p class="breadcrum"><?php echo $products_content->code; ?></p>
        <div class="bbb">
            <a href="<?php if ($lang == 'vi') { echo URL_ROOT;}else{echo URL_ROOT.'en';} ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href="<?php echo FSRoute::_("index.php?module=products&view=home"); ?>"><?php echo FSText::_("Sản phẩm") ?>
                ></a>
            <!--            <a href="">--><?php //echo $products_content->category_name; ?><!--</a>-->
            <a href=""><?php echo $products_content->code; ?></a>
        </div>
        <div class="infor row cot">
            <div class="col-xs-12 col-sm-6 col-md-5 hang">
                <?php
                include('images/lightslider.php');
                ?>
                <!-- <img src="<?php echo $products_content->image; ?>"> -->
            </div>
            <div class="col-xs-12 col-sm-6 col-md-7 hang">
                <h1 class="ten"><?php echo $products_content->name; ?></h1>
                <strong class="gia"><?php echo FSText::_("Giá") ?>: <span
                            style="color: #e11428"><?php if ($products_content->price){ echo $products_content->price;}else{ echo 'Liên hệ';} ?></span></strong>
                <div class="tinhnang">
                    <strong><?php echo FSText::_("Tính năng cơ bản") ?>:</strong>
                </div>
                <div class="content">
                    <p><?php echo getWord(45, $products_content->summary); ?></p>
                </div>
                <div class="lienhe">
                    <a href="" type="button" class="btn btn-info btn-lg" data-toggle="modal"
                       data-target="#myModal"><?php echo FSText::_("Liên hệ"); ?></a>
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog size">
                            <div class="modal-content size1">
                                <div class="header-modal">
                                    <div class="modal-header row">
                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                            <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="post" name="contact1111"
                                              action="#">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name1" name="name"
                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="job1" name="company"
                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="add1" name="address"
                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name='city' id="city111">
                                                        <option value=""><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                            *
                                                        </option>
                                                        <?php
                                                        foreach ($city as $key) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="email_contact"
                                                           name="email" placeholder="<?php echo FSText::_("Email") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="tel" class="form-control" id="phone1" name="phone"
                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="check_capcha">
                                                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                       type="text" id="txtCaptcha1" value="" name="txtCaptcha" size="5" required/>
                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                   class="code-view fl-left">
                                                    <img id="imgCaptcha" class="fl-left"
                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                </a>
                                            </div>
                                            <div class="form-group  md_ft">
                                                <div class="col-md-8 col-sm-12 notemd">
                                                    <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ liên
                                                        hệ qua email của bạn</p>
                                                </div>
                                                <div class="col-md-4 col-sm-12 sbm">
                                                    <a href="javascript:void(0)" title="GỬI" class="btn btn-info send1"
                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                </div>
                                            </div>
                                            <input type="hidden" name='module'
                                                   value='products'/>
                                            <input type="hidden" name='view'
                                                   value='product'/>
                                            <input type="hidden" name='task'
                                                   value='save'/>
                                            <input type="hidden" name='id'
                                                   value='<?php echo $products_content->id; ?>'/>
                                            <input type="hidden" name='alias'
                                                   value='<?php echo $products_content->alias; ?>'/>
                                            <input type="hidden" name='products_name'
                                                   value='<?php echo $products_content->name; ?>'/>
                                            <input type="hidden" name='type' value='liên hệ sản phẩm'/>
                                            <input type="hidden" name='return'
                                                   value='<?php echo $return; ?>'/>
                                            <!--                                            <input type="hidden" name='module' value='products'/>-->
                                            <!--                                            <input type="hidden" name='view' value='product'/>-->
                                            <!--                                            <input type="hidden" name='task' value='save'/>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($products_content->file_download1 or $products_content->link_download1 or $products_content->link_download2 or $products_content->file_download2 or $products_content->link_download3 or $products_content->file_download3 or $products_content->link_download4 or $products_content->file_download4 or $products_content->link_download5 or $products_content->file_download5 or $products_content->link_download6 or $products_content->file_download6) { ?>
                    <div class="download">
                        <!-- <a href="" type="button" class="btn btn-success">Download</a> -->
                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                           data-target="#myModaldownload"><?php echo FSText::_("Download") ?></a>
                        <div class="modal fade" id="myModaldownload" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact1112"
                                                  action="#">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name2" name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="job" name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="add" name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city2">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email_download"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone2" name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='version'
                                                                id="version2">
                                                            <option value="0"><?php echo FSText::_("Chọn phiên bản") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            if ($products_content->file_download1 or $products_content->link_download1) { ?>
                                                                <option value="<?php echo $products_content->file_name1; ?>"><?php echo $products_content->file_name1; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download2 or $products_content->link_download2) { ?>
                                                                <option value="<?php echo $products_content->file_name2; ?>"><?php echo $products_content->file_name2; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download3 or $products_content->link_download3) { ?>
                                                                <option value="<?php echo $products_content->file_name3; ?>"><?php echo $products_content->file_name3; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download4 or $products_content->link_download4) { ?>
                                                                <option value="<?php echo $products_content->file_name4; ?>"><?php echo $products_content->file_name4; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download5 or $products_content->link_download5) { ?>
                                                                <option value="<?php echo $products_content->file_name5; ?>"><?php echo $products_content->file_name5; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download or $products_content->link_download6) { ?>
                                                                <option value="<?php echo $products_content->file_name6; ?>"><?php echo $products_content->file_name6; ?> </option>
                                                            <?php } ?>


                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note2"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha2" value="" name="txtCaptcha" size="5" required/>
                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img id="imgCaptcha" class="fl-left"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ
                                                            liên hệ qua email của bạn</p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)" title="GỬI"
                                                           class="btn btn-info send1"
                                                           id="btnn2"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Download sản phẩm'/>
                                                <input type="hidden" name='return'
                                                       value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="dangkymua">
                    <a href="" type="button" class="btn btn1 btn-warning" data-toggle="modal"
                       data-target="#myModalmua"><?php echo FSText::_("Đăng ký mua") ?></a>
                    <div class="modal fade" id="myModalmua" role="dialog">
                        <div class="modal-dialog size">
                            <div class="modal-content size1">
                                <div class="header-modal">
                                    <div class="modal-header row">
                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                            <h4 class="modal-title"><?php echo FSText::_("Đăng ký mua") ?></h4>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                            <button type="button" class="close"
                                                    data-dismiss="modal">&times;
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="post" name="order100"
                                              action="#">
<!--                                            index.php?module=products&view=product&task=save-->
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                           id="name3" name="name"
                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="job"
                                                           name="company"
                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="add"
                                                           name="address"
                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name='city'
                                                            id="city3">
                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                            *
                                                        </option>
                                                        <?php
                                                        foreach ($city as $key) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control"
                                                           id="email_order" name="email"
                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="tel" class="form-control"
                                                           id="phone3" name="phone"
                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                <textarea rows="4" class="form-control"
                                                          name='message' id="note"
                                                          placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="check_capcha">
                                                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                       type="text" id="txtCaptcha3" value="" name="txtCaptcha" size="5" required/>
                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                   class="code-view fl-left">
                                                    <img id="imgCaptcha" class="fl-left"
                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                </a>
                                            </div>
                                            <div class="form-group  md_ft">
                                                <div class="col-md-8 col-sm-12 notemd">
                                                    <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ liên
                                                        hệ qua email của bạn</p>
                                                </div>
                                                <div class="col-md-4 col-sm-12 sbm">
                                                    <a href="javascript:void(0)" title="GỬI" class="btn btn-info send1"
                                                       id="btnn3"><?php echo FSText::_("GỬI") ?></a>
                                                </div>
                                            </div>
                                            <input type="hidden" name='module'
                                                   value='products'/>
                                            <input type="hidden" name='view'
                                                   value='product'/>
                                            <input type="hidden" name='task'
                                                   value='save'/>
                                            <input type="hidden" name='id'
                                                   value='<?php echo $products_content->id; ?>'/>
                                            <input type="hidden" name='alias'
                                                   value='<?php echo $products_content->alias; ?>'/>
                                            <input type="hidden" name='products_name'
                                                   value='<?php echo $products_content->name; ?>'/>
                                            <input type="hidden" name='type' value='Đăng ký mua'/>
                                            <input type="hidden" name='return'
                                                   value='<?php echo $return; ?>'/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                --><?php //if($products_content->landing_page){ ?>
                <!--                    <div class="landingpage">-->
                <!--                        <p>--><?php //echo FSText::_("Landing page");?><!--:<a href="-->
                <?php //echo $products_content->landing_page ?><!-- " target="_blank">  -->
                <?php //echo $products_content->landing_page ?><!--</a>-->
                <!--                        </p>-->
                <!--                    </div>-->
                <!--                --><?php //} ?>
                <div class="tag">
                    <?php
                    include 'default_tags.php';
                    ?>
                </div>
                <div class="bottom">
                    <?php
                    include 'default_share_bottom.php';
                    ?>
                </div>
            </div>
        </div>

        <div class="row bodymenu">
            <div class=" col-md-9 lbody">
                <div class="menu1">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#home"><?php echo FSText::_("Tổng quan") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu1"><?php echo FSText::_("Chi tiết tính năng") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu2"><?php echo FSText::_("Video") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu3"><?php echo FSText::_("Tài liệu sản phẩm") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu4"><?php echo FSText::_("Sản phẩm liên quan") ?></a>
                        </li>
                    </ul>
                    <!-- </div> -->
                    <div class="tab-content">
                        <!-- //home -->
                        <div id="home" class="tab-pane fade in active">
                            <div class="contentt boxdesc" id="boxdesc" style="height: 650px;" data-height="650">
                                <p><?php echo html_entity_decode($products_content->description); ?></p>
                            </div>
                            <div class="show">
                                <a class="btn btn-info details_click clickmore " data-id="boxdesc" data-class="1">
                                    <?php echo FSText::_("Xem thông tin đầy đủ") ?></a>
                            </div>
                        </div>
                        <!-- // menu1 -->
                        <div id="menu1" class="tab-pane fade">
                            <div class="contentt boxdex" id="boxdex" style="height: 650px;" data-height="650">
                                <p><?php echo html_entity_decode($products_content->feature_details); ?></p>
                            </div>
                            <div class="show">
                                <a class="btn btn-info details_click clickmore " data-id="boxdex" data-class="1">
                                    <?php echo FSText::_("Xem thông tin đầy đủ") ?></a>
                            </div>
                        </div>
                        <!-- //menu2 -->
                        <div id="menu2" class="tab-pane fade">
                            <!--                            <p class="nd">Sed ut perspiciatis unde omnis iste natus error sit voluptatem </p>-->
                            <div class="video">
                                <?php echo html_entity_decode($products_content->video); ?>
                            </div>

                        </div>
                        <!-- //menu3 -->
                        <div id="menu3" class="tab-pane fade">
                            <?php if ($products_content->file_download1 or $products_content->link_download1) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name1 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalfile1"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalfile1" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1113"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name4" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city4">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email4"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone4" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                            <textarea rows="4" class="form-control" name='message'
                                                                      id="note"
                                                                      placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha4" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn4"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name1; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit1; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download2 or $products_content->link_download2) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản ") ?><?php echo $products_content->file_name2 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalfile2"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalfile2" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1114"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name5" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city5">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email5"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone5" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                    <textarea rows="4" class="form-control"
                                                                              name='message'
                                                                              id="note"
                                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha5" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn5"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name3; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit2; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download3 or $products_content->link_download3) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name3 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalflie3"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalflie3" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1116"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name6" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city6">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email6"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone6" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha6" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn6"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name3; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit3; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download4 or $products_content->link_download4) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name4 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalfile4"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalfile4" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact7"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name7" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city7">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email7"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone7" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha7" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn7"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name4; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit4; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download5 or $products_content->link_download5) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        Phiên
                                        bản <?php echo $products_content->file_name5 ?>.</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal8">Download</a>
                                        <div class="modal fade" id="myModal8" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title">Download</h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact8"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name8" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city8">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email8"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone8" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha8" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn8"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name5; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit5; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download6 or $products_content->link_download6) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat">Bộ cài đặt phần mềm <?php echo $products_content->name; ?>.
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name6 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalfile9"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalfile9" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact9"
                                                                  action="#">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name9" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="job"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="add"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city9">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email9"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone9" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha9" value="" name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img id="imgCaptcha" class="fl-left"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)" title="GỬI"
                                                                           class="btn btn-info send"
                                                                           id="btnn9"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name6; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit6; ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <!-- //menu4 -->
                        <div id="menu4" class="tab-pane fade">
                            <?php if ($products_content->products_relates) { ?>
                                <div class="row lienquan">
                                    <?php
                                    // var_dump($list);
                                    $i = 1;
                                    $j = 1;
                                    foreach ($products_relates as $item) {
                                        $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                                        $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                                        ?>
                                        <div class="col-xs-12 col-sm-6 col-md-6 left">
                                            <div class="dobong">
                                                <div class="khung">
                                                    <a class="dpll" href="<?php if ($item->landing_page) {
                                                        echo $item->landing_page;
                                                    } else {
                                                        echo $link;
                                                    } ?>" target="<?php if ($item->landing_page) {
                                                        echo '_blank';
                                                    } ?>">
                                                        <img class="sp spall spp<?php echo $item->id . 'al'; ?>"
                                                             src="<?php echo $image_resized; ?>"
                                                             alt="<?php echo $item->name ?>">
                                                        <img class="logo1" src="<?php echo URL_ROOT.$item->icon ?>" alt="<?php echo $item->name ?>">
                                                        <p class="phanmem"
                                                           title="<?php echo $item->name ?>"><?php echo getWord(6, $item->name); ?></p>
                                                        <p class="thuoctinh thuoctinhall fthuoctinh<?php echo $item->id . 'al'; ?>"><?php echo getWord(20, $item->summary); ?></p>
                                                        <p
                                                                class="abc fabc<?php echo $item->id . 'al'; ?>"><?php echo FSText::_("chi tiết sản phẩm") ?></p>
                                                    </a>
                                                </div>
                                                <div class="chitiet">
                                                    <div class="xemthem">
                                                        <p onclick="xemthem('<?php echo $item->id . 'al'; ?>')"
                                                           class="ab fab<?php echo $item->id . 'al'; ?>"><?php echo FSText::_("XEM THÊM") ?></p>
                                                    </div>
                                                    <div class="hienthi">
                                                        <div class="gia fgia<?php echo $item->id . 'al'; ?>">
                                                            <p><b><?php echo FSText::_("Giá") ?>:</b><span
                                                                        class="red"> <?php if ($item->price){ echo $item->price;}else{ echo 'Liên hệ';} ?></span>
                                                            </p>
                                                            <div class="tuychon clearfix">
                                                                <div class="col-md-4 col-sm-4 col-xs-4  lienhe">
                                                                    <a href="" type="button" class="btn btn1 btn-info"
                                                                       data-toggle="modal"
                                                                       data-target="#myModal<?php echo $i; ?>"><?php echo FSText::_("Liên hệ") ?></a>
                                                                    <div class="modal fade"
                                                                         id="myModal<?php echo $i; ?>" role="dialog">
                                                                        <div class="modal-dialog size">
                                                                            <div class="modal-content size1">
                                                                                <div class="header-modal">
                                                                                    <div class="modal-header row">
                                                                                        <div class="col-xs-10 col-sm-10 col-md-3">
                                                                                            <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                                                                        </div>
                                                                                        <div class="col-xs-2 col-sm-2 col-md-9">
                                                                                            <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal">
                                                                                                &times;
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form class="form-horizontal"
                                                                                              role="form" method="post"
                                                                                              name="contact_hot<?php echo $item->id; ?>"
                                                                                              id="contact_hot<?php echo $item->id; ?>"
                                                                                              action="#">
                                                                                            <div class="form-group">
                                                                                                <label for="name_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Họ tên") ?>
                                                                                                    *</label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="name_hot<?php echo $item->id; ?>"
                                                                                                           name="name">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="job"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Đơn vị công tác") ?></label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="job"
                                                                                                           name="company">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="add"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Địa chỉ") ?> </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="add"
                                                                                                           name="address">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="city_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Tỉnh thành") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <select class="form-control"
                                                                                                            name='city'
                                                                                                            id="city_hot<?php echo $item->id; ?>">
                                                                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?></option>
                                                                                                        <?php
                                                                                                        foreach ($city as $key) {
                                                                                                            # code...
                                                                                                            ?>
                                                                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="email_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Email") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="email"
                                                                                                           class="form-control"
                                                                                                           id="email_hot<?php echo $item->id; ?>"
                                                                                                           name="email">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="phone_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Điện thoại di động") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="tel"
                                                                                                           class="form-control"
                                                                                                           id="phone_hot<?php echo $item->id; ?>"
                                                                                                           name="phone">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="check_capcha">
                                                                                                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                                       type="text" id="txtCaptcha_hot<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                                                   class="code-view fl-left">
                                                                                                    <img id="imgCaptcha" class="fl-left"
                                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="note"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Ghi chú") ?></label>
                                                                                                <div class="col-sm-9">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <div class="col-sm-offset-3 col-sm-9">
                                                                                                    <a href="javascript:void(0)"
                                                                                                       title="GỬI"
                                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                                       data_type="hot"
                                                                                                       class="btn btn-info send"
                                                                                                       id="btnn100"><?php echo FSText::_("GỬI") ?></a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden" name='module'
                                                                                                   value='products'/>
                                                                                            <input type="hidden" name='view'
                                                                                                   value='product'/>
                                                                                            <input type="hidden" name='task'
                                                                                                   value='save'/>
                                                                                            <input type="hidden"
                                                                                                   name='id'
                                                                                                   value='<?php echo $item->id; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='alias'
                                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='products_name'
                                                                                                   value='<?php echo $item->name; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='type'
                                                                                                   value='liên hệ sản phẩm'/>
                                                                                            <input type="hidden" name='return'
                                                                                                   value='<?php echo $return; ?>'/>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>


                                                                <?php if ($item->file_download1 or $item->link_download1 or $item->link_download2 or $item->file_download2 or $item->link_download3 or $item->file_download3 or $item->link_download4 or $item->file_download4 or $item->link_download5 or $item->file_download5 or $item->link_download6 or $item->file_download6) { ?>

                                                                    <div class="col-md-4 col-sm-4 col-xs-4  lienhe">
                                                                        <!-- <button type="button" class="btn btn-success">Download</button> -->
                                                                        <!-- <button type="button" class="btn btn-info ">Liên hệ</button> -->
                                                                        <a href="" type="button"
                                                                           class="btn btn1 btn-success "
                                                                           data-toggle="modal"
                                                                           data-target="#myModaldownload<?php echo $i; ?>"><?php echo FSText::_("Download") ?></a>
                                                                        <div class="modal fade"
                                                                             id="myModaldownload<?php echo $i; ?>"
                                                                             role="dialog">
                                                                            <div class="modal-dialog size">
                                                                                <div class="modal-content size1">
                                                                                    <div class="header-modal">
                                                                                        <div class="modal-header row">
                                                                                            <div class="col-xs-10 col-sm-10 col-md-3">
                                                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                                                            </div>
                                                                                            <div class="col-xs-2 col-sm-2 col-md-9">
                                                                                                <button type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal">
                                                                                                    &times;
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form class="form-horizontal"
                                                                                                  role="form"
                                                                                                  method="post"
                                                                                                  name="download_hot<?php echo $item->id ?>"
                                                                                                  id="download_hot<?php echo $item->id ?>"
                                                                                                  action="#">
                                                                                                <div class="form-group">
                                                                                                    <label for="namedl_hot<?php echo $item->id ?>"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Họ tên") ?>
                                                                                                        *</label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <input type="text"
                                                                                                               class="form-control"
                                                                                                               id="namedl_hot<?php echo $item->id ?>"
                                                                                                               name="name">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="job"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Đơn vị công tác") ?></label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <input type="text"
                                                                                                               class="form-control"
                                                                                                               id="job"
                                                                                                               name="company">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="add"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Địa chỉ") ?> </label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <input type="text"
                                                                                                               class="form-control"
                                                                                                               id="add"
                                                                                                               name="address">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="citydl_hot<?php echo $item->id; ?>"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Tỉnh thành") ?>
                                                                                                        * </label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <select class="form-control"
                                                                                                                name='city'
                                                                                                                id="citydl_hot<?php echo $item->id; ?>">
                                                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?></option>
                                                                                                            <?php
                                                                                                            foreach ($city as $key) {
                                                                                                                # code...
                                                                                                                ?>
                                                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                                            <?php } ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="emaildl_hot<?php echo $item->id; ?>"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Email") ?>
                                                                                                        * </label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <input type="email"
                                                                                                               class="form-control"
                                                                                                               id="emaildl_hot<?php echo $item->id; ?>"
                                                                                                               name="email">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="phonedl_hot<?php echo $item->id; ?>"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Điện thoại di động") ?>
                                                                                                        * </label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <input type="tel"
                                                                                                               class="form-control"
                                                                                                               id="phonedl_hot<?php echo $item->id; ?>"
                                                                                                               name="phone">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="versiondl_hot<?php echo $item->id; ?>"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Phiên bản") ?>
                                                                                                        * </label>
                                                                                                    <div class="col-sm-9">
                                                                                                        <select class="form-control"
                                                                                                                name='version'
                                                                                                                id="versiondl_hot<?php echo $item->id; ?>">
                                                                                                            <option value="0"><?php echo FSText::_("Chọn phiên bản") ?></option>
                                                                                                            <?php
                                                                                                            if ($item->file_download1 or $item->link_download1) { ?>
                                                                                                                <option value="<?php echo $item->file_name1; ?>"><?php echo $item->file_name1; ?> </option>
                                                                                                            <?php } ?>
                                                                                                            <?php
                                                                                                            if ($item->file_download2 or $item->link_download2) { ?>
                                                                                                                <option value="<?php echo $item->file_name2; ?>"><?php echo $item->file_name2; ?> </option>
                                                                                                            <?php } ?>
                                                                                                            <?php
                                                                                                            if ($item->file_download3 or $item->link_download3) { ?>
                                                                                                                <option value="<?php echo $item->file_name3; ?>"><?php echo $item->file_name3; ?> </option>
                                                                                                            <?php } ?>
                                                                                                            <?php
                                                                                                            if ($item->file_download4 or $item->link_download4) { ?>
                                                                                                                <option value="<?php echo $item->file_name4; ?>"><?php echo $item->file_name4; ?> </option>
                                                                                                            <?php } ?>
                                                                                                            <?php
                                                                                                            if ($item->file_download5 or $item->link_download5) { ?>
                                                                                                                <option value="<?php echo $item->file_name5; ?>"><?php echo $item->file_name5; ?> </option>
                                                                                                            <?php } ?>
                                                                                                            <?php
                                                                                                            if ($item->file_download or $item->link_download6) { ?>
                                                                                                                <option value="<?php echo $item->file_name6; ?>"><?php echo $item->file_name6; ?> </option>
                                                                                                            <?php } ?>


                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label for="note"
                                                                                                           class="col-sm-3 control-label"><?php echo FSText::_("Ghi chú") ?></label>
                                                                                                    <div class="col-sm-9">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"></textarea>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="check_capcha">
                                                                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                                           type="text" id="txtCaptchadl_hot<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                                                       class="code-view fl-left">
                                                                                                        <img id="imgCaptcha" class="fl-left"
                                                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                                                    </a>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <div class="col-sm-offset-3 col-sm-9">
                                                                                                        <a href="javascript:void(0)"
                                                                                                           title="GỬI"
                                                                                                           data_id="<?php echo $item->id; ?>"
                                                                                                           data_type="hot"
                                                                                                           class="btn btn-info send"
                                                                                                           id="btnn100"><?php echo FSText::_("GỬI") ?></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <input type="hidden" name='module'
                                                                                                       value='products'/>
                                                                                                <input type="hidden" name='view'
                                                                                                       value='product'/>
                                                                                                <input type="hidden" name='task'
                                                                                                       value='save'/>
                                                                                                <input type="hidden"
                                                                                                       name='id'
                                                                                                       value='<?php echo $item->id; ?>'/>
                                                                                                <input type="hidden"
                                                                                                       name='alias'
                                                                                                       value='<?php echo $item->alias; ?>'/>
                                                                                                <input type="hidden"
                                                                                                       name='products_name'
                                                                                                       value='<?php echo $item->name; ?>'/>
                                                                                                <input type="hidden"
                                                                                                       name='type'
                                                                                                       value='Download sản phẩm'/>
                                                                                                <input type="hidden" name='return'
                                                                                                       value='<?php echo $return; ?>'/>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>

                                                                <div class="col-md-4 col-sm-4 col-xs-4  lienhe">
                                                                    <!-- <button type="button" class="btn btn-warning">Đăng ký mua</button> -->
                                                                    <a href="" type="button"
                                                                       class="btn btn1 btn-warning" data-toggle="modal"
                                                                       data-target="#myModalmua<?php echo $i; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                                                                    <div class="modal fade"
                                                                         id="myModalmua<?php echo $i; ?>" role="dialog">
                                                                        <div class="modal-dialog size">
                                                                            <div class="modal-content size1">
                                                                                <div class="header-modal">
                                                                                    <div class="modal-header row">
                                                                                        <div class="col-xs-10 col-sm-10 col-md-3">
                                                                                            <h4 class="modal-title"><?php echo FSText::_("Đăng ký mua") ?></h4>
                                                                                        </div>
                                                                                        <div class="col-xs-2 col-sm-2 col-md-9">
                                                                                            <button type="button"
                                                                                                    class="close"
                                                                                                    data-dismiss="modal">
                                                                                                &times;
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form class="form-horizontal"
                                                                                              role="form" method="post"
                                                                                              id="dangky_hot<?php echo $item->id; ?>"
                                                                                              action="#">
                                                                                            <div class="form-group">
                                                                                                <label for="namedk_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Họ tên") ?>
                                                                                                    *</label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="namedk_hot<?php echo $item->id; ?>"
                                                                                                           name="name">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="job"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Đơn vị công tác") ?></label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="job"
                                                                                                           name="company">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="add"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Địa chỉ") ?> </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="text"
                                                                                                           class="form-control"
                                                                                                           id="add"
                                                                                                           name="address">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="citydk_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Tỉnh thành") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <select class="form-control"
                                                                                                            name='city'
                                                                                                            id="citydk_hot<?php echo $item->id; ?>">
                                                                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?></option>
                                                                                                        <?php
                                                                                                        foreach ($city as $key) {
                                                                                                            # code...
                                                                                                            ?>
                                                                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                                        <?php } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="emaildk_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Email") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="email"
                                                                                                           class="form-control"
                                                                                                           id="emaildk_hot<?php echo $item->id; ?>"
                                                                                                           name="email">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="phonedk_hot<?php echo $item->id; ?>"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Điện thoại di động") ?>
                                                                                                    * </label>
                                                                                                <div class="col-sm-9">
                                                                                                    <input type="tel"
                                                                                                           class="form-control"
                                                                                                           id="phonedk_hot<?php echo $item->id; ?>"
                                                                                                           name="phone">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <label for="note"
                                                                                                       class="col-sm-3 control-label"><?php echo FSText::_("Ghi chú") ?></label>
                                                                                                <div class="col-sm-9">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="check_capcha">
                                                                                                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                                       type="text" id="txtCaptchadk_hot<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                                                   class="code-view fl-left">
                                                                                                    <img id="imgCaptcha" class="fl-left"
                                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                                                </a>
                                                                                            </div>
                                                                                            <div class="form-group">
                                                                                                <div class="col-sm-offset-3 col-sm-9">
                                                                                                    <a href="javascript:void(0)"
                                                                                                       title="GỬI"
                                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                                       data_type="hot"
                                                                                                       class="btn btn-info send"
                                                                                                       id="btnn100"><?php echo FSText::_("GỬI") ?></a>
                                                                                                </div>
                                                                                            </div>
                                                                                            <input type="hidden" name='module'
                                                                                                   value='products'/>
                                                                                            <input type="hidden" name='view'
                                                                                                   value='product'/>
                                                                                            <input type="hidden" name='task'
                                                                                                   value='save'/>
                                                                                            <input type="hidden"
                                                                                                   name='id'
                                                                                                   value='<?php echo $item->id; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='alias'
                                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='products_name'
                                                                                                   value='<?php echo $item->name; ?>'/>
                                                                                            <input type="hidden"
                                                                                                   name='type'
                                                                                                   value='Đăng ký mua'/>
                                                                                            <input type="hidden" name='return'
                                                                                                   value='<?php echo $return; ?>'/>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="thugon">
                                                                <p onclick="thugon('<?php echo $item->id . 'al'; ?>')">
                                                                    <?php echo FSText::_("THU GỌN") ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    function xemthem(i) {
                                                        $(".fgia" + i).slideDown();
                                                        $(".fabc" + i).slideDown();
                                                        $(".spp" + i).slideDown();
                                                        $(".fthuoctinh" + i).slideDown();
                                                        $(".xemthem .fab" + i).slideUp();
                                                    }

                                                    function thugon(i) {
                                                        $(".lienquan .hienthi .fgia" + i).slideUp();
                                                        $(".fabc" + i).slideUp();
                                                        $(".spp" + i).slideUp();
                                                        $(".fthuoctinh" + i).slideUp();
                                                        $(".xemthem .fab" + i).slideDown();
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                        <?php if ($j % 2 == 0) { ?>
                                            <div class="clearfix"></div>
                                        <?php }
                                        $j++; ?>
                                        <?php
                                        $i++;
                                    } ?>

                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rbody">
                <?php if ($products_content->file_price or $products_content->link_catalogue or $products_content->file_driver or $products_content->link_driver or $products_content->teamview == 1 && !$config['teamview']) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Download tài liệu") ?></a>
                    </div>
                <?php } ?>
                <div class="taituychon">
                    <!-- tải báo giá -->
                    <?php if ($products_content->file_price or $products_content->link_catalogue) { ?>
                        <a class="mo mot" href="" type="button" data-toggle="modal"
                           data-target="#myModalbaogia"><?php echo FSText::_("Tải báo giá") ?></a>
                        <!-- <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModaldownload">Download</a> -->
                        <div class="modal fade" id="myModalbaogia" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Tải báo giá") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact10"
                                                  action="#">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name10"
                                                               name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="job"
                                                               name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="add"
                                                               name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city10">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email10"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone10"
                                                               name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha10" value="" name="txtCaptcha" size="5" required/>
                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img id="imgCaptcha" class="fl-left"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)" title="GỬI"
                                                           class="btn btn-info send"
                                                           id="btnn10"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Tải báo giá'/>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='return'
                                                value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- tải khóa cứng -->
                    <?php if ($products_content->file_driver or $products_content->link_driver) { ?>
                        <a class="mo mot" href="" type="button" data-toggle="modal"
                           data-target="#myModaldriver"><?php echo FSText::_("Tải Driver khóa cứng") ?></a>
                        <!-- <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModaldownload">Download</a> -->
                        <div class="modal fade" id="myModaldriver" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Tải driver khóa cứng") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact11"
                                                  action="#">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name11"
                                                               name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="job"
                                                               name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="add"
                                                               name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city11">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email11"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone11"
                                                               name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>* ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="note"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha11" value="" name="txtCaptcha" size="5" required/>
                                                    <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img id="imgCaptcha" class="fl-left"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn')?></p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)" title="GỬI"
                                                           class="btn btn-info send"
                                                           id="btnn11"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Tải driver khóa cứng'/>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='return'
                                                       value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    //                    var_dump($products_content);
                    if ($products_content->teamview == 1) {
                        ?>
                        <a class="mo mot"
                           href="<?php echo $config['teamview']; ?>"><?php echo FSText::_("Phần mềm hỗ trợ từ xa Teamview") ?></a>
                    <?php } ?>
                </div>
                <?php
                $lienhe = $model->getlienhe($products_content->id);
                if ($lienhe) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kd = $model->getlienhe_kd($products_content->id);
                if ($lienhe_kd) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh") ?></a>
                    </div>
                    <?php

                    foreach ($lienhe_kd as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kt = $model->getlienhe_kt($products_content->id);
                if ($lienhe_kt) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ hỗ trợ kỹ thuật") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe_kt as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kdmb = $model->getlienhe_kdmb($products_content->id);
                if ($lienhe_kdmb) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh Miền Bắc") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe_kdmb as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kdmn = $model->getlienhe_kdmn($products_content->id);
                if ($lienhe_kdmn) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh Miền Nam") ?></a>
                    </div>
                    <?php

                    foreach ($lienhe_kdmn as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </div>
</section>
<?php if ($products_content->tawk_to) { ?>
    <?php echo $products_content->tawk_to ?>
<?php } ?>

