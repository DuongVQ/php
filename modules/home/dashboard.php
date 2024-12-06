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
            <div class="swiper-button-prev position-relative me-3"></div>
            <div class="swiper-button-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="item-product-catalog">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-catalog">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-catalog">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-catalog">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-catalog">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-catalog">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-catalog">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-catalog">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-catalog">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-catalog">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- sản phẩm khuyến mãi -->
<div class="product-sale">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <h2 class="text-uppercase">Danh mục sản phẩm</h2>

        <div class="d-flex" style="height: 44px;">
            <!-- Navigation buttons -->
            <div class="swiper-button-prev position-relative me-3"></div>
            <div class="swiper-button-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item-product-sale">
                    <img src="//theme.hstatic.net/200000690725/1001078549/14/home_category_2_img.jpg?v=614" alt="Bộ Nỉ">
                    <div class="title-item-product-sale">
                        <span>Bộ nỉ</span>
                        <a href="#">
                            <button>
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
layouts('footer');
?>