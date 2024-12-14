<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$filterAll = filter();
if (!empty($filterAll['id'])) {
    $categoryId = $filterAll['id'];

    // Kiểm tra id của danh mục tồn tại không
    $categoryDetail = oneRaw("SELECT * FROM categories WHERE id='$categoryId'");
    if ($categoryDetail) {
        setFlashData('category-detail', $categoryDetail);
    } else {
        redirect('?module=categories&action=list');
    }
}

if (isPost()) {
    $errors = []; // Mảng chứa các lỗi

    // Validate name
    if (empty($filterAll['name'])) {
        $errors['name']['required'] = 'Hãy nhập tên nhóm hàng!';
    } else {
        if (strlen($filterAll['name']) < 5) {
            $errors['name']['min'] = 'Tên nhóm hàng quá ngắn!';
        }
    }

    // Xử lý file ảnh
    if (!empty($_FILES['image']['name'])) {
        $file = $_FILES['image'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $uploadDir = 'uploads/categories/';
        $uploadFile = $uploadDir . uniqid() . '.' . $fileExtension;

        // Kiểm tra định dạng file
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors['image']['type'] = 'Định dạng ảnh không hợp lệ (chỉ jpg, jpeg, png, gif)!';
        }

        // Kiểm tra dung lượng file
        if ($file['size'] > 2 * 1024 * 1024) { // 2MB
            $errors['image']['size'] = 'Dung lượng ảnh quá lớn! Chỉ cho phép tối đa 2MB.';
        }

        // Di chuyển file nếu không có lỗi
        if (empty($errors['image']) && !move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $errors['image']['upload'] = 'Tải ảnh lên thất bại!';
        }
    }

    // Xử lý dữ liệu
    if (empty($errors)) {
        $dataUpdate = [
            'name' => $filterAll['name'],
            'description' => $filterAll['description'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        // Nếu có ảnh mới, cập nhật đường dẫn ảnh
        if (!empty($uploadFile)) {
            $dataUpdate['image'] = $uploadFile;
        }

        $condition = "id = '$categoryId'";
        $updateStatus = update('categories', $dataUpdate, $condition);

        if ($updateStatus) {
            setFlashData('smg', 'Sửa thông tin nhóm hàng thành công!');
            setFlashData('smg_type', 'success');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi. Vui lòng thử lại sau!');
            setFlashData('smg_type', 'danger');
        }
    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
    }
    redirect('?module=categories&action=edit&id=' . $categoryId);
}

layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');
$categoryDetail = getFlashData('category-detail');

if (!empty($categoryDetail)) {
    $old = $categoryDetail;
}
?>

<div class="container">
    <div class="row" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Sửa thông tin nhóm hàng</h2>
        <?php 
            if (!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="form-group mg-form">
                        <label for="name">Tên nhóm hàng</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhóm hàng" value="<?php echo old('name', $old); ?>">
                        <?php echo form_error('name', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="description">Mô tả</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" value="<?php echo old('description', $old); ?>">
                        <?php echo form_error('description', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                    <div class="form-group mg-form">
                        <label for="image">Ảnh nhóm hàng</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <?php if (!empty($old['image'])): ?>
                            <img src="<?= $old['image'] ?>" alt="Ảnh nhóm hàng" class="mt-2" style="max-width: 150px; display: block;">
                        <?php endif; ?>
                        <?php echo form_error('image', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id" value="<?= $categoryId ?>">

            <button type="submit" class="mg-btn btn btn-primary btn-block">Sửa thông tin</button>
            <a href="?module=categories&action=list" class="mg-btn btn btn-primary btn-block">Quay lại</a>
            <hr>
        </form>
    </div>
</div>

<?php
layouts('footer-login');
?>
