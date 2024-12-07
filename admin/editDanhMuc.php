<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Sách</title>
    <link rel="stylesheet" href="style.css">  <!-- Kết nối với file CSS nếu có -->
    <style>
    /* Định dạng chính */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
    }
    label {
        font-size: 16px;
        margin: 10px 0;
        display: block;
    }
    input, select, textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    button {
        width: 100%;
        padding: 12px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #45a049;
    }

    .product-image {
        max-width: 100%;
        max-height: 300px;
        display: block;
        margin: 10px auto;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Media Queries cho các thiết bị nhỏ hơn */
    @media (max-width: 768px) {
        .container {
            width: 80%; /* Thu hẹp container */
        }
        h2 {
            font-size: 1.5em; /* Giảm kích thước tiêu đề */
        }
        button {
            font-size: 16px; /* Giảm kích thước chữ trong nút */
        }
    }

    @media (max-width: 480px) {
        .container {
            width: 95%; /* Đặt chiều rộng container gần bằng màn hình */
            padding: 15px; /* Giảm padding để vừa màn hình nhỏ */
        }
        h2 {
            font-size: 1.2em; /* Giảm thêm kích thước tiêu đề */
        }
        input, select, textarea, button {
            font-size: 14px; /* Giảm kích thước chữ trong form */
        }
    }
</style>

</head>
<body>
   
    <?php include("connect.php"); ?>

<?php 
$this_id = intval($_GET['this_id']); // Bảo vệ ID chống SQL Injection


// Lấy danh sách danh mục
$sql_danh_muc = "SELECT * FROM danh_muc";
$stmt_danh_muc = $conn->prepare($sql_danh_muc);
$stmt_danh_muc->execute();
$danh_muc = $stmt_danh_muc->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $ten_danh_muc = $_POST['ten_danh_muc'];
  

    // Cập nhật thông tin sách trong bảng 'sach'
    $update_sql = "UPDATE danh_muc SET 
        ten_danh_muc = ?,     
        WHERE id_danh_muc = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->execute([$ten_danh_muc]);


    header("Location: danhMuc.php");
    exit;
}
?>

<div class="container">
    <h2>Sửa Thông Tin Sách</h2>
    <form action="editDanhMuc.php?this_id=<?php echo $this_id; ?>" method="POST" enctype="multipart/form-data">
        <label for="ten_sach">Tên Danh Mục:</label>
        <input type="text" id="ten_danh_muc" name="ten_danh_muc" value="<?php echo $row['ten_danh_muc'] ?>" required>


        <button type="submit">Lưu Chỉnh Sửa</button>
    </form>
</div>

