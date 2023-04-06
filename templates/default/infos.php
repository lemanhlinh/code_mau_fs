<?php
	//var_dump($user);
    $userInfo = $user->userInfo;
?>
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
      
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo URL_ROOT.'images/logo_finalstyle_thiet_ke_website.jpg'; ?>" class="user-image" alt="User Image" />
            <span class="hidden-xs"><?php echo $userInfo->username; ?></span>
            <i class="fa fa-angle-down pull-right" style="margin-top: 4px;"></i>
          </a>
          <ul class="dropdown-menu">
            
            <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo FSRoute::_('index.php?module=users&task=logout&raw=1') ?>" class="btn btn-default btn-flat">
                    <?php echo FSText::_('Sign out') ?>
                    </a>
                </div>
              </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar">
            <i class="fa fa-gears"></i>
          </a>
        </li>
      </ul>
    </div>
</nav>
                    