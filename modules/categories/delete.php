<!-- Xóa nhóm hàng -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])) {
    $categoryId = $filterAll['id'];

    // Kiểm tra id của user tồn tại không
    $categoryDetail = getRows("SELECT * FROM categories WHERE id='$categoryId'");
    if($categoryDetail > 0) {
        // Xóa nhóm hàng
        $deleteCate = delete('categories', "id = '$categoryId'");
        if($deleteCate) {
            setFlashData('smg', 'Đã xóa nhóm hàng thành công!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi, hãy thử lại sau!');
            setFlashData('smg_type', 'danger');
        }
        // Thực hiện xóa
        // $deleteToken = delete('loginToken', "user_Id='$categoryId'");
        // if($deleteToken) {
        // }
    } else {
        setFlashData('smg', 'Nhóm hàng không tồn tại!');
        setFlashData('smg_type', 'danger');
    }
    
} else {
    setFlashData('smg', 'Liên kết không tồn tại!');
    setFlashData('smg_type', 'danger');
}

redirect('?module=categories&action=list');