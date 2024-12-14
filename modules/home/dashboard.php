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

$listCategories = getRaw("SELECT * FROM categories ORDER BY update_at");
$listCategories = array_slice($listCategories, 0, 6); 
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
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
            </div>
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
                <!-- Sản phẩm trong danh mục Áo Khoác -->
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <!-- Thêm các sản phẩm khác -->
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="product-grid">
                <!-- Sản phẩm trong danh mục Áo Khoác -->
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <!-- Thêm các sản phẩm khác -->
            </div>
        </div>
        <div id="tab-3" class="tab-pane">
            <div class="product-grid">
                <!-- Sản phẩm trong danh mục Áo Khoác -->
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <!-- Thêm các sản phẩm khác -->
            </div>
        </div>
        <div id="tab-4" class="tab-pane">
            <div class="product-grid">
                <!-- Sản phẩm trong danh mục Áo Khoác -->
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <div class="item-product">
                    <div class="sale">-34%</div>
                    <div class="img-product">
                        <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/Screenshot 2024-12-06 175707.png" alt="">
                        <div class="img-product-after">
                            <img src="<?php echo _WEB_HOST_TEMPLATES; ?>/image/after.png" alt="">
                            <div class="wrapper-addCart">
                                <div class="addCart"><i class="fa-solid fa-bag-shopping me-1"></i>Thêm</div>
                                <div class="quick-view" data-bs-toggle="tooltip" title="Xem nhanh">
                                    <i class="fa-regular fa-eye"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-item-product">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>+3 Màu sắc</span>
                            <span>+4 Kích thước</span>
                        </div>
                        <div class="name-product">Áo Polo dài tay basic FWTP065</div>
                        <div class="price">
                            <div class="new">299,000đ</div>
                            <div class="old">450,000d</div>
                        </div>
                    </div>
                </div>
                <!-- Thêm các sản phẩm khác -->
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
<?php
layouts('footer');
?>