<?php
include "connect.php";  // Kết nối PDO

// Kiểm tra xem id có hợp lệ không
$this_id = $_GET['this_id'];

try {
    // Câu lệnh DELETE
    $sql = "DELETE FROM danh_muc WHERE id_danh_muc = :this_id";  // Sử dụng chuẩn PDO với tham số chuẩn

    // Chuẩn bị câu lệnh
    $stmt = $conn->prepare($sql);

    // Liên kết tham số
    $stmt->bindParam(':this_id', $this_id, PDO::PARAM_INT);

    // Thực thi câu lệnh
    $stmt->execute();

    // Chuyển hướng về trang chính
    header("Location: danhMuc.php");
} catch (PDOException $e) {
    // Nếu có lỗi xảy ra, hiển thị thông báo lỗi
    echo "Lỗi: " . $e->getMessage();
}
?>
