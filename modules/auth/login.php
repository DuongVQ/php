<!-- Đăng nhập -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Đăng nhập'
];

layouts('header-login', $data);

// Kiểm tra trạng thái đăng nhập
if(isLogin()) {
    redirect('?module=home&action=dashboard');
}

if(isPost()) {
    $filterAll = filter();

    // Check điền đủ thông tin
    if(!empty(trim($filterAll['email'])) && !empty(trim($filterAll['password']))) {
        // Kiểm tra đăng nhập
        $email = $filterAll['email'];
        $password = $filterAll['password'];

        // Truy vấn lấy thông tin
        $userQuery = oneRaw("SELECT password, id FROM user WHERE email = '$email'");

        if(!empty($userQuery)) {
            $passwordHash = $userQuery['password'];
            $userId = $userQuery['id'];

            // Kiểm tra mật khẩu CSDL và mật khẩu nhập vào
            if(password_verify($password, $passwordHash)) {
                // Tạo token login
                $tokenLogin = sha1(uniqid().time());

                // Insert vào bảng loginToken
                $dataInsert = [
                    'user_Id' => $userId,
                    'token' => $tokenLogin,
                    'create_at' => date('Y-m-d H:i:s')
                ];

                $insertStatus = insert('loginToken', $dataInsert);
                if($insertStatus) {

                    // Lưu loginToken vào session
                    setSession('loginToken', $tokenLogin);

                    redirect('?module=home&action=dashboard');
                } else {
                    setFlashData('smg', 'Không thể đăng nhập, vui lòng thử lại sau!');
                    setFlashData('smg_type', 'danger');
                }

            } else {
                setFlashData('smg', 'Mật khẩu chưa chính xác, vui lòng nhập lại!');
                setFlashData('smg_type', 'danger');
            }

        } else {
            setFlashData('smg', 'Email không tồn tại! Hãy kiểm tra lại');
            setFlashData('smg_type', 'danger');
        }

    } else {
        setFlashData('smg', 'Vui lòng nhập đủ thông tin!');
        setFlashData('smg_type', 'danger');
        redirect('?module=auth&action=login');
    }
}

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');

?>

<div class="row">
    <div class="col-4" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Đăng nhập</h2>
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
            <div class="form-group mg-form">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
            </div>
            <button type="submit" class="w-100 mg-btn btn btn-primary btn-block">Đăng nhập</button>
            <hr>
            <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
            <p class="text-center"><a href="?module=auth&action=register">Đăng ký tài khoản</a></p>
        </form>
    </div>
</div>

<?php
    layouts('footer-login');
?>