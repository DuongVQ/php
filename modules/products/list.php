<!-- Danh sách sản phẩm -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Danh sách sản phẩm'
];

layouts('header-admin', $data);

// Kiểm tra trạng thái đăng nhập
if(!isLogin()) {
    redirect('?module=auth&action=login-admin');
}

// Truy vấn vào bảng user
$listProduct = getRaw("SELECT * FROM products ORDER BY update_at");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');

?>
<div class="wrapper d-flex position-relative">
    <?= layouts('slidebar') ?>
    <div class="container px-4" style="padding-top: 100px; margin-left: 250px">
        <h2>Quản lý nhóm hàng</h2>
        <p>
            <a href="?module=products&action=add" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i> Thêm</a>
        </p>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <table class="table">
            <thead>
                <th class="text-center">STT</th>
                <th class="text-center">Mã SP</th>
                <th class="text-center">Tên sản phẩm</th>
                <th class="text-center">Nhóm hàng</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Giá hàng</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center" width="5%">Sửa</th>
                <th class="text-center" width="5%">Xóa</th>
            </thead>
    
            <tbody>
                <?php
                    if(!empty($listProduct)):
                        $count = 0;
                        foreach ($listProduct as $item):
                            $count++;
                ?>
                <tr>
                    <td class="text-center"><?= $count ?></td>
                    <td class="text-center"><?= $item['id'] ?></td>
                    <td class="text-center"><?= $item['name'] ?></td>
                    <td class="text-center"><?= $item['category'] ?></td>
                    <td class="text-center"><?= $item['quantity'] ?></td>
                    <td class="text-center"><?= $item['price'] ?></td>
                    <td class="text-center"><?= $item['image'] ?></td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=products&action=edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=products&action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                        endforeach;
                    else:
                ?>
                    <tr>
                        <td colspan="9">
                            <div class="alert alert-danger text-center">Không có sản phẩm nào!</div>
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