<!-- Danh sách người dùng -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Danh sách người dùng'
];

layouts('header-admin', $data);

// Kiểm tra trạng thái đăng nhập
if(!isLogin()) {
    redirect('?module=auth&action=login');
}

// Truy vấn vào bảng user
$listUser = getRaw("SELECT * FROM user ORDER BY update_at");



$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');

?>
<div class="wrapper d-flex position-relative">
    <div class="slidebar bg-dark position-fixed top-0 start-0" style="width: 250px; height: 100vh; padding-top: 100px">
        <ul>
            <li class="list-unstyled"><a href="/" class="text-decoration-none text-white">Dashboard</a></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <div class="container px-4" style="padding-top: 100px; margin-left: 250px">
        <h2>Quản lý người dùng</h2>
        <p>
            <a href="?module=users&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm</a>
        </p>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <table class="table">
            <thead>
                <th class="text-center">STT</th>
                <th class="text-center">Họ tên</th>
                <th class="text-center">Email</th>
                <th class="text-center">Số điện thoại</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center" width="5%">Sửa</th>
                <th class="text-center" width="5%">Xóa</th>
            </thead>
    
            <tbody>
                <?php
                    if(!empty($listUser)):
                        $count = 0;
                        foreach ($listUser as $item):
                            $count++;
                ?>
                <tr>
                    <td class="text-center"><?= $count ?></td>
                    <td class="text-center"><?= $item['fullname'] ?></td>
                    <td class="text-center"><?= $item['email'] ?></td>
                    <td class="text-center"><?= $item['phone'] ?></td>
                    <td class="text-center"><?= $item['status'] == 1 ? '<button class="btn btn-success btn-sm">Đã kích hoạt</button>' : '<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>' ?></td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=users&action=edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=users&action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                        endforeach;
                    else:
                ?>
                    <tr>
                        <td colspan="7">
                            <div class="alert alert-danger text-center">Không có người dùng nào!</div>
                        </td>
                    </tr>
                <?php
                    endif;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
layouts('footer-login');
?>