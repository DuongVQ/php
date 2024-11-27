<!-- Quên mật khẩu -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Quên mật khẩu'
];

layouts('header-login', $data);

// Kiểm tra trạng thái đăng nhập
if(isLogin()) {
    redirect('?module=home&action=dashboard');
}

if(isPost()) {
    $filterAll = filter();
    
    if(!empty(trim($filterAll['email']))) {
        $email = $filterAll['email'];

        // Truy vấn CSDL
        $queryUser = oneRaw("SELECT id FROM user WHERE email = '$email'");
        if(!empty($queryUser)) {
            $userId = $queryUser['id'];

            // Tạo forgotToken
            $forgotToken = sha1(uniqid().time());
            $dataUpdate = [
                'forgotToken' => $forgotToken,
            ];

            $updateStatus = update('user', $dataUpdate, "id=$userId");
            if($updateStatus) {
                // Tạo link reset khôi phục mật khẩu
                $linkReset = _WEB_HOST.'?module=auth&action=reset&token=' . $forgotToken;

                // Gửi mail
                $subject = 'Yêu cầu khôi phục mật khẩu.';
                $content = 'Chào bạn! <br>';
                $content .= 'Chúng tôi nhận được yêu cầu khôi phục mật khẩu từ bạn. Vui lòng click vào link sau để khôi phục mật khẩu: <br>';
                $content .= $linkReset . '<br>';
                $content .= 'Trân trọng cảm ơn!';

                $sendMailForgot = sendMail($email, $subject, $content);
                if($sendMailForgot) {
                    setFlashData('smg', 'Đã gửi thông tin hướng dẫn đặt lại mật khẩu, vui lòng kiểm tra!');
                    setFlashData('smg_type', 'success');
                } else {
                    setFlashData('smg', 'Hệ thống đã xảy ra lỗi, vui lòng thử lại sau!');
                    setFlashData('smg_type', 'danger');
                }
            } else {
                setFlashData('smg', 'Hệ thống đã xảy ra lỗi, vui lòng thử lại sau!');
                setFlashData('smg_type', 'danger');
            }
        } else {
            setFlashData('smg', 'Địa chỉ email không tồn tại!');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng nhập địa chỉ email!');
        setFlashData('smg_type', 'danger');
    }

    redirect('?module=auth&action=forgot');
}

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');

?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">QUên mật khẩu</h2>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ email">
            </div>
            
            <button type="submit" class="w-100 mg-btn btn btn-primary btn-block">Gửi</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php
    layouts('footer-login');
?>

