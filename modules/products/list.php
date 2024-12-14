<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Danh sách sản phẩm'
];

layouts('header-admin', $data);

// Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login-admin');
}

// Truy vấn lấy sản phẩm với ảnh
$products = getRaw("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category = c.id ORDER BY p.id DESC");

// Hàm lấy ảnh cho từng sản phẩm
function getProductImages($productId) {
    return getRaw("SELECT image_url FROM product_images WHERE product_id = $productId");
}

?>

<div class="wrapper d-flex position-relative">
    <?= layouts('slidebar') ?>
    <div class="container px-4" style="padding-top: 100px; margin-left: 250px">
        <h2>Danh sách sản phẩm</h2>
        <p>
            <a href="?module=products&action=add" class="btn btn-success btn-sm">
                <i class="fa-solid fa-plus"></i> Thêm
            </a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Hình ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): 
                        // Lấy ảnh cho từng sản phẩm
                        $images = getProductImages($product['id']);
                    ?>
                        <tr>
                            <td><?= $product['id'] ?></td>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                            <td><?= htmlspecialchars($product['category_name']) ?></td>
                            <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                            <td><?= $product['status'] ?></td>
                            <td>
                                <?php if (!empty($images)): ?>
                                    <div class="d-flex">
                                        <?php foreach ($images as $image): ?>
                                            <img src="<?= htmlspecialchars($image['image_url']) ?>"
                                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                                 style="width: 100px; height: 100px; object-fit: cover; margin-right: 5px;">
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <span class="text-danger">Chưa có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?module=products&action=edit&id=<?= $product['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="?module=products&action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có sản phẩm nào</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php layouts('footer-login'); ?>
