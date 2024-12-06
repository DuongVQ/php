<!-- Thêm sản phẩm -->
<?php
if(!defined('_CODE')) {
    die('Access denied...');
}

if(isPost()) {
    $filterAll = filter();
    $errors = []; //mảng chứa các lỗi

    // Validate name
    if(empty($filterAll['name'])) {
        $errors['name']['required'] = 'Hãy nhập tên nhóm hàng!';
    } else {
        if(strlen($filterAll['name']) < 5) {
            $errors['name']['min'] = 'Tên nhóm hàng quá ngắn!';
        }
    }

    // Validate quantity
    if(empty($filterAll['quantity'])) {
        $errors['quantity']['required'] = 'Hãy nhập số lượng!';
    } else {
        if($filterAll['quantity'] < 1) {
            $errors['quantity']['min'] = 'Số lượng sản phẩm phải lớn hơn hoặc bằng 1.';
        }
    }

    // Xử lý dữ liệu
    if(empty($errors)) {
        $dataInsert = [
            'name' => $filterAll['name'],
            'description' => $filterAll['description'],
            'create_at' => date('Y-m-d H:i:s'),
        ];

        $insertStatus = insert('categories', $dataInsert);

        if($insertStatus) {
            setFlashData('smg', 'Thêm nhóm hàng mới thành công!');
            setFlashData('smg_type', 'success');
            redirect('?module=categories&action=list');
        } else {
            setFlashData('smg', 'Hệ thống đã xảy ra lỗi. Vui lòng thử lại sau!');
            setFlashData('smg_type', 'danger');
            redirect('?module=categories&action=add');
        }

    } else {
        setFlashData('smg', 'Vui lòng kiểm tra lại thông tin!');
        setFlashData('smg_type', 'danger');
        setFlashData('errors', $errors);
        setFlashData('old', $filterAll);
        redirect('?module=categories&action=add');
    }
}



layouts('header-login');

$smg = getFlashData('smg');
$smg_type = getFlashData('smg_type');
$errors = getFlashData('errors');
$old = getFlashData('old');

// echo '<prev>';
// print_r($errors);
// echo '</prev>';
?>

<div class="container">
    <div class="row" style="margin: 50px auto;">
        <h2 class="text-center text-uppercase">Thêm sản phẩm</h2>
        <?php 
            if(!empty($smg)) {
                getSmg($smg, $smg_type);
            }
        ?>
        <form action="" method="post">
            <div class="form-group mg-form">
                <label for="name">Tên sản phẩm</label>
                <input type="name" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" value="<?php echo old('name', $old); ?>">
                <?php echo form_error('name', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <div class="form-group mg-form">
                <label for="description">Mô tả</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Nhập mô tả" value="<?php echo old('description', $old); ?>">
                <?php echo form_error('description', '<span class="error text-danger fst-italic">', '</span>', $errors) ?>
            </div>
            <button type="submit" class="mg-btn btn btn-primary btn-block">Thêm</button>
            <a href="?module=categories&action=list" class="mg-btn btn btn-primary btn-block">Quay lại</a>
            <hr>
        </form>
    </div>
</div>

<?php
    layouts('footer-login');
?>