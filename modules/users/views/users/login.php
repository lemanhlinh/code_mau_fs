<?php
    global $tmpl,$config;
    $tmpl->setTitle("Đăng nhập");
    $tmpl->addStylesheet("users_login", "modules/users/assets/css");
    $Itemid = FSInput::get('Itemid', 1);
    $redirect = FSInput::get('redirect');
    $username = FSInput::get('username');
    if (!$username) {
        $username = "Username";
    }
    $password = "Password";
?>





