<!-- Các hằng số của project -->
<?php
const _MODULE = 'home';
const _ACTION = 'dashboard';
const _CODE = true;

// Thiết lập host
define('_WEB_HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/manager_user');
define('_WEB_HOST_TEMPLATES', _WEB_HOST . '/templates');

// Thiết lập path
define('_WEB_PATH', __DIR__); 
define('_WEB_PATH_TEMPLATES', _WEB_PATH . '/templates'); 

// Thông tin kết nối
const _HOST = 'localhost';
const _USER = 'duongvq';
const _PASS = 'password';
const _DB = 'manager_user';