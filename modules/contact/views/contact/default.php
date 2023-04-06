<?php
global $config, $tmpl;
$tmpl->addScript('form');
$tmpl->addScript('contact', 'modules/contact/assets/js');
$tmpl->addStylesheet('contact', 'modules/contact/assets/css');

$Itemid = FSInput::get('Itemid', 0);
//$contact_email = FSInput::get('contact_email');
//$contact_name = FSInput::get('contact_name');
//$contact_address = FSInput::get('contact_address');
//$contact_phone = FSInput::get('contact_phone');
//$contact_title = FSInput::get('contact_title');
//$message = htmlspecialchars_decode(FSInput::get('message'));
$lang = FSInput::get('lang');
$alert_info = array(
    0 => FSText::_('Nhập Từ Khóa'),
    1 => FSText::_('Bạn chưa nhập họ và tên'),
    3 => FSText::_('Bạn chưa nhập email'),
    4 => FSText::_('Email không hợp lệ'),
    5 => FSText::_('Bạn chưa nhập số điện thoại'),
    6 => FSText::_('Số điện thoại không hợp lệ'),
    7 => FSText::_('Vui lòng nhập từ'),
    8 => FSText::_('số'),
    9 => FSText::_('đến'),
    12 => FSText::_('Số điện thoại phải từ 10 kí tự trở lên'),
    13 => FSText::_('Bạn chưa nhập nội dung'),
);
?>
<style type="text/css">
    @media (max-width: 767px) {
        .banner {
            height: 350px;
            background-image: url("<?php echo URL_ROOT . $config['banner_contact'] ?>");
            background-repeat: no-repeat;
            background-position: 66% 0;
            background-size: cover;
        }
    }
</style>
<input type="hidden" id="alert_info" value='<?php echo json_encode($alert_info) ?>'/>
<div class="banner">
    <img src="<?= URL_ROOT . $config['banner_contact'] ?>" alt="<?= FSText::_('Liên hệ') ?>" class="img-responsive hidden-xs">
    <h1 data-aos="zoom-in-up"><?= FSText::_('Liên hệ') ?></h1>
</div>
<div class="contact-main row-item">
    <img src="<?= URL_ROOT . 'modules/contact/assets/images/Group 617.png' ?>" alt="<?= FSText::_('Liên hệ') ?>" class="img-responsive r_bg">

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12"  data-aos="fade-right">
                <!--             --><?php // include_once 'default_info.php'; ?>
                <h2 class="title_company"><?= FSText::_('CÔNG TY CỔ PHẦN TẬP ĐOÀN HÓA CHẤT NHỰA - PLASCHEM') ?></h2>
                <p class="address"><?= FSText::_('Tòa nhà Plaschem, 562 Nguyễn Văn Cừ, Gia Thụy, Long Biên, Hà Nội') ?></p>
                <a class="telephone"
                   href="tel:<?= str_replace(['(', ')', ' '], ['', '', ''], $config['tel']) ?>"><?= $config['tel'] ?></a>
                <a class="email" href="mailto:<?= $config['admin_email'] ?>"><?= $config['admin_email'] ?></a>
                <img src="<?= URL_ROOT . 'modules/contact/assets/images/f47ac34e867ede7aac18dc129329d642.png' ?>"
                     alt="image" style="margin: auto" class="img-responsive">
            </div>
            <div class="col-md-6 left_contact" data-aos="fade-left">
                <?php include_once 'default_from.php'; ?>
            </div>
            <div class="col-md-12 map" data-aos="zoom-in-up">
                <h3><?=FSText::_('Vị trí trên google map')?></h3>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5818420078817!2d105.88168011424567!3d21.049411192450446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a9789180a075%3A0xb711d230182bbe86!2sPlaschem%20Tower!5e0!3m2!1sen!2s!4v1624952003453!5m2!1sen!2s"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
    <!--<div class="col-xs-12 col-sm-6">
	       <?php // include_once 'default_map.php';?>
	   </div><!-- END: .map -->
</div><!-- END: .contact -->
