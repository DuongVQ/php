<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

if (isPost()) {
    $errors = [];
    $filterAll = filter();

    // Validate tên sản phẩm
    if (empty($filterAll['name'])) {
        $errors['name']['required'] = 'Hãy nhập tên sản phẩm!';
    }

    // Validate mã sản phẩm
    if (empty($filterAll['code'])) {
        $errors['code']['required'] = 'Hãy nhập mã sản phẩm!';
    }

    // Validate danh mục
    if (empty($filterAll['category'])) {
        $errors['category']['required'] = 'Hãy chọn danh mục sản phẩm!';
    }

    // Validate giá sản phẩm
    if (empty($filterAll['price']) || $filterAll['price'] <= 0) {
        $errors['price']['required'] = 'Hãy nhập giá sản phẩm hợp lệ!';
    }

    // Xử lý dữ liệu nếu không có lỗi
    if (empty($errors)) {
        $dataInsert = [
            'name' => $filterAll['name'],
            'code' => $filterAll['code'],
            'category' => $filterAll['category'],
            'price' => $filterAll['price'],
            'old_price' => $filterAll['old_price'] ?? null,
            'discount' => $filterAll['discount'] ?? 0,
            'status' => $filterAll['status'] ?? 'Còn hàng',
            'description' => $filterAll['description'] ?? null,
        ];

        // Thêm sản phẩm vào bảng products
        $query = insert('products', $dataInsert);
        $productId = getRaw("SELECT id FROM products ORDER BY created_at DESC LIMIT 1");

        // Kiểm tra nếu có kết quả trả về và lấy phần tử đầu tiên
        if ($productId && isset($productId[0])) {
            $productId = intval($productId[0]['id']); 
        }
        
        if ($productId) {
            // Thêm hình ảnh
            if (!empty($_FILES['images']['name'])) {
                foreach ($_FILES['images']['name'] as $key => $imageName) {
                    $imageTmp = $_FILES['images']['tmp_name'][$key];
                    $uploadDir = 'uploads/products/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
                    $uploadFile = $uploadDir . uniqid() . '.' . $fileExtension;

                    if (move_uploaded_file($imageTmp, $uploadFile)) {
                        $imageData = [
                            'product_id' => $productId, // Đảm bảo product_id khớp với id vừa được thêm
                            'image_url' => $uploadFile,
                            'is_main' => $key == 0 ? true : false,
                        ];
                        insert('product_images', $imageData);
                    }
                }
            }

            // Thêm màu sắc
            if (!empty($filterAll['colors'])) {
                foreach ($filterAll['colors'] as $color) {
                    $colorData = [
                        'product_id' => $productId, // Đảm bảo product_id khớp với id vừa được thêm
                        'color_name' => $color,
                    ];
                    insert('product_colors', $colorData);
                }
            }

            // Thêm kích thước
            if (!empty($filterAll['sizes'])) {
                foreach ($filterAll['sizes'] as $size) {
                    $sizeData = [
                        'product_id' => $productId, // Đảm bảo product_id khớp với id vừa được thêm
                        'size_name' => $size,
                    ];
                    insert('product_sizes', $sizeData);
                }
            }

            setFlashData('msg', 'Thêm sản phẩm thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Lỗi khi thêm sản phẩm. Vui lòng thử lại!');
            setFlashData('msg_type', 'danger');
        }
        redirect('?module=products&action=add');
    } else {
        setFlashData('msg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
    }
}

// Layouts
layouts('header-login');

$msg = getFlashData('msg');
$msg_type = getFlashData('msg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>


<div class="container">
    <h2>Thêm sản phẩm mới</h2>
    <?php if (!empty($msg)): ?>
        <div class="alert alert-<?= $msg_type ?>"><?= $msg ?></div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $old) ?>">
            <?= form_error('name', '<span class="text-danger">', '</span>', $errors) ?>
        </div>
        <div class="form-group">
            <label for="code">Mã sản phẩm</label>
            <input type="text" class="form-control" id="code" name="code" value="<?= old('code', $old) ?>">
            <?= form_error('code', '<span class="text-danger">', '</span>', $errors) ?>
        </div>
        <div class="form-group">
            <label for="category">Danh mục</label>
            <select class="form-control" id="category" name="category">
                <!-- Load danh sách danh mục -->
                <?php $categories = getRaw("SELECT * FROM categories"); ?>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= old('category', $old) == $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('category', '<span class="text-danger">', '</span>', $errors) ?>
        </div>
        <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= old('price', $old) ?>" step="0.01">
            <?= form_error('price', '<span class="text-danger">', '</span>', $errors) ?>
        </div>
        <div class="form-group">
            <label for="old_price">Giá cũ</label>
            <input type="number" class="form-control" id="old_price" name="old_price" value="<?= old('old_price', $old) ?>" step="0.01">
        </div>
        <div class="form-group">
            <label for="discount">Giảm giá (%)</label>
            <input type="number" class="form-control" id="discount" name="discount" value="<?= old('discount', $old) ?>" step="0.01">
        </div>
        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select class="form-control" id="status" name="status">
                <option value="Còn hàng" <?= old('status', $old) == 'Còn hàng' ? 'selected' : '' ?>>Còn hàng</option>
                <option value="Hết hàng" <?= old('status', $old) == 'Hết hàng' ? 'selected' : '' ?>>Hết hàng</option>
                <option value="Ngừng kinh doanh" <?= old('status', $old) == 'Ngừng kinh doanh' ? 'selected' : '' ?>>Ngừng kinh doanh</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description"><?= old('description', $old) ?></textarea>
        </div>
        <div class="form-group">
            <label for="images">Hình ảnh</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>
        <div class="form-group">
            <label for="colors">Màu sắc</label>
            <input type="text" class="form-control" id="colors" name="colors[]" placeholder="Nhập các màu, cách nhau bởi dấu phẩy">
        </div>
        <div class="form-group">
            <label for="sizes">Kích thước</label>
            <input type="text" class="form-control" id="sizes" name="sizes[]" placeholder="Nhập các kích thước, cách nhau bởi dấu phẩy">
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
    </form>
    <a href="?module=products&action=list" class="mg-btn btn btn-primary btn-block">Quay lại</a>
</div>

<?php
layouts('footer-login');
?>