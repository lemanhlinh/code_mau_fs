<?php
    global $config,$tmpl;
?>
<style>
    body{
        background: #d2d6de;
    }
</style>
<div class="login-page row-item">
    <div class="login-box">
        <div class="login-logo">
          <b><?php echo $config['site_name'] ?></b> J.A
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg"><?php echo FSText::_('Đăng nhập'); ?></p>
        
          <form action="" method="post" name="frm_login" id="frm_login">
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
                <input type="hidden" name = "module" value = "users" />
                <input type="hidden" name = "view" value = "users" />
                <input type="hidden" name = "task" value = "login_save" />
            </div>
          </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</div>