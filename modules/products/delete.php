<!-- Xóa sản phẩm -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])) {
    $productId = $filterAll['id'];

    // Kiểm tra id của user tồn tại không
    $productDetail = getRows("SELECT * FROM products WHERE id='$productId'");
    if($productDetail > 0) {
        // Xóa nhóm hàng
        $deleteCate = delete('products', "id = '$productId'");
        if($deleteCate) {
            setFlashData('smg', 'Đã xóa nhóm hàng thành công!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi, hãy thử lại sau!');
            setFlashData('smg_type', 'danger');
        }
        // Thực hiện xóa
        // $deleteToken = delete('loginToken', "user_Id='$productId'");
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

redirect('?module=products&action=list');