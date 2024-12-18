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

// Lấy thông tin áo khoác
$aoKhoacs = getRaw("
    SELECT DISTINCT p.id, p.name, p.price, p.old_price, p.discount, pi.image_url
    FROM products p
    INNER JOIN product_images pi 
        ON p.id = pi.product_id 
        AND pi.is_main = 1
    WHERE p.category = 3
    AND EXISTS (
        SELECT 1 
        FROM product_images pi2 
        WHERE pi2.product_id = p.id AND pi2.is_main = 1
    )
    LIMIT 10
");
// Lấy màu sắc và kích thước tương ứng từng sản phẩm
foreach ($aoKhoacs as $key => $aoKhoac) {
    $aoKhoacs[$key]['colors'] = getRaw("SELECT color_name FROM product_colors WHERE product_id = {$aoKhoac['id']}");
    $aoKhoacs[$key]['sizes'] = getRaw("SELECT size_name FROM product_sizes WHERE product_id = {$aoKhoac['id']}");
}

// Lấy thông tin bộ nỉ
$boNis = getRaw("
    SELECT DISTINCT p.id, p.name, p.price, p.old_price, p.discount, pi.image_url
    FROM products p
    INNER JOIN product_images pi 
        ON p.id = pi.product_id 
        AND pi.is_main = 1
    WHERE p.category = 2
    AND EXISTS (
        SELECT 1 
        FROM product_images pi2 
        WHERE pi2.product_id = p.id AND pi2.is_main = 1
    )
");
// Lấy màu sắc và kích thước tương ứng từng sản phẩm
foreach ($boNis as $key => $boNi) {
    $boNis[$key]['colors'] = getRaw("SELECT color_name FROM product_colors WHERE product_id = {$boNi['id']}");
    $boNis[$key]['sizes'] = getRaw("SELECT size_name FROM product_sizes WHERE product_id = {$boNi['id']}");
}

// Lấy thông tin sơ mi - quần dài
$soMis = getRaw("
    SELECT DISTINCT p.id, p.name, p.price, p.old_price, p.discount, pi.image_url
    FROM products p
    INNER JOIN product_images pi 
        ON p.id = pi.product_id 
        AND pi.is_main = 1
    WHERE (p.category = 6 OR p.category = 17)
    AND EXISTS (
        SELECT 1 
        FROM product_images pi2 
        WHERE pi2.product_id = p.id AND pi2.is_main = 1
    )
    ORDER BY p.price ASC
    LIMIT 10
");
// Lấy màu sắc và kích thước tương ứng từng sản phẩm
foreach ($soMis as $key => $soMi) {
    $soMis[$key]['colors'] = getRaw("SELECT color_name FROM product_colors WHERE product_id = {$soMi['id']}");
    $soMis[$key]['sizes'] = getRaw("SELECT size_name FROM product_sizes WHERE product_id = {$soMi['id']}");
}

// Lấy thông tin áo polo
$aoPolos = getRaw("
    SELECT DISTINCT p.id, p.name, p.price, p.old_price, p.discount, pi.image_url
    FROM products p
    INNER JOIN product_images pi 
        ON p.id = pi.product_id 
        AND pi.is_main = 1
    WHERE p.category = 7
    AND EXISTS (
        SELECT 1 
        FROM product_images pi2 
        WHERE pi2.product_id = p.id AND pi2.is_main = 1
    )
    LIMIT 10;
");
// Lấy màu sắc và kích thước tương ứng từng sản phẩm
foreach ($aoPolos as $key => $aoPolo) {
    $aoPolos[$key]['colors'] = getRaw("SELECT color_name FROM product_colors WHERE product_id = {$aoPolo['id']}");
    $aoPolos[$key]['sizes'] = getRaw("SELECT size_name FROM product_sizes WHERE product_id = {$aoPolo['id']}");
}

?>
<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper slides-banner">
            <div class="swiper-slide">
                <img alt="New Collection FW24" src="//theme.hstatic.net/200000690725/1001078549/14/slide_1_img.jpg?v=603">
            </div>
            <div class="swiper-slide">
                <img alt="Mini Lookbook FW24" src="//theme.hstatic.net/200000690725/1001078549/14/slide_3_img.jpg?v=603">
            </div>
            <div class="swiper-slide">
                <img alt="SALE 149K" src="//theme.hstatic.net/200000690725/1001078549/14/slide_4_img.jpg?v=614">
            </div>
        </div>
        <!-- Thêm nút điều hướng -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Thêm Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- danh mục sản phẩm -->
<div class="product-catalog">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <h2 class="text-uppercase">Danh mục sản phẩm</h2>

        <div class="d-flex" style="height: 44px;">
            <!-- Navigation buttons -->
            <div class="swiper-button-prev catalog-prev position-relative me-3"></div>
            <div class="swiper-button-next catalog-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if (!empty($listCategories)): ?>
                <?php foreach ($listCategories as $category): ?>
                    <div class="swiper-slide">
                        <div class="item-product-catalog">
                            <img src="<?= !empty($category['image']) ? $category['image'] : '/uploads/default.png'; ?>"
                                alt="<?= htmlspecialchars($category['name']); ?>">
                            <div class="title-item-product-catalog">
                                <span><?= htmlspecialchars($category['name']); ?></span>
                                <a href="#">
                                    <button>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="swiper-slide">
                    <div class="item-product-catalog">
                        <p>Không có danh mục nào được tìm thấy.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

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

<!-- sản phẩm nổi bật -->
<div class="tabs">
    <!-- Danh mục -->
    <div class="tab-menu">
        <button class="tab-link active" data-tab="tab-1">Áo Khoác</button>
        <button class="tab-link" data-tab="tab-2">Bộ Nỉ</button>
        <button class="tab-link" data-tab="tab-3">Sơ Mi - Quần Dài</button>
        <button class="tab-link" data-tab="tab-4">Áo Polo</button>
    </div>

    <!-- Nội dung từng danh mục -->
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="product-grid">
                <?php
                foreach ($aoKhoacs as $index => $aoKhoac): ?>
                    <div class="item-product">
                        <!-- Giảm giá -->
                        <?php if ($aoKhoac['discount'] > 0): ?>
                            <div class="sale">-<?= intval($aoKhoac['discount']) ?>%</div>
                        <?php endif; ?>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($aoKhoac['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($aoKhoac['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                        <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                    </div>
                                    <div class="quick-view"
                                        data-bs-toggle="tooltip"
                                        title="Xem nhanh"
                                        data-id="<?= $aoKhoac['id'] ?>"
                                        data-name="<?= htmlspecialchars($aoKhoac['name']) ?>"
                                        data-image="<?= htmlspecialchars($aoKhoac['image_url']) ?>"
                                        data-price="<?= number_format($aoKhoac['price'], 0, ',', '.') ?>"
                                        data-old-price="<?= number_format($aoKhoac['old_price'], 0, ',', '.') ?>"
                                        data-discount="<?= number_format($aoKhoac['discount']) ?>"
                                        data-colors='<?= json_encode(array_column($aoKhoac['colors'], 'color_name')) ?>'
                                        data-sizes='<?= json_encode(array_column($aoKhoac['sizes'], 'size_name')) ?>'>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="info-item-product">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>+<?= count($aoKhoac['colors']) ?> Màu sắc</span>
                                <span>+<?= count($aoKhoac['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($aoKhoac['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($aoKhoac['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($aoKhoac['old_price']) && ($aoKhoac['old_price'] != $aoKhoac['price'])): ?>
                                    <div class="old"><?= number_format($aoKhoac['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div id="tab-2" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($boNis as $index => $boNi): ?>
                    <div class="item-product">
                        <!-- Giảm giá -->
                        <div class="sale">-<?= intval($boNi['discount']) ?>%</div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($boNi['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($boNi['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                       <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                    </div>
                                    <div class="quick-view"
                                        data-bs-toggle="tooltip"
                                        title="Xem nhanh"
                                        data-id="<?= $boNi['id'] ?>"
                                        data-name="<?= htmlspecialchars($boNi['name']) ?>"
                                        data-image="<?= htmlspecialchars($boNi['image_url']) ?>"
                                        data-price="<?= number_format($boNi['price'], 0, ',', '.') ?>"
                                        data-old-price="<?= number_format($boNi['old_price'], 0, ',', '.') ?>"
                                        data-discount="<?= number_format($boNi['discount']) ?>"
                                        data-colors='<?= json_encode(array_column($boNi['colors'], 'color_name')) ?>'
                                        data-sizes='<?= json_encode(array_column($boNi['sizes'], 'size_name')) ?>'>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="info-item-product">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>+<?= count($boNi['colors']) ?> Màu sắc</span>
                                <span>+<?= count($boNi['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($boNi['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($boNi['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($boNi['old_price']) && ($boNi['old_price'] != $boNi['price'])): ?>
                                    <div class="old"><?= number_format($boNi['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="tab-3" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($soMis as $index => $soMi): ?>
                    <div class="item-product">
                        <!-- Giảm giá -->
                        <div class="sale">-<?= intval($soMi['discount']) ?>%</div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($soMi['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($soMi['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                        <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                    </div>
                                    <div class="quick-view"
                                        data-bs-toggle="tooltip"
                                        title="Xem nhanh"
                                        data-id="<?= $soMi['id'] ?>"
                                        data-name="<?= htmlspecialchars($soMi['name']) ?>"
                                        data-image="<?= htmlspecialchars($soMi['image_url']) ?>"
                                        data-price="<?= number_format($soMi['price'], 0, ',', '.') ?>"
                                        data-old-price="<?= number_format($soMi['old_price'], 0, ',', '.') ?>"
                                        data-discount="<?= number_format($soMi['discount']) ?>"
                                        data-colors='<?= json_encode(array_column($soMi['colors'], 'color_name')) ?>'
                                        data-sizes='<?= json_encode(array_column($soMi['sizes'], 'size_name')) ?>'>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="info-item-product">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>+<?= count($soMi['colors']) ?> Màu sắc</span>
                                <span>+<?= count($soMi['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($soMi['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($soMi['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($soMi['old_price']) && ($soMi['old_price'] != $soMi['price'])): ?>
                                    <div class="old"><?= number_format($boNi['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="tab-4" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($aoPolos as $index => $aoPolo): ?>
                    <div class="item-product">
                        <!-- Giảm giá -->
                        <div class="sale">-<?= intval($aoPolo['discount']) ?>%</div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($aoPolo['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($aoPolo['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                        <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                    </div>
                                    <div class="quick-view"
                                        data-bs-toggle="tooltip"
                                        title="Xem nhanh"
                                        data-id="<?= $aoPolo['id'] ?>"
                                        data-name="<?= htmlspecialchars($aoPolo['name']) ?>"
                                        data-image="<?= htmlspecialchars($aoPolo['image_url']) ?>"
                                        data-price="<?= number_format($aoPolo['price'], 0, ',', '.') ?>"
                                        data-old-price="<?= number_format($aoPolo['old_price'], 0, ',', '.') ?>"
                                        data-discount="<?= number_format($aoPolo['discount']) ?>"
                                        data-colors='<?= json_encode(array_column($aoPolo['colors'], 'color_name')) ?>'
                                        data-sizes='<?= json_encode(array_column($aoPolo['sizes'], 'size_name')) ?>'>
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="info-item-product">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>+<?= count($aoPolo['colors']) ?> Màu sắc</span>
                                <span>+<?= count($aoPolo['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($aoPolo['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($aoPolo['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($aoPolo['old_price']) && ($aoPolo['old_price'] != $aoPolo['price'])): ?>
                                    <div class="old"><?= number_format($boNi['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- info -->
<hr>
<div class="support-information">
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_1.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_1.png?v=614" alt="Miễn phí vận chuyển">
        <div class="info-item-support-information">
            <h3 class="">Miễn phí vận chuyển</h3>
            <span>Áp dụng cho mọi đơn hàng từ 500k</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_2.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_2.png?v=614" alt="Đổi hàng dễ dàng">
        <div class="info-item-support-information">
            <h3 class="">Dễ dàng đổi hàng</h3>
            <span>7 ngày đổi hàng vì bất cứ lý do gì</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_3.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_3.png?v=614" alt="Hỗ trợ nhanh chóng">
        <div class="info-item-support-information">
            <h3 class="">Hỗ trợ nhanh chóng</h3>
            <span>HOTLINE 24/7 : 0967083126</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_4.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_4.png?v=614" alt="Thanh toán đa dạng">
        <div class="info-item-support-information">
            <h3 class="">Thanh toán đa dạng</h3>
            <span>Thanh toán khi nhận hàng, Napas, Visa, Chuyển Khoản</span>
        </div>
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