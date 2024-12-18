<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Trang Dashboard'
];

layouts('header', $data);

// Kiểm tra trạng thái đăng nhập
if (!isLogin()) {
    redirect('?module=auth&action=login');
}

// Lấy thông tin category
$listCategories = getRaw("SELECT * FROM categories ORDER BY update_at");
$listCategories = array_slice($listCategories, 0, 6);

// Lấy thông tin sản phẩm khuyến mãi
$saleProducts = getRaw("
    SELECT DISTINCT p.id, p.name, p.price, p.old_price, p.discount, pi.image_url
    FROM products p
    INNER JOIN product_images pi 
        ON p.id = pi.product_id 
    WHERE pi.is_main = 1
    AND p.discount > 0
    ORDER BY p.discount DESC
    LIMIT 10;
");
// Lấy màu sắc và kích thước tương ứng từng sản phẩm
foreach ($saleProducts as $key => $saleProduct) {
    $saleProducts[$key]['colors'] = getRaw("SELECT color_name FROM product_colors WHERE product_id = {$saleProduct['id']}");
    $saleProducts[$key]['sizes'] = getRaw("SELECT size_name FROM product_sizes WHERE product_id = {$saleProduct['id']}");
}

?>

<!-- sản phẩm khuyến mãi -->
<div class="product-sale">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <h2 class="text-uppercase">Sản phẩm khuyến mãi</h2>

        <div class="d-flex" style="height: 44px;">
            <!-- Navigation buttons -->
            <div class="swiper-button-prev sale-prev position-relative me-3"></div>
            <div class="swiper-button-next sale-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($saleProducts as $index => $saleProduct): ?>
                <?php if ($saleProduct['discount'] > 0): ?> <!-- Kiểm tra có khuyến mãi không -->
                    <div class="swiper-slide">
                        <div class="item-product">
                            <!-- Giảm giá -->
                            <div class="sale">-<?= intval($saleProduct['discount']) ?>%</div>

                            <!-- Hình ảnh sản phẩm -->
                            <div class="img-product">
                                <img src="<?= htmlspecialchars($saleProduct['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($saleProduct['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                                <div class="img-product-after">
                                    <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="Ảnh phụ">
                                    <div class="wrapper-addCart">
                                        <div class="addCart">
                                            <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                        </div>
                                        <div class="quick-view"
                                            data-bs-toggle="tooltip"
                                            title="Xem nhanh"
                                            data-id="<?= $saleProduct['id'] ?>"
                                            data-name="<?= htmlspecialchars($saleProduct['name']) ?>"
                                            data-image="<?= htmlspecialchars($saleProduct['image_url']) ?>"
                                            data-price="<?= number_format($saleProduct['price'], 0, ',', '.') ?>"
                                            data-old-price="<?= number_format($saleProduct['old_price'], 0, ',', '.') ?>"
                                            data-discount="<?= number_format($saleProduct['discount']) ?>"
                                            data-colors='<?= json_encode(array_column($saleProduct['colors'], 'color_name')) ?>'
                                            data-sizes='<?= json_encode(array_column($saleProduct['sizes'], 'size_name')) ?>'>
                                            <i class="fa-regular fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Thông tin sản phẩm -->
                            <div class="info-item-product">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>+<?= count($saleProduct['colors']) ?> Màu sắc</span>
                                    <span>+<?= count($saleProduct['sizes']) ?> Kích thước</span>
                                </div>
                                <div class="name-product"><?= htmlspecialchars($saleProduct['name']) ?></div>
                                <div class="price">
                                    <div class="new"><?= number_format($saleProduct['price'], 0, ',', '.') ?>đ</div>
                                    <?php if (!empty($saleProduct['old_price']) && ($saleProduct['old_price'] != $saleProduct['price'])): ?>
                                        <div class="old"><?= number_format($saleProduct['old_price'], 0, ',', '.') ?>đ</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-100 text-center mt-3">
        <a href="#" class="see-more">
            <button class="btn"><i class="fa-solid fa-angles-right"></i> Xem thêm</button>
        </a>
    </div>
</div>

<!-- Modal Xem Nhanh -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickViewModalLabel">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="modal-image" src="" alt="Hình ảnh sản phẩm" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h4 id="modal-name"></h4>
                        <p id="modal-price" class="text-danger fw-bold"></p>
                        <p id="modal-old-price" class="text-decoration-line-through"></p>
                        <p id="modal-discount" class="text-danger fw-bold"></p>
                        <div id="modal-colors" class="mb-3">
                            <strong>Màu sắc:</strong>
                            <div class="btn-group" role="group"></div>
                        </div>
                        <div id="modal-sizes" class="mb-3">
                            <strong>Kích thước:</strong>
                            <div class="btn-group" role="group"></div>
                        </div>

                        <!-- Ô tăng/giảm số lượng -->
                        <div class="mt-3">
                            <strong>Số lượng:</strong>
                            <div class="input-group quantity-control">
                                <button class="btn btn-outline-secondary btn-quantity-minus" type="button">-</button>
                                <input id="modalQuantity" type="text" class="form-control text-center" value="1" readonly>
                                <button class="btn btn-outline-secondary btn-quantity-plus" type="button">+</button>
                            </div>
                        </div>

                        <button class="btn btn-danger mt-3">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
layouts('footer');
?>