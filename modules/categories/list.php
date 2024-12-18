<!-- Danh sách nhóm hàng -->
<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Danh sách nhóm hàng'
];

layouts('header-admin', $data);

// Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login-admin');
}

// Truy vấn vào bảng categories
$listCategories = getRaw("SELECT * FROM categories ORDER BY update_at DESC");

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
?>
<div class="wrapper d-flex position-relative">
    <?= layouts('slidebar') ?>
    <div class="container px-4" style="padding-top: 100px; margin-left: 250px">
        <h2>Quản lý nhóm hàng</h2>
        <p>
            <a href="?module=categories&action=add" class="btn btn-success btn-sm">
                <i class="fa-solid fa-plus"></i> Thêm
            </a>
        </p>
        <?php
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center" width="5%">STT</th>
                    <th class="text-center">Tên danh mục</th>
                    <th class="text-center" width="15%">Hình ảnh</th>
                    <th class="text-center">Mô tả</th>
                    <th class="text-center" width="5%">Sửa</th>
                    <th class="text-center" width="5%">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listCategories)):
                    $count = 0;
                    foreach ($listCategories as $item):
                        $count++;
                        $imagePath = !empty($item['image']) ? $item['image'] : '/uploads/default.png';
                ?>
                <tr>
                    <td class="text-center"><?= $count ?></td>
                    <td class="text-center"><?= htmlspecialchars($item['name']) ?></td>
                    <td class="text-center">
                        <img src="<?= $imagePath ?>" alt="Hình ảnh danh mục" style="width: 60px; height: 80px; object-fit: cover;">
                    </td>
                    <td class="text-center"><?= htmlspecialchars($item['description']) ?></td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=categories&action=edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="<?= _WEB_HOST ?>?module=categories&action=delete&id=<?= $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <tr>
                    <td colspan="6">
                        <div class="alert alert-danger text-center">Không có danh mục nào!</div>
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
