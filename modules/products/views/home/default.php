<?php
global $tmpl, $config;
$tmpl->addStylesheet('sanpham', 'modules/products/assets/css');
$total_ = count($list);
$Itemid = 9;
$tmpl->addScript('home', 'modules/products/assets/js');
$sort = FSInput::get('order', 'all');
$return = $_SERVER['REQUEST_URI'];
$key = FSInput::get('key');
$linhvuc = FSInput::get('linhvuc');
//var_dump($linhvuc);
$hangsx = FSInput::get('hangsx');
$ungdung = FSInput::get('ungdung');
$loaisp = FSInput::get('loaisp');
$lang = FSInput::get('lang');
if ($lang == 'vi') {
    $alias_url = 'san-pham';
} else {
    $alias_url = 'products';
}
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
        <h1 class="title-module hidden">
            <span><?php echo FSText::_("cic.com.vn"); ?></span>
        </h1>
        <div class="container">
            <h2 class="breadcrum">
                <?php echo FSText::_("Tất cả sản phẩm") ?>
            </h2>
            <div class="bbb">
                <a href="<?php if ($lang == 'vi') {
                    echo URL_ROOT;
                } else {
                    echo URL_ROOT . 'en';
                } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
                <a href="<?php if ($lang == 'vi') {
                    echo FSRoute::_('index.php?module=products&view=home');
                } else {
                    echo FSRoute::_('index.php?module=products&view=home');
                } ?>"><?php echo FSText::_("Sản phẩm") ?> </a>
                <?php if ($linhvuc) { ?>
                    <a href=""><?php echo '>'.$bcr_lv->name ?> </a>
                <?php } ?>
            </div>
        </div>
        <div class="container noidung">
            <div class="list gach">
                <p><?php echo FSText::_("Tìm kiếm sản phẩm") ?></p>
            </div>
            <div class="stt gach" id="gach1" data-wat-link="true" data-wat-val="a-z list" data-wat-loc="content">
                <p><?php echo FSText::_("Xem danh sách từ A-Z") ?></p>
            </div>
            <div class="replay gach">
                <a href="<?php echo URL_ROOT . $alias_url ?>.html"><?php echo FSText::_("Thiết lập lại") ?></a>
            </div>
            <div class="row cot">
                <div class="col-xs-12 col-sm-12 col-md-3 hang hang1">

                    <input value="<?php echo @$key; ?>" data-url="<?php echo URL_ROOT ?>"
                           data-loaisp="<?php echo $loaisp; ?>"
                           data-hangsx="<?php echo $hangsx; ?>" data-linhvuc="<?php echo $linhvuc; ?>"
                           data-ungdung="<?php echo $ungdung; ?>" data-lang="<?php echo $alias_url; ?>" type="text"
                           class="form-control ipput1" id="input2"
                           name=""
                           placeholder="<?php echo FSText::_('Nhập từ khóa') ?>...">
                    <a href="javascrip:void(0)" class="btn_search">
                        <img src="images/logos/search2.png" alt="tìm kiếm">
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 hang">
                    <div class="row cot">

                        <div class="col-xs-12 col-sm-6 col-md-3 hang hang1">
                            <select class="form-control" name="forma" onchange="location = this.value;">
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=" . $ungdung;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }
                                $url = ltrim($url_lv, '&');
                                ?>
                                <option value="<?php echo URL_ROOT . $alias_url ?>.html?<?php echo $url; ?>"><?php echo FSText::_('Lọc theo lĩnh vực'); ?>
                                </option>
                                <?php
                                //                            echo 1;die;
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=" . $ungdung;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }

                                foreach ($result_cat as $item) {

                                    if ($item->alias == $linhvuc) {
                                        $a = 'selected';
                                    } else {
                                        $a = '';
                                    }
                                    ?>
                                    <option value="<?php echo URL_ROOT . $alias_url ?>.html?linhvuc=<?php echo $item->alias . $url_lv; ?>" <?php echo $a; ?>><?php echo $item->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 hang hang1">

                            <select class="form-control" name="forma" onchange="location = this.value;">
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=$linhvuc";
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=" . $ungdung;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }
                                $url = ltrim($url_lv, '&');
                                ?>
                                <option value="<?php echo URL_ROOT . $alias_url ?>.html?<?php echo $url; ?>"><?php echo FSText::_('Lọc theo hãng sản xuất'); ?>
                                </option>
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=$linhvuc";
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=" . $ungdung;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }
                                foreach ($products_manufactories as $item) {
                                    if ($item->alias == $hangsx) {
                                        $a = 'selected';
                                    } else {
                                        $a = '';
                                    }
                                    ?>
                                    <option value="<?php echo URL_ROOT . $alias_url ?>.html?hangsx=<?php echo $item->alias . $url_lv; ?>" <?php echo $a; ?>><?php echo $item->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 hang hang1">
                            <select class="form-control" name="forma" onchange="location = this.value;">
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=" . $linhvuc;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }
                                $url = ltrim($url_lv, '&');
                                ?>
                                <option value="<?php echo URL_ROOT . $alias_url ?>.html?<?php echo $url; ?>"><?php echo FSText::_('Lọc theo ứng dụng'); ?>
                                </option>
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=" . $linhvuc;
                                }
                                if ($loaisp) {
                                    $url_lv .= "&loaisp=$loaisp";
                                }
                                foreach ($result_app as $item) {
                                    if ($item->alias == $ungdung) {
                                        $a = 'selected';
                                    } else {
                                        $a = '';
                                    }

                                    ?>
                                    <option value="<?php echo URL_ROOT . $alias_url ?>.html?ungdung=<?php echo $item->alias . $url_lv; ?>" <?php echo $a; ?>><?php echo $item->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3 hang hang1">
                            <select class="form-control" name="forma" onchange="location = this.value;">
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=" . $linhvuc;
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=$ungdung";
                                }
                                $url = ltrim($url_lv, '&');
                                ?>
                                <option value="<?php echo URL_ROOT . $alias_url ?>.html?<?php echo $url; ?>"><?php echo FSText::_('Loại sản phẩm'); ?>
                                </option>
                                <?php
                                $url_lv = "";
                                if ($key) {
                                    $url_lv .= "&key=$key";
                                }
                                if ($hangsx) {
                                    $url_lv .= "&hangsx=$hangsx";
                                }
                                if ($linhvuc) {
                                    $url_lv .= "&linhvuc=" . $linhvuc;
                                }
                                if ($ungdung) {
                                    $url_lv .= "&ungdung=$ungdung";
                                }
                                foreach ($result_types as $item) {
                                    if ($item->alias == $loaisp) {
                                        $a = 'selected';
                                    } else {
                                        $a = '';
                                    }
                                    ?>
                                    <option value="<?php echo URL_ROOT . $alias_url ?>.html?loaisp=<?php echo $item->alias . $url_lv; ?>" <?php echo $a; ?>><?php echo $item->name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($products_hot) { ?>
            <div class="container sanpham">
                <h3 class="tieude"><?php echo FSText::_("Sản phẩm nổi bật") ?></h3>
            </div>
            <div class="container danhmuc">
                <div class="row">
                    <?php
                    // var_dump($list);
                    $i = 1;
                    $j = 1;
                    foreach ($products_hot

                             as $item) {
                        $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                        $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                        ?>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="dobong">
                                <div class="khung">
                                    <a class="dpll" href="<?php if ($item->landing_page) {
                                        echo $item->landing_page;
                                    } else {
                                        echo $link;
                                    } ?>" target="<?php if ($item->landing_page) {
                                        echo '_blank';
                                    } ?>">
                                        <img class="sp" src="<?php echo $image_resized; ?>"
                                             alt="<?php echo $item->name ?>">
                                        <img class="logo1" src="<?php echo $item->icon ?>"
                                             alt="<?php echo $item->name ?>">
                                        <p class="phanmem" href="<?php echo $link; ?>"
                                           title="<?php echo $item->name ?>"><?php echo getWord(6, $item->name); ?></p>
                                        <p class="thuoctinh"><?php echo getWord(15, $item->summary); ?></p>
                                        <p
                                                class="abc fabc<?php echo $item->id; ?>"><?php echo FSText::_("chi tiết sản
                                    phẩm") ?></p>
                                    </a>
                                </div>
                                <div class="chitiet">
                                    <div class="xemthem">
                                        <p onclick="xemthem(<?php echo $item->id; ?>)"
                                           class="ab fab<?php echo $item->id; ?>">
                                            <?php echo FSText::_("XEM THÊM") ?></p>
                                    </div>
                                    <div class="hienthi">
                                        <div class="gia fgia<?php echo $item->id; ?>">
                                            <p><b><?php echo FSText::_("Giá") ?>: </b><span
                                                        class="red"> <?php if ($item->price) {
                                                        echo $item->price;
                                                    } else {
                                                        echo 'Liên hệ';
                                                    } ?></span></p>
                                            <div class="tuychon clearfix">
                                                <div class="col-md-4  col-sm-4 col-xs-4 lienhe">
                                                    <a href="" type="button" class="btn btn1 btn-info"
                                                       data-toggle="modal"
                                                       data-target="#myModal<?php echo $i; ?>"><?php echo FSText::_("Liên hệ") ?></a>
                                                    <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                                        <div class="modal-dialog size">
                                                            <div class="modal-content size1">
                                                                <div class="header-modal">
                                                                    <div class="modal-header row">
                                                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                                                            <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                                                        </div>
                                                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal">&times;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              name="contact_hot<?php echo $item->id; ?>"
                                                                              id="contact_hot<?php echo $item->id; ?>"
                                                                              action="index.php?module=products&view=product&task=save
                                                                        ">
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="name_hot-->
                                                                                <?php //echo $item->id; ?><!--"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">--><?php //echo FSText::_("Họ tên") ?>
                                                                                <!--                                                                                *</label>-->
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="name_hot<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="job"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">-->
                                                                                <?php //echo FSText::_("Đơn vị công tác") ?><!--</label>-->
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="job"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="add"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">-->
                                                                                <?php //echo FSText::_("Địa chỉ") ?><!-- </label>-->
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="add"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="city_hot-->
                                                                                <?php //echo $item->id; ?><!--"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">--><?php //echo FSText::_("Tỉnh thành") ?>
                                                                                <!--                                                                                * </label>-->
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            id="city_hot<?php echo $item->id; ?>">
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
                                                                                <!--                                                                            <label for="email_hot-->
                                                                                <?php //echo $item->id; ?><!--"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">--><?php //echo FSText::_("Email") ?>
                                                                                <!--                                                                                * </label>-->
                                                                                <div class="col-sm-12">
                                                                                    <input type="email"
                                                                                           class="form-control"
                                                                                           id="email_hot<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="phone_hot-->
                                                                                <?php //echo $item->id; ?><!--"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">--><?php //echo FSText::_("Điện thoại di động") ?>
                                                                                <!--                                                                                * </label>-->
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phone_hot<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <!--                                                                            <label for="note"-->
                                                                                <!--                                                                                   class="col-sm-3 control-label">Ghi-->
                                                                                <!--                                                                                chú</label>-->
                                                                                <div class="col-sm-12">
                                                                            <textarea rows="4" class="form-control"
                                                                                      name='message'
                                                                                      id="note"
                                                                                      placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
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
                                                                            <div class="form-group md_ft">
                                                                                <div class="col-md-8 col-sm-12 notemd">
                                                                                    <p class="note12">*<?php echo FSText::_('Vui lòng điền
                                                                                        đúng thông tin, chúng tôi sẽ
                                                                                        liên hệ qua email của bạn') ?></p>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 sbm">
                                                                                    <a href="javascript:void(0)"
                                                                                       title="GỬI"
                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                       data_type="hot"
                                                                                       class="btn btn-info send"
                                                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name='id'
                                                                                   value='<?php echo $item->id; ?>'/>
                                                                            <input type="hidden" name='alias'
                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                            <input type="hidden" name='products_name'
                                                                                   value='<?php echo $item->name; ?>'/>
                                                                            <input type="hidden" name='type'
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

                                                    <div class="col-md-4 col-sm-4 col-xs-4 lienhe">
                                                        <!-- <button type="button" class="btn btn-success">Download</button> -->
                                                        <!-- <button type="button" class="btn btn-info ">Liên hệ</button> -->
                                                        <a href="" type="button" class="btn btn1 btn-success "
                                                           data-toggle="modal"
                                                           data-target="#myModaldownload<?php echo $i; ?>"><?php echo FSText::_("Download") ?></a>
                                                        <div class="modal fade" id="myModaldownload<?php echo $i; ?>"
                                                             role="dialog">
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
                                                                            <form class="form-horizontal" role="form"
                                                                                  method="post"
                                                                                  name="download_hot<?php echo $item->id ?>"
                                                                                  id="download_hot<?php echo $item->id ?>"
                                                                                  action="index.php?module=products&view=product&task=save">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="namedl_hot<?php echo $item->id ?>"
                                                                                               name="name"
                                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="job"
                                                                                               name="company"
                                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="add"
                                                                                               name="address"
                                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='city'
                                                                                                id="citydl_hot<?php echo $item->id; ?>">
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
                                                                                        <input type="email"
                                                                                               class="form-control"
                                                                                               id="emaildl_hot<?php echo $item->id; ?>"
                                                                                               name="email"
                                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="tel"
                                                                                               class="form-control"
                                                                                               id="phonedl_hot<?php echo $item->id; ?>"
                                                                                               name="phone"
                                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='version'
                                                                                                id="versiondl_hot<?php echo $item->id; ?>">
                                                                                            <option value="0"><?php echo FSText::_("Chọn phiên bản") ?>
                                                                                                *
                                                                                            </option>
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
                                                                                    <div class="col-sm-12">
                                                                            <textarea rows="4" class="form-control"
                                                                                      name='message'
                                                                                      id="note"
                                                                                      placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
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
                                                                                <div class="form-group md_ft">
                                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                                        <p class="note12">*Vui lòng điền
                                                                                            đúng thông tin, chúng tôi sẽ
                                                                                            liên hệ qua email của
                                                                                            bạn</p>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                                        <a href="javascript:void(0)"
                                                                                           title="GỬI"
                                                                                           data_id="<?php echo $item->id; ?>"
                                                                                           data_type="hot"
                                                                                           class="btn btn-info send"
                                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name='id'
                                                                                       value='<?php echo $item->id; ?>'/>
                                                                                <input type="hidden" name='alias'
                                                                                       value='<?php echo $item->alias; ?>'/>
                                                                                <input type="hidden"
                                                                                       name='products_name'
                                                                                       value='<?php echo $item->name; ?>'/>
                                                                                <input type="hidden" name='type'
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
                                                <div class="col-md-4  col-sm-4 col-xs-4 lienhe">
                                                    <!-- <button type="button" class="btn btn-warning">Đăng ký mua</button> -->
                                                    <a href="" type="button" class="btn btn1 btn-warning"
                                                       data-toggle="modal"
                                                       data-target="#myModalmua<?php echo $i; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                                                    <div class="modal fade" id="myModalmua<?php echo $i; ?>"
                                                         role="dialog">
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
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              id="dangky_hot<?php echo $item->id; ?>"
                                                                              action="index.php?module=products&view=product&task=save">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="namedk_hot<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="job"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="add"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            id="citydk_hot<?php echo $item->id; ?>">
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
                                                                                    <input type="email"
                                                                                           class="form-control"
                                                                                           id="emaildk_hot<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phonedk_hot<?php echo $item->id; ?>"
                                                                                           name="phone"
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
                                                                                       type="text" id="txtCaptchadk_hot<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                                   class="code-view fl-left">
                                                                                    <img id="imgCaptcha" class="fl-left"
                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                                </a>
                                                                            </div>
                                                                            <div class="form-group md_ft">
                                                                                <div class="col-md-8 col-sm-12 notemd">
                                                                                    <p class="note12">*Vui lòng điền
                                                                                        đúng thông tin, chúng tôi sẽ
                                                                                        liên hệ qua email của bạn</p>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 sbm">
                                                                                    <a href="javascript:void(0)"
                                                                                       title="GỬI"
                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                       data_type="hot"
                                                                                       class="btn btn-info send"
                                                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name='id'
                                                                                   value='<?php echo $item->id; ?>'/>
                                                                            <input type="hidden" name='alias'
                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                            <input type="hidden" name='products_name'
                                                                                   value='<?php echo $item->name; ?>'/>
                                                                            <input type="hidden" name='type'
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
                                                <p onclick="thugon(<?php echo $item->id; ?>)"><?php echo FSText::_("THU GỌN") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function xemthem(i) {
                                        $(".fgia" + i).slideDown();
                                        $(".fabc" + i).slideDown();
                                        $(".xemthem .fab" + i).slideUp();
                                    }

                                    function thugon(i) {
                                        $(".danhmuc .hienthi .fgia" + i).slideUp();
                                        $(".fabc" + i).slideUp();
                                        $(".xemthem .fab" + i).slideDown();
                                    }
                                </script>
                            </div>
                        </div>
                        <?php if ($j % 3 == 0) { ?>
                            <div class="clearfix"></div>
                        <?php }
                        $j++; ?>
                        <?php
                        $i++;
                    } ?>
                </div>
            </div>
        <?php } ?>
        <div class="container sanpham">
            <h3 class="tieude"><?php echo FSText::_("Toàn bộ sản phẩm") ?></h3>
        </div>
        <div class="container danhmuc">
            <div class="row">
                <?php
                //             var_dump($products_all->landing_page);
                $i = 1000;
                $j = 1;
                foreach ($products_all as $item) {
                    $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                    $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="dobong">
                            <div class="khung all_1">
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
                                    <img class="logo1" src="<?php echo $item->icon ?>" alt="<?php echo $item->name ?>">
                                    <p class="phanmem"
                                       title="<?php echo $item->name ?>"><?php echo getWord(5, $item->name); ?></p>
                                    <p class="thuoctinh thuoctinhall fthuoctinh<?php echo $item->id . 'al'; ?>"><?php echo getWord(17, $item->summary); ?></p>
                                    <p class="abc fabc<?php echo $item->id . 'al'; ?>"> <?php echo FSText::_("chi tiết sản phẩm") ?></p>
                                </a>
                            </div>
                            <div class="chitiet">
                                <div class="xemthem">
                                    <p onclick="xemthem('<?php echo $item->id . 'al'; ?>')"
                                       class="ab fab<?php echo $item->id . 'al'; ?>"><?php echo FSText::_("XEM THÊM") ?></p>
                                </div>
                                <div class="hienthi">
                                    <div class="gia fgia<?php echo $item->id . 'al'; ?>">
                                        <p><b>Giá: </b><span class="red"><?php if ($item->price) {
                                                    echo $item->price;
                                                } else {
                                                    echo 'Liên hệ';
                                                } ?></span>
                                        </p>
                                        <div class="tuychon clearfix">

                                            <div class="col-md-4 col-sm-4 col-xs-4 lienhe">
                                                <!-- <button type="button" class="btn btn-info ">Liên hệ</button> -->
                                                <a href="" type="button" class="btn btn1 btn-info" data-toggle="modal"
                                                   data-target="#myModal<?php echo $i; ?>"><?php echo FSText::_("Liên hệ") ?></a>
                                                <div class="modal fade" id="myModal<?php echo $i; ?>" role="dialog">
                                                    <div class="modal-dialog size">
                                                        <div class="modal-content size1">
                                                            <div class="header-modal">
                                                                <div class="modal-header row">
                                                                    <div class="col-xs-10 col-sm-10 col-md-9">
                                                                        <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                                                    </div>
                                                                    <div class="col-xs-2 col-sm-2 col-md-3">
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">&times;
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="form-horizontal" role="form"
                                                                          method="post"
                                                                          id="contact_nb<?php echo $item->id; ?>"
                                                                          action="index.php?module=products&view=product&task=save">
                                                                        <div class="form-group">
                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control"
                                                                                       id="name_nb<?php echo $item->id; ?>"
                                                                                       name="name"
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
                                                                                        id="city_nb<?php echo $item->id; ?>">
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
                                                                                       id="email_nb<?php echo $item->id; ?>"
                                                                                       name="email"
                                                                                       placeholder="<?php echo FSText::_("Email") ?>*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-sm-12">
                                                                                <input type="tel" class="form-control"
                                                                                       id="phone_nb<?php echo $item->id; ?>"
                                                                                       name="phone"
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
                                                                                   type="text" id="txtCaptcha_nb<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                            <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                               class="code-view fl-left">
                                                                                <img id="imgCaptcha" class="fl-left"
                                                                                     src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                <!--                    <i class="fa fa-sync"></i>-->
                                                                                <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                            </a>
                                                                        </div>
                                                                        <div class="form-group md_ft">
                                                                            <div class="col-md-8 col-sm-12 notemd">
                                                                                <p class="note12">*Vui lòng điền đúng
                                                                                    thông tin, chúng tôi sẽ liên hệ qua
                                                                                    email của bạn</p>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-12 sbm">
                                                                                <a href="javascript:void(0)" title="GỬI"
                                                                                   data_id="<?php echo $item->id; ?>"
                                                                                   data_type="nb"
                                                                                   class="btn btn-info send"
                                                                                   id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name='id'
                                                                               value='<?php echo $item->id; ?>'/>
                                                                        <input type="hidden" name='alias'
                                                                               value='<?php echo $item->alias; ?>'/>
                                                                        <input type="hidden" name='products_name'
                                                                               value='<?php echo $item->name; ?>'/>
                                                                        <input type="hidden" name='type'
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
                                                    <a href="" type="button" class="btn btn1 btn-success "
                                                       data-toggle="modal"
                                                       data-target="#myModaldownload<?php echo $i; ?>"><?php echo FSText::_("Download") ?></a>
                                                    <div class="modal fade" id="myModaldownload<?php echo $i; ?>"
                                                         role="dialog">
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
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              id="download_all<?php echo $item->id; ?>"
                                                                              action="index.php?module=products&view=product&task=save">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="namedl_all<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="job"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="add"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            id="citydl_all<?php echo $item->id; ?>">
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
                                                                                    <input type="email"
                                                                                           class="form-control"
                                                                                           id="emaildl_all<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phonedl_all<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='version'
                                                                                            id="versiondl_all<?php echo $item->id; ?>">
                                                                                        <option value="0"><?php echo FSText::_("Chọn phiên bản") ?>
                                                                                            *
                                                                                        </option>
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
                                                                                <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="check_capcha">
                                                                                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                       type="text" id="txtCaptchadl_all<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                                   class="code-view fl-left">
                                                                                    <img id="imgCaptcha" class="fl-left"
                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                                </a>
                                                                            </div>
                                                                            <div class="form-group md_ft">
                                                                                <div class="col-md-8 col-sm-12 notemd">
                                                                                    <p class="note12">*Vui lòng điền
                                                                                        đúng thông tin, chúng tôi sẽ
                                                                                        liên hệ qua email của bạn</p>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 sbm">
                                                                                    <a href="javascript:void(0)"
                                                                                       title="GỬI"
                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                       data_type="all"
                                                                                       class="btn btn-info send"
                                                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name='id'
                                                                                   value='<?php echo $item->id; ?>'/>
                                                                            <input type="hidden" name='alias'
                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                            <input type="hidden" name='products_name'
                                                                                   value='<?php echo $item->name; ?>'/>
                                                                            <input type="hidden" name='type'
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
                                                <a href="" type="button" class="btn btn1 btn-warning"
                                                   data-toggle="modal"
                                                   data-target="#myModalmua<?php echo $i; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                                                <div class="modal fade" id="myModalmua<?php echo $i; ?>" role="dialog">
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
                                                                    <form class="form-horizontal" role="form"
                                                                          method="post"
                                                                          id="dangky_nb<?php echo $item->id; ?>"
                                                                          action="index.php?module=products&view=product&task=save">
                                                                        <div class="form-group">
                                                                            <div class="col-sm-12">
                                                                                <input type="text" class="form-control"
                                                                                       id="namedk_nb<?php echo $item->id; ?>"
                                                                                       name="name"
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
                                                                                        id="citydk_nb<?php echo $item->id; ?>">
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
                                                                                       id="emaildk_nb<?php echo $item->id; ?>"
                                                                                       name="email"
                                                                                       placeholder="<?php echo FSText::_("Email") ?>*">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-sm-12">
                                                                                <input type="tel" class="form-control"
                                                                                       id="phonedk_nb<?php echo $item->id; ?>"
                                                                                       name="phone"
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
                                                                                   type="text" id="txtCaptchadk_nb<?php echo $item->id; ?>" value="" name="txtCaptcha" size="5" required/>
                                                                            <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                                                                               class="code-view fl-left">
                                                                                <img id="imgCaptcha" class="fl-left"
                                                                                     src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"  alt="captcha"/>
                                                                                <!--                    <i class="fa fa-sync"></i>-->
                                                                                <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                                                                            </a>
                                                                        </div>
                                                                        <div class="form-group md_ft">
                                                                            <div class="col-md-8 col-sm-12 notemd">
                                                                                <p class="note12">*Vui lòng điền đúng
                                                                                    thông tin, chúng tôi sẽ liên hệ qua
                                                                                    email của bạn</p>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-12 sbm">
                                                                                <a href="javascript:void(0)" title="GỬI"
                                                                                   data_id="<?php echo $item->id; ?>"
                                                                                   data_type="nb"
                                                                                   class="btn btn-info send"
                                                                                   id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name='id'
                                                                               value='<?php echo $item->id; ?>'/>
                                                                        <input type="hidden" name='alias'
                                                                               value='<?php echo $item->alias; ?>'/>
                                                                        <input type="hidden" name='products_name'
                                                                               value='<?php echo $item->name; ?>'/>
                                                                        <input type="hidden" name='type'
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
                                            <p onclick="thugon('<?php echo $item->id . 'al'; ?>')"><?php echo FSText::_("THU GỌN") ?></p>
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
                                    $(".danhmuc .hienthi .fgia" + i).slideUp();
                                    $(".fabc" + i).slideUp();
                                    $(".spp" + i).slideUp();
                                    $(".fthuoctinh" + i).slideUp();
                                    $(".xemthem .fab" + i).slideDown();
                                }
                            </script>
                        </div>
                    </div>
                    <?php if ($j % 3 == 0) { ?>
                        <div class="clearfix"></div>
                    <?php }
                    $j++; ?>
                    <?php
                    $i++;
                } ?>
            </div>
            <div class="clearfix"></div>
            <?php
            if ($pagination) {
                echo $pagination->showPagination(3);
            } ?>
        </div>
        <div class="clearfix"></div>
        <div class="a-z" data-wat-link-section="a-z list" style="height: 35px;"></div>
        <div class="container sanpham ">
            <p class="tieude"><?php echo FSText::_("Danh sách sản phẩm từ A-Z") ?></p>
        </div>
        <div class="container danhmuc">
            <div class="row">
                <?php
                foreach ($products_az as $item) {
                    $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                    ?>
                    <div class="col-xs-6 col-md-3">
                        <div class="khung1">
                            <a href="<?php echo $link; ?>" class="phanmem"><?php echo getWord(6, $item->name); ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?php echo $config['tawk_to']; ?>