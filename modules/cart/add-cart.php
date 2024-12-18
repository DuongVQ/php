<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

if (isPost()) {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $oldPrice = $_POST['old_price'];
    $imageUrl = $_POST['image_url'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $quantity = $_POST['quantity'];
    $userId = 1; 

    // Thêm sản phẩm vào giỏ hàng
    $query = "INSERT INTO cart (product_id, product_name, price, old_price, image_url, color, size_product, quantity) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$productId, $productName, $price, $oldPrice, $imageUrl, $color, $size, $quantity]);

    // Chuyển hướng về trang giỏ hàng hoặc thông báo thành công
    header('Location: ?module=home&action=dashboard'); // Chuyển hướng người dùng về trang giỏ hàng
    exit;
}
?>

