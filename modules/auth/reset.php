<!-- Lấy lại mật khẩu -->
<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

layouts('header-login');

$token = filter()['token'];
if (!empty($token)) {
    // Truy vấn CSDL kiểm tra token
    $tokenQuery = oneRaw("SELECT id, fullname, email FROM user WHERE forgotToken = '$token'");
    if (!empty($tokenQuery)) {
        $userId = $tokenQuery['id'];
        
        if (isPost()) {
            $filterAll = filter();
            $errors = [];

            // Validate password
            if (empty($filterAll['password'])) {
                $errors['password']['required'] = 'Hãy nhập mật khẩu!';
            } else {
                if (strlen($filterAll['password']) < 8) {
                    $errors['password']['min'] = 'Mật khẩu ít nhất có 8 ký tự!';
                }
            }

            // Validate password_confirm
            if (empty($filterAll['password_confirm'])) {
                $errors['password_confirm']['required'] = 'Hãy nhập lại mật khẩu!';
            } else {
                if ($filterAll['password_confirm'] != $filterAll['password']) {
                    $errors['password_confirm']['match'] = 'Mật khẩu nhập lại phải trùng khớp!';
                }
            }

            // Xử lý dữ liệu
            if (empty($errors)) {
                $passwordHash = password_hash($filterAll['password'], PASSWORD_DEFAULT);
                $dataUpdate = [
                    'password' => $passwordHash,
                    'forgotToken' => null,
                    'update_at' => date('Y-m-d H:i:s'),
                ];

                $updateStaus = update('user', $dataUpdate, "id = '$userId'");
                if($updateStaus) {
                    setFlashData('smg', 'Đổi mật khẩu thành công!');
                    setFlashData('smg_type', 'success');
                    redirect('?module=auth&action=login');
                } else {
                    setFlashData('smg', 'Hệ thống đã xảy ra lỗi, vui lòng thử lại sau!');
                    setFlashData('smg_type', 'danger');
                }
            } else {
                setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
                setFlashData('smg_type', 'danger');
                setFlashData('errors', $errors);
                redirect('?module=auth&action=reset&token=' . $token);
            }
        }

        $smg = getFlashData('smg');
        $smg_type = getFlashData('smg_type');
        $errors = getFlashData('errors');
?>
        <div class="row">
            <div class="col-4" style="margin: 50px auto;">
                <h2 class="text-center text-uppercase">Đặt lại mật khẩu</h2>
                <?php
                if (!empty($smg)) {
                    getSmg($smg, $smg_type);
                }
                ?>
                <form action="" method="post">
                    <div class="form-group mg-form">
                        <label for="password">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                        <?php echo form_error('password', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="password_confirm">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu">
                        <?php echo form_error('password_confirm', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <input type="hidden" name="token" value="<?php echo $token; ?>">
                    <button type="submit" class="w-100 mg-btn btn btn-primary btn-block">Đặt lại</button>
                    <hr>
                    <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
                </form>
            </div>
        </div>
<?php

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