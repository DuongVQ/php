<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

// Lấy ID sản phẩm từ query string
$productId = $_GET['id'] ?? null;

if (!$productId) {
    setFlashData('msg', 'Không tìm thấy sản phẩm để sửa.');
    setFlashData('msg_type', 'danger');
    redirect('?module=products');
}

// Lấy thông tin sản phẩm kèm theo màu sắc, kích thước và hình ảnh
$product = oneRaw("
    SELECT p.*, 
    (SELECT GROUP_CONCAT(color_name) FROM product_colors WHERE product_id = p.id) as colors,
    (SELECT GROUP_CONCAT(size_name) FROM product_sizes WHERE product_id = p.id) as sizes
    FROM products p 
    WHERE p.id = $productId
");

// Lấy hình ảnh của sản phẩm
$productImages = getRaw("SELECT * FROM product_images WHERE product_id = $productId");

if (!$product) {
    setFlashData('msg', 'Sản phẩm không tồn tại.');
    setFlashData('msg_type', 'danger');
    redirect('?module=products');
}

// Xử lý khi gửi form
if (isPost()) {
    $errors = [];
    $filterAll = filter();

    // Validate dữ liệu
    if (empty($filterAll['name'])) {
        $errors['name'] = 'Tên sản phẩm không được để trống.';
    }

    if (empty($filterAll['code'])) {
        $errors['code'] = 'Mã sản phẩm không được để trống.';
    }

    if (empty($filterAll['price']) || $filterAll['price'] <= 0) {
        $errors['price'] = 'Giá sản phẩm phải lớn hơn 0.';
    }

    if (empty($errors)) {
        $dataUpdate = [
            'name' => $filterAll['name'],
            'code' => $filterAll['code'],
            'category' => $filterAll['category'],
            'price' => $filterAll['price'],
            'old_price' => $filterAll['old_price'] ?? null,
            'discount' => $filterAll['discount'] ?? 0,
            'status' => $filterAll['status'] ?? 'Còn hàng',
            'description' => $filterAll['description'] ?? null,
        ];

        // Cập nhật sản phẩm
        $condition = "id = '$productId'";
        $updateResult = update('products', $dataUpdate, $condition);

        if ($updateResult) {
            // Xử lý hình ảnh
            if (!empty($_FILES['images']['name'][0])) {
                // Xóa hình ảnh cũ
                $oldImages = getRaw("SELECT image_url FROM product_images WHERE product_id = $productId");
                delete('product_images', "product_id = $productId");

                foreach ($oldImages as $oldImage) {
                    if (file_exists($oldImage['image_url'])) {
                        unlink($oldImage['image_url']);
                    }
                }

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
                            'product_id' => $productId,
                            'image_url' => $uploadFile,
                            'is_main' => $key == 0 ? true : false,
                        ];
                        insert('product_images', $imageData);
                    }
                }
            }

            // Xử lý màu sắc
            delete('product_colors', "product_id = $productId");
            $colors = array_filter(explode(',', $filterAll['colors']));
            foreach ($colors as $color) {
                $colorData = [
                    'product_id' => $productId,
                    'color_name' => trim($color),
                ];
                insert('product_colors', $colorData);
            }

            // Xử lý kích thước
            delete('product_sizes', "product_id = $productId");
            $sizes = array_filter(explode(',', $filterAll['sizes']));
            foreach ($sizes as $size) {
                $sizeData = [
                    'product_id' => $productId,
                    'size_name' => trim($size),
                ];
                insert('product_sizes', $sizeData);
            }

            setFlashData('msg', 'Sửa sản phẩm thành công!');
            setFlashData('msg_type', 'success');
        } else {
            setFlashData('msg', 'Lỗi khi sửa sản phẩm. Vui lòng thử lại!');
            setFlashData('msg_type', 'danger');
        }

        redirect('?module=products&action=edit&id=' . $productId);
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
$old = getFlashData('old') ?? $product;
?>

<div class="container">
    <h2>Sửa thông tin sản phẩm</h2>
    <?php if (!empty($msg)): ?>
        <div class="alert alert-<?= $msg_type ?>"><?= $msg ?></div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $old['name'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="code">Mã sản phẩm</label>
            <input type="text" class="form-control" id="code" name="code" value="<?= $old['code'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="category">Danh mục</label>
            <select class="form-control" id="category" name="category">
                <?php $categories = getRaw("SELECT * FROM categories"); ?>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= ($old['category'] ?? '') == $category['id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Giá sản phẩm</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $old['price'] ?? '' ?>" step="0.01">
        </div>
        <div class="form-group">
            <label for="colors">Màu sắc</label>
            <input type="text" class="form-control" id="colors" name="colors" value="<?= $product['colors'] ?? '' ?>" placeholder="Nhập các màu, cách nhau bởi dấu phẩy">
        </div>
        <div class="form-group">
            <label for="sizes">Kích thước</label>
            <input type="text" class="form-control" id="sizes" name="sizes" value="<?= $product['sizes'] ?? '' ?>" placeholder="Nhập các kích thước, cách nhau bởi dấu phẩy">
        </div>
        <div class="form-group">
            <label>Hình ảnh hiện tại:</label>
            <div class="row">
                <?php foreach ($productImages as $image): ?>
                    <div class="col-md-3 mb-3">
                        <img src="<?= $image['image_url'] ?>" class="img-fluid" style="max-height: 200px; object-fit: cover;">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="images">Cập nhật hình ảnh mới:</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
    </form>
    <a href="?module=products&action=list" class="mg-btn btn btn-primary btn-block">Quay lại</a>
</div>

<?php
layouts('footer-login');
?>
