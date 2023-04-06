<?php
$return = $_SERVER['REQUEST_URI'];
// $return = base64_encode($url);
?>
<div class="contact_form row-item">
    <div class="name_form"><?=FSText::_('Form liên hệ')?></div>
    <form method="post" action="index.php?module=contact&view=contact&task=save" name="contact" class="form"
          enctype="multipart/form-data">
        <div class="form1 row">
            <div class="item1 col-md-12 col-sm-12 col-xs-12">
                <input type="text" maxlength="255" name="contact_name" id="contact_name" value="" class="form-control"
                       placeholder="<?php echo FSText::_("Họ và tên*"); ?>"/>
            </div>
            <div class="item1 col-md-12 col-sm-12 col-xs-12">
                <input type="text" maxlength="255" name="contact_company" id="contact_company" value=""
                       class="form-control" placeholder="<?php echo FSText::_("Công ty/Tổ chức"); ?>"/>
            </div>
<!--            <div class="item1 col-md-6 col-sm-6 col-xs-12">-->
<!--                <input type="text" maxlength="255" name="contact_address" id="contact_address" value=""-->
<!--                       class="form-control" placeholder="--><?php //echo FSText::_("Địa chỉ"); ?><!--" required/>-->
<!--            </div>-->
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="email" maxlength="255" name="contact_email" id="contact_email" value=""
                       class="form-control" placeholder="<?php echo FSText::_("Email*"); ?>" />
            </div>
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="tel" maxlength="255" name="contact_phone" id="contact_phone" value="" class="form-control"
                       placeholder="<?php echo FSText::_("Số điện thoại*"); ?>" />
            </div>
            <div class="item1 col-md-12 item_title">
                <input type="text" maxlength="255" name="contact_tieude" id="contact_tieude" value=""
                       class="form-control" placeholder="<?php echo FSText::_("Tiêu đề"); ?>"/>
            </div>
        </div>
        <textarea type="text" rows="6" cols="30" name='contact_message' id='message'
                  placeholder="<?php echo FSText::_("Nội dung*"); ?>"></textarea>
        <div class="sbm">
            <a href="#" class="submitbt button"><?php echo FSText::_('Gửi liên hệ'); ?></a>
        </div>
        <input type="hidden" name='return' value='<?php echo $return; ?>'/>
        <input type="hidden" name="module" value="contact"/>
        <input type="hidden" name="task" value="save"/>
        <input type="hidden" name="view" value="contact"/>
        <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
    </form>
    <!--	end FORM				-->
    <div class="clear"></div>
</div>