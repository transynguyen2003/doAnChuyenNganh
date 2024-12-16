<?php
 include("connect.php");
 function checkUser($name, $pass) {
    // Kết nối cơ sở dữ liệu
    $conn = connectdb();

    // Truy vấn lấy id_nguoi_dung và role
    $stmt = $conn->prepare("SELECT id_nguoi_dung, role FROM nguoi_dung WHERE ten_dang_nhap = :name AND mat_khau = :pass");
    $stmt->execute([
        ':name' => $name,
        ':pass' => $pass // Nếu bạn mã hóa mật khẩu, thay bằng md5($pass) hoặc phương pháp mã hóa tương ứng
    ]);

    // Lấy thông tin người dùng
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Trả về mảng chứa id_nguoi_dung và role
        return $result;
    }

    // Trả về -1 nếu không tìm thấy người dùng
    return -1;
}


?>