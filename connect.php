<?php
$servername = "localhost";  // Thay bằng tên máy chủ của bạn
$username = "root";         // Thay bằng tên người dùng của bạn
$password = "";             // Thay bằng mật khẩu của bạn (nếu có)
$dbname = "ban_sach_online"; // Tên cơ sở dữ liệu của bạn

try {
    // Tạo kết nối với PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // Thiết lập chế độ lỗi cho PDO: Hiển thị ngoại lệ nếu xảy ra lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Kết nối thành công
    // echo "Kết nối thành công"; // Bạn có thể bỏ dòng này đi nếu không cần thông báo kết nối
} catch (PDOException $e) {
    // Xử lý ngoại lệ nếu kết nối thất bại
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
