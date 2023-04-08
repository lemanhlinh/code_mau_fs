<?php global $config; ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>CMS | <?php echo $config['site_name']? $config['site_name']:'Admin' ?></title>
  <meta name="robots" content="noindex, nofollow"/>
  
  <link type='image/x-icon' href='<?php echo URL_ROOT; ?>/images/favicon.ico' rel='icon' />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/bower_components/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/bower_components/font-awesome/css/font-awesome.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" />
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/bower_components/select2/dist/css/select2.min.css" />
  <!-- Ionicons -->
  
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/dist/css/AdminLTE.min.css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo URL_ROOT ?>libraries/dist/css/skins/_all-skins.min.css" />

  <link href="templates/default/css/styles.css" rel="stylesheet" />  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" />
  
  <script src="<?php echo URL_ROOT . 'libraries/jquery/jquery-1.12.4.min.js' ?>"></script>
  <script type="text/javascript" src="<?php echo URL_ROOT; ?>libraries/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="<?php echo URL_ROOT; ?>libraries/ckeditor/plugins/ckfinder/ckfinder.js"></script>
</head>

<body class="skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
        
      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b> <?php echo $config['site_name'] ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> <?php echo $config['site_name'] ?></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <?php include 'info.php' ?>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <?php include 'navbar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
        <?php 
            global $toolbar;
            echo $toolbar->show_head_form();
            echo $main_content; 
        ?>
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 3.0.0
      </div>
      <strong>
        <a>Author: Finalstyle</a>
        </strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
        <!-- /.tab-pane -->
      </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo URL_ROOT ?>libraries/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo URL_ROOT ?>libraries/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Select2 -->
  <script src="<?php echo URL_ROOT ?>libraries/bower_components/select2/dist/js/select2.full.min.js"></script>
  
  <script src="<?php echo URL_ROOT ?>libraries/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo URL_ROOT ?>libraries/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo URL_ROOT ?>libraries/dist/js/demo.js"></script>
  <!-- jQuery 3 -->
  <script type="text/javascript" src="templates/default/js/helper.js"></script>
</body>

</html>
