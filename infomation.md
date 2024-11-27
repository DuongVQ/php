## Phần 1: Xác thực truy cập
- Đăng nhập
- Đăng ký
- Đăng xuất
- Kích hoạt tài khoản

## Phần 2: Quản lý người dùng
- Kiểm tra người dùng đăng nhập
- Thêm người dùng
- Sửa và xóa người dùng
- Hiển thị số user
- Phân trang
- Tìm kiếm, lọc dữ liệu

## Phần 3: Database

* Bảng users:
 + id - primary key (int)
 + fullname (varchar(100))
 + email (varchar(100))
 + phone (varchar(20))
 + password (varchar(200))
 + forgotToken (varchar(100))
 + activeToken (varchar(100))
 + create_at (datetime)
 + update_at (datetime)

* Bảng admin:
 + id - primary key (int)
 + email (varchar(100))
 + password (varchar(200))
 + create_at (datetime)

* Bảng loginToken:
 + id - primary key (int)
 + user_Id (int)
 + token (varchar(100))
 + create_at (datetime)

# Code chức năng đăng ký tài khoản
- Đăng ký (kiểm tra và insert dữ liệu vào bằng user)
- Gửi mail kích hoạt cho người dùng
- Người dùng bấm vào link kích hoạt tài khoản

# Code tính năng quên mật khẩu
- Tạo ra forgotToken 
- Gửi mail chứa link đến trang reset
- Xác thực token, thực hiện reset password
- Submit reset password -> xử lý -> update lại mật khẩu
