<!-- Đăng ký -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

if(isPost()) {
    $filterAll = filter();
    $errors = []; //mảng chứa các lỗi

    // Validate fullname
    if(empty($filterAll['fullname'])) {
        $errors['fullname']['required'] = 'Hãy nhập họ tên!';
    } else {
        if(strlen($filterAll['fullname']) < 5) {
            $errors['fullname']['min'] = 'Hãy nhập đủ họ và tên!';
        }
    }

    // Validate email
    if(empty($filterAll['email'])) {
        $errors['email']['required'] = 'Hãy nhập email!';
    } else {
        $email = $filterAll['email'];
        $sql = "SELECT id FROM user WHERE email = '$email'";
        if(getRows($sql) > 0){
            $errors['email']['unquie'] = 'Email đã tồn tại!';
        }
    }

    // Validate phone
    if(empty($filterAll['phone'])) {
        $errors['phone']['required'] = 'Hãy nhập số điện thoại!';
    } else {
        if(!isPhone($filterAll['phone'])) {
            $errors['phone']['isPhone'] = 'Hãy nhập đúng định dạng số điện thoại!';
        }
    }

    // Validate password
    if(empty($filterAll['password'])) {
        $errors['password']['required'] = 'Hãy nhập mật khẩu!';
    } else {
        if(strlen($filterAll['password']) < 8) {
            $errors['password']['min'] = 'Mật khẩu ít nhất có 8 ký tự!';
        }
    }

    // Validate password_confirm
    if(empty($filterAll['password_confirm'])) {
        $errors['password_confirm']['required'] = 'Hãy nhập lại mật khẩu!';
    } else {
        if($filterAll['password_confirm'] != $filterAll['password']) {
            $errors['password_confirm']['match'] = 'Mật khẩu nhập lại phải trùng khớp!';
        }
    }

    // Xử lý dữ liệu
    if(empty($errors)) {
        $activeToken = sha1(uniqid().time());

        $dataInsert = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'password' => password_hash($filterAll['password'], PASSWORD_DEFAULT),
            'activeToken' => $activeToken,
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = insert('user', $dataInsert);

        if($insertStatus) {
            // Tạo link kích hoạt
            $linkActive = _WEB_HOST . '?module=auth&action=active&token=' . $activeToken;

            // Thiết lập gửi mail
            $subject = $filterAll['fullname'] . 'Vui lòng kích hoạt tài khoản!';
            $content = 'Chào ' . $filterAll['fullname'] . '.<br>';
            $content .= 'Vui lòng click vào link dưới đây để kích hoạt tài khoản: <br>';
            $content .= $linkActive . '<br>';
            $content .= 'Trân trọng cảm ơn!';

            // Tiến hành gửi mail
            $sendMail = sendMail($filterAll['email'], $subject, $content);
            if($sendMail) {
                setFlashData('smg', 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.');
                setFlashData('smg_type', 'success');
            } else {
                setFlashData('smg', 'Hệ thống đang gặp sự cố. Vui lòng thử lại sau!');
                setFlashData('smg_type', 'danger');
            }
        } else {
            setFlashData('smg', 'Đăng ký không thành công. Vui lòng thử lại sau!');
            setFlashData('smg_type', 'danger');
        }

        redirect('?module=auth&action=login');
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=auth&action=register');
    }
}



layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// echo '<prev>';
// print_r($errors);
// echo '</prev>';
?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng ký tài khoản</h2>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="fullname">Họ tên</label>
                <input type="fullname" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" value="<?php echo old('fullname', $old); ?>">
                <?php echo form_error('fullname', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <div class="form-group mg-form">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Địa chỉ email" value="<?php echo old('email', $old); ?>">
                <?php echo form_error('email', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <div class="form-group mg-form">
                <label for="phone">Số điện thoại</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="<?php echo old('phone', $old); ?>">
                <?php echo form_error('phone', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <div class="form-group mg-form">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="<?php echo old('password', $old); ?>">
                <?php echo form_error('password', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <div class="form-group mg-form">
                <label for="password_confirm">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu">
                <?php echo form_error('password_confirm', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <button type="submit" class="w-100 mg-btn btn btn-primary btn-block">Đăng ký</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
        </form>
    </div>
</div>

<?php
    layouts('footer-login');
?>