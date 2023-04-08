<?php 


function login(){
	$db = new FS_PDO();
    
	$password = md5(FSInput::get('password'));
	$username = FSInput::get2('username');
    $username = $db->escape_string($username);
	$query = 'SELECT u.id, u.username, u.email
                FROM fs_users AS u
                WHERE published = 1 AND  u.username = \''.$username.'\' AND u.password = \''.$password.'\'
                LIMIT 1';
                
	$user = $db->getObject($query);
	if(!$user){
		return false;
	}
	$_SESSION['ad_logged']     = 1;
	$_SESSION['ad_userid']     = $user->id;
//    $_SESSION['ad_groupid']    = $user->groupid;
 
    $_SESSION['ad_username']   = $user->username;
    $_SESSION['ad_useremail']  = $user->email;
    
	return true;
}

session_start();
if(isset($_SESSION['ad_logged']) && $_SESSION['ad_logged']==1)
    header("Location: index.php");
    
require_once("../includes/config.php");
require_once ("includes/defines.php");
require_once('../libraries/database/pdo.php');
require_once("../libraries/fsinput.php");

require_once ("../libraries/fstext.php");

require_once ("../includes/functions.php");

$action		= FSInput::get('action');
if($action == "login"){
	if(!login()){
        echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.FSText::_('Thông báo').'</h4>
                '.FSText::_('Thông tin đăng nhập không đúng hoặc tài khoản của bạn chưa được kích hoạt!').'
              </div>';
	}	
	else{
		header( "Location: index.php" );
	}
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo FSText::_('đăng nhập | Finalstyle'); ?></title>
  
  <meta name="copyright" content="© 2013 FinalStyle, Thiết kế website Phong Cách Số" /> 
  <meta name="robots" content="noindex, nofollow"/>
  
  <link type='image/x-icon' href='<?php echo URL_ROOT; ?>images/favicon.ico' rel='icon' />  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>libraries/bower_components/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>libraries/bower_components/font-awesome/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>libraries/bower_components/Ionicons/css/ionicons.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>libraries/dist/css/AdminLTE.min.css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL_ROOT; ?>libraries/plugins/iCheck/square/blue.css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Admin</b> Finalstyle
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"><?php echo FSText::_('Đăng nhập'); ?></p>

      <form action="login.php" method="post" name="frm_login" id="frm_login">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="username" name="username" id="username" />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo FSText::_('Đăng nhập'); ?></button>
          </div>
          <!-- /.col -->
          <input name="action" type="hidden" value="login"/>
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo URL_ROOT; ?>libraries/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo URL_ROOT; ?>libraries/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck 
  <script src="<?php echo URL_ROOT; ?>libraries/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script> -->
</body>

</html>

