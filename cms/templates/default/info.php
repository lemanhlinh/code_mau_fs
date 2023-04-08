<?php
	$language = $_SESSION['ad_lang'];
	$url_current  = $_SERVER['REQUEST_URI'];
	$sort_admin = $_SERVER['SCRIPT_NAME'];
	$sort_admin = str_replace('/index.php','',$sort_admin);
	$pos = strripos($sort_admin,'/');
	$sort_admin = substr($sort_admin,($pos+1));
	$url_current = substr($url_current,strlen(URL_ROOT_REDUCE));
	$url_current =  trim(preg_replace('/[&?]ad_lang=[a-z]+/i', '', $url_current));
//						echo $url_current;
	function create_url_for_lang($url,$lang,$sort_admin){
		if(!$url)
			return URL_ROOT.$sort_admin.'/index.php?ad_lang='.$lang;
		if(strpos($url, 'index.php') === false)
			return URL_ROOT.$sort_admin.'/index.php?ad_lang='.$lang;
		if(substr($url,-9) == 'index.php')
			return URL_ROOT.$sort_admin.'/index.php?ad_lang='.$lang;
		if($url == 'index.php')
			return URL_ROOT.$sort_admin.'index.php?ad_lang='.$lang;
		return URL_ROOT.$url.'&ad_lang='.$lang;
	}
	//$lang_arr = array('en'=>'English','vi'=>'Viet Nam');
    $lang_arr = array('en'=>'English',
        'vi'=>'Viet Nam');
	//print_r($language);die;
//var_dump($_SESSION);
?>
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
      
        <?php if($lang_arr){ ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php echo " <img src='".URL_ROOT.$folder_admin.'/templates/default/images/'.$language.".jpg'  />";?>  
                <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <?php 
                    foreach ($lang_arr as $key => $value){
            			$class = $key;
            			$class .= ($key == $language)?' current ':'';
            			echo " <li>
                                <a href='". create_url_for_lang($url_current,$key,$sort_admin)."' class='".$class."' title='".$value."' >
                                    <img src='".URL_ROOT.$folder_admin.'/templates/default/images/'.$key.".jpg' alt='".$value."' />
                                    ".$value."
                                </a>
                              </li>";
            		}
                ?>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <?php } ?>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo URL_ROOT.'images/favicon.jpg'; ?>" class="user-image" alt="User Image" />
            <span class="hidden-xs"><?php echo !empty($_SESSION['ad_username'])? $_SESSION['ad_username']:'user' ?></span>
            <i class="fa fa-angle-down pull-right" style="margin-top: 4px;"></i>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
                <p>
                    <strong><?php echo FSText::_('Tên miền'); ?>: </strong>
                    <a target="_blank" href="<?php echo 'http://'.$_SERVER['HTTP_HOST'];?>"><?php echo $_SERVER['SERVER_NAME'];?></a>
                </p>
    
                <p>
                    <strong><?php echo FSText::_('IP Host:'); ?> </strong>
                    <?php echo $_SERVER['REMOTE_ADDR'];?>
                </p>
    
                <p>
                    <strong><?php echo FSText::_('Tài khoản đăng nhập:'); ?> </strong>
                    <?php echo $_SESSION['ad_username']; ?>
                </p>
                
                <p>
                    <strong><?php echo FSText::_('Email:'); ?> </strong>
                    <?php echo $_SESSION['ad_useremail']; ?>
                </p>
            </li>
    
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a href="index.php?module=users&view=log&task=logout" class="btn btn-default btn-flat"><?php echo FSText::_('Thoát') ?></a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
</nav>
                    