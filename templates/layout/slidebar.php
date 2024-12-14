<?php
if(!defined('_CODE')) {
    die('Access denied...');
}
?>

<div class="slidebar bg-dark position-fixed top-0 start-0" style="width: 250px; height: 100vh; padding-top: 100px">
    <ul>
        <li class="list-unstyled"><a href="?module=users&action=list" class="text-decoration-none text-white">Quản lý người dùng</a></li>
        <li class="list-unstyled"><a href="?module=categories&action=list" class="text-decoration-none text-white">Quản lý danh mục</a></li>
        <li class="list-unstyled"><a href="?module=products&action=list" class="text-decoration-none text-white">Quản lý sản phẩm</a></li>
    </ul>
</div>