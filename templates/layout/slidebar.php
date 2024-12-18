<?php
if (!defined('_CODE')) {
    die('Access denied...');
}
?>

<style>
    .slidebar {
        background-color: #383A3C;
        box-shadow: 0 0 10px #00000036;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    ul li {
        padding: 15px 0px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    ul li::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%; 
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
        transition: left 0.3s ease-in-out; 
    }
    ul li:hover::before {
        left: 0; 
    }
    ul li:hover {
        background-color: transparent; 
    }
    .list-unstyled a {
        color:rgb(197, 206, 215); 
        font-size: 18px;
        font-weight: 600;
        margin-left: 20px;
        text-decoration: none;
        position: relative; 
        z-index: 1;
        transition: color 0.3s ease-in-out; 
    }
    ul li:hover .list-unstyled a {
        color: white; 
    }
</style>


<div class="slidebar position-fixed top-0 start-0" style="width: 250px; height: 100vh; padding-top: 100px">
    <ul>
        <li class="list-unstyled">
            <a href="?module=users&action=list">
                <i class="fa-solid fa-id-card"></i>
                Quản lý người dùng
            </a>
        </li>
        <li class="list-unstyled">
            <a href="?module=categories&action=list">
                <i class="fa-solid fa-tags"></i>
                Quản lý danh mục
            </a>
        </li>
        <li class="list-unstyled">
            <a href="?module=products&action=list">
                <i class="fa-solid fa-box-archive"></i>
                Quản lý sản phẩm
            </a>
        </li>
    </ul>
</div>