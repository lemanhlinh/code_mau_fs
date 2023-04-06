<?php
global $config, $tmpl ;
$tmpl->addStylesheet("default", "blocks/manager_account/assets/css");
$tmpl->addScript("education", "blocks/manager_account/assets/js");
$task = FSInput::get('task');
$module = FSInput::get('module');
$view = FSInput::get('view');
$affix = '';
$module == 'contents' ? $affix = 'data-spy="affix" data-offset-top="200"':'';
?>
<?php if (!empty($_COOKIE['user_id']) || !empty($_SESSION['user_id'])) { ?>
    <div class='users_tabs' <?php echo $affix ?> >
        <p class="title_menu_info"><i class="fa fa-gear" style="padding-right: 10px;"></i>Quản lý tài khoản</p>
        <ul>
            <li  class="<?php if ($task == 'user_info') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=users&task=user_info') ?>"><i class="fa fa-user"></i>Thông tin tài khoản</a></li>
            <?php if($user->userInfo->type ==2){?>
                  <li   class="<?php if ($task == 'register_user') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=users&task=register_user') ?>"><i class="fa fa-user-plus"></i>Tạo mới User</a></li>
            <?php }?>
            <?php if ($user->userInfo->type != 3) { ?>
              
                <li   class="<?php if ($task == 'list_user') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=users&task=list_user') ?>"><i class="fa fa-users"></i>Danh sách user</a></li>
                <li  class="<?php if ($task == 'history_learning') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=users&task=history_learning') ?>"><i class="fa fa-graduation-cap"></i>Thống kê đào tạo</a></li>
                <li  class="<?php if ($module=='training' && $view == 'payment_status') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=training&view=payment_status') ?>"><i class="fa fa-history"></i>Trạng thái thanh toán</a></li>
            <?php } ?>

            <li  class="<?php if ($task == 'changepass') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=users&task=changepass') ?>" ><i class="fa fa-key"></i>Thay mật khẩu</a></li>
            <?php  if($user->userInfo->type !=1){ ?>
                <li  class="<?php if ($module == 'training' && $view=='cat') echo 'acti' ?>"><a href="<?php echo FSRoute::_('index.php?module=training&view=cat&Itemid=14') ?>"><i class="fa fa-pencil-square-o"></i>Đăng ký học</a></li>
           <?php } ?>
            
            <li><a href="<?php echo FSRoute::_('index.php?module=users&task=logout')?>"><i class="fa fa-power-off"></i>Thoát</a></li>
        </ul>
    </div>
<?php } ?>
