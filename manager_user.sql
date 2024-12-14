-- Tạo bảng CSDL người dùng
CREATE TABLE IF NOT EXISTS manager_user.user (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(200) NOT NULL,
    forgotToken VARCHAR(100),
    activeToken VARCHAR(100),
    status INT DEFAULT 0,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng CSDL Admin
CREATE TABLE IF NOT EXISTS manager_user.adminweb (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tạo bảng CSDL danh mục sản phẩm
CREATE TABLE IF NOT EXISTS manager_user.categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image VARCHAR(255),
    description TEXT,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo bảng CSDL sản phẩm
CREATE TABLE IF NOT EXISTS manager_user.products (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID sản phẩm
    name VARCHAR(255) NOT NULL, -- Tên sản phẩm
    code VARCHAR(100) NOT NULL UNIQUE, -- Mã sản phẩm
    category INT NOT NULL, -- Danh mục sản phẩm
    price DECIMAL(10, 2) NOT NULL, -- Giá hiện tại
    old_price DECIMAL(10, 2), -- Giá gốc (giá trước khi giảm)
    discount INT DEFAULT 0, -- Phần trăm giảm giá
    status ENUM('Còn hàng', 'Hết hàng') DEFAULT 'Còn hàng', -- Trạng thái sản phẩm
    description TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category) REFERENCES categories(id)
);

-- Tạo bảng CSDL hình ảnh
CREATE TABLE IF NOT EXISTS manager_user.product_images (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID hình ảnh
    product_id INT NOT NULL, -- ID sản phẩm (liên kết với bảng products)
    image_url VARCHAR(255) NOT NULL, -- URL hình ảnh
    is_main BOOLEAN DEFAULT FALSE, -- Ảnh chính hay không
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ngày tạo
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Tạo bảng CSDL màu sắc
CREATE TABLE IF NOT EXISTS manager_user.product_colors (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID màu sắc
    product_id INT NOT NULL, -- ID sản phẩm
    color_name VARCHAR(100) NOT NULL, -- Tên màu (VD: Xanh, Đen)
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ngày tạo
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Tạo bảng CSDL kích thước
CREATE TABLE IF NOT EXISTS manager_user.product_sizes (
    id INT AUTO_INCREMENT PRIMARY KEY, -- ID kích thước
    product_id INT NOT NULL, -- ID sản phẩm
    size_name VARCHAR(50) NOT NULL, -- Tên kích thước (VD: S, M, L, XL)
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ngày tạo
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);



-- Tạo bảng CSDL token
CREATE TABLE IF NOT EXISTS manager_user.loginToken (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_Id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_Id) REFERENCES user(id)
);

-- DROP TABLE IF EXISTS manager_user.products;
SELECT id FROM products ORDER BY created_at DESC LIMIT 1;
