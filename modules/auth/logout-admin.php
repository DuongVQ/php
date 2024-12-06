<!-- Đăng xuất -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

if(isLoginAdmin()) {
    $token = getSession('loginToken');
    delete('loginToken', "token='$token'");
    removeSesion('loginToken');
    redirect('?module=auth&action=login-admin');
}