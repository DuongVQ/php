<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

if (isPost()) {
    $filterAll = filter();
    $errors = []; // Mảng chứa các lỗi

    // Validate tên danh mục
    if (empty($filterAll['name'])) {
        $errors['name']['required'] = 'Hãy nhập tên danh mục!';
    } else {
        if (strlen($filterAll['name']) < 5) {
            $errors['name']['min'] = 'Tên danh mục quá ngắn!';
        }
    }

    // Xử lý tải lên hình ảnh
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/categories/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }

        $targetFile = $targetDir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Kiểm tra định dạng file
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowedTypes)) {
            $errors['image']['type'] = 'Chỉ chấp nhận các định dạng JPG, JPEG, PNG, GIF, WEBP!';
        } else {
            if ($_FILES['image']['size'] > 2 * 1024 * 1024) { // Giới hạn 2MB
                $errors['image']['size'] = 'Dung lượng file không được vượt quá 2MB!';
            } else {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $image = $targetFile; // Lưu đường dẫn hình ảnh
                } else {
                    $errors['image']['upload'] = 'Tải lên hình ảnh thất bại!';
                }
            }
        }
    }

    // Validate mô tả
    if (!empty($filterAll['description']) && strlen($filterAll['description']) > 255) {
        $errors['description']['max'] = 'Mô tả không được vượt quá 255 ký tự!';
    }

    // Xử lý dữ liệu nếu không có lỗi
    if (empty($errors)) {
        $dataInsert = [
            'name' => htmlspecialchars($filterAll['name']), // Tránh XSS
            'image' => $image,
            'description' => htmlspecialchars($filterAll['description']),
            'create_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s'),
        ];

        // Chèn dữ liệu vào bảng categories
        $insertStatus = insert('categories', $dataInsert);

        if ($insertStatus) {
            setFlashData('smg', 'Thêm danh mục sản phẩm thành công!');
            setFlashData('smg_type', 'success');
            redirect('?module=categories&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi. Vui lòng thử lại sau!');
            setFlashData('smg_type', 'danger');
            redirect('?module=categories&action=add');
        }
    } else {
        // Lưu lỗi và dữ liệu cũ để hiển thị lại form
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=categories&action=add');
    }
}

// Giao diện thêm danh mục
layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
?>

<div class="container">
    <div class="row" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Thêm danh mục sản phẩm</h2>
        <?php 
        if (!empty($smg)) {
            getSmg($smg, $smg_type);
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Nhập tên danh mục -->
            <div class="form-group mg-form">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" 
                    value="<?php echo old('name', $old); ?>">
                <?php echo form_error('name', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            
            <!-- Tải lên hình ảnh -->
            <div class="form-group mg-form">
                <label for="image">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php echo form_error('image', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            
            <!-- Nhập mô tả -->
            <div class="form-group mg-form">
                <label for="description">Mô tả</label>
                <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả"><?php echo old('description', $old); ?></textarea>
                <?php echo form_error('description', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            
            <!-- Nút thêm và quay lại -->
            <button type="submit" class="mg-btn btn btn-primary btn-block">Thêm</button>
            <a href="?module=categories&action=list" class="mg-btn btn btn-secondary btn-block">Quay lại</a>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>
