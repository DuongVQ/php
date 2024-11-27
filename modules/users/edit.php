<!-- Sửa thông tin người dùng -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();
if(!empty($filterAll['id'])) {
    $userId = $filterAll['id'];

    // Kiểm tra id của user tồn tại không
    $userDetail = oneRaw("SELECT * FROM user WHERE id='$userId'");
    if($userDetail) {
        setFlashData('user-detail', $userDetail);
    } else {
        redirect('?module=users&action=list');
    }
}

if(isPost()) {
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
        $sql = "SELECT id FROM user WHERE email = '$email' AND id <> $userId";
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

    // Xử lý dữ liệu
    if(empty($errors)) {
        $dataUpdate = [
            'fullname' => $filterAll['fullname'],
            'email' => $filterAll['email'],
            'phone' => $filterAll['phone'],
            'status' => $filterAll['status'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        if(!empty($filterAll['password'])) {
            $dataUpdate['password'] = password_hash($filterAll['password'], PASSWORD_DEFAULT);
            
            // Validate password_confirm
            if(empty($filterAll['password_confirm'])) {
                $errors['password_confirm']['required'] = 'Hãy nhập lại mật khẩu!';
            } else {
                if($filterAll['password_confirm'] != $filterAll['password']) {
                    $errors['password_confirm']['match'] = 'Mật khẩu nhập lại phải trùng khớp!';
                }
            }
        }

        $condition = "id = '$userId'";
        $updateStatus = update('user', $dataUpdate, $condition);

        if($updateStatus) {
            setFlashData('smg', 'Sửa thông tin người dùng thành công!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi. Vui lòng thử lại sau!');
            setFlashData('smg_type', 'danger');
        }

    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
    }
    redirect('?module=users&action=edit&id=' . $userId);
}



layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$userDetail = getFlashData('user-detail');

if(!empty($userDetail)) {
    $old = $userDetail;
}

?>

<div class="container">
    <div class="row" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Sửa thông tin người dùng</h2>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="row">
                <div class="col">
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
                </div>
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="password">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu (Nếu thay đổi mật khẩu thì nhập)"">
                        <?php echo form_error('password', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="password_confirm">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Nhập lại mật khẩu (Nếu thay đổi mật khẩu thì nhập)">
                        <?php echo form_error('password_confirm', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0" <?php echo (old('status', $old) == 0) ? 'selected' : false; ?>>Chưa kích hoạt</option>
                            <option value="1" <?php echo (old('status', $old) == 1) ? 'selected' : false; ?>>Đã kích hoạt</option>
                        </select>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $userId ?>">

            <button type="submit" class="mg-btn btn btn-primary btn-block">Sửa thông tin</button>
            <a href="?module=users&action=list" class="mg-btn btn btn-primary btn-block">Quay lại</a>
            <hr>
        </form>
    </div>
</div>

<?php
    layouts('footer-login');
?>

