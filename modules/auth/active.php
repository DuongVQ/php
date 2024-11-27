<!-- Kích hoạt tài khoản -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

layouts('header-login');

$token = filter()['token'];
if(!empty($token)) {
    $tokenQuery = oneRaw("SELECT id FROM user WHERE activeToken = '$token'");
    if(!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];

        $dataUpdate = [
            'status' => 1,
            'activeToken' => null
        ];

        $updateStatus = update('user', $dataUpdate, "id=$userId");
        if($updateStatus) {
            setFlashData('smg', 'Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ!');
            setFlashData('smg', 'success');
        } else {
            setFlashData('smg', 'Kích hoạt tài khoản thất bại, vui lòng liên hệ quản trị viên!');
            setFlashData('smg', 'danger');
        }
        redirect('?module=auth&action=login');
    } else {
        getSmg('Liên kết không tồn tại', 'danger');
    }
} else {
    getSmg('Liên kết không tồn tại', 'danger');
}
?>

<?php
layouts('footer-login');
?>