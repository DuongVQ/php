<!-- Xóa người dùng -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])) {
    $userId = $filterAll['id'];

    // Kiểm tra id của user tồn tại không
    $userDetail = getRows("SELECT * FROM user WHERE id='$userId'");
    if($userDetail > 0) {
        // Thực hiện xóa
        $deleteToken = delete('loginToken', "user_Id='$userId'");
        if($deleteToken) {
            // Xóa user
            $deleteUser = delete('user', "id = '$userId'");
            if($deleteUser) {
                setFlashData('smg', 'Đã xóa người dùng thành công!');
                setFlashData('smg_type', 'success');
            } else {
                setFlashData('smg', 'Hệ thống đã xảy ra lỗi, hãy thử lại sau!');
                setFlashData('smg_type', 'danger');
            }
        }
    } else {
        setFlashData('smg', 'Người dùng không tồn tại!');
        setFlashData('smg_type', 'danger');
    }
    
} else {
    setFlashData('smg', 'Liên kết không tồn tại!');
    setFlashData('smg_type', 'danger');
}

redirect('?module=users&action=list');