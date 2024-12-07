<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách</title>
    <link rel="stylesheet" href="style.css">  <!-- Kết nối với file CSS nếu có -->
    <style>
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
    </style>
</head>
<body>
<?php include("connect.php") ?>
<?php 
include("connect.php");

if (isset($_POST['btn'])) {
    try {
        // Nhận dữ liệu từ form
        $ten_danh_muc = $_POST['ten_danh_muc'];
        
        // Kiểm tra giá trị nhận được
        var_dump($ten_danh_muc); // Kiểm tra đầu vào

        // Bắt đầu giao dịch
        $conn->beginTransaction();

        // Thêm danh mục vào bảng danh_muc
        $sql = "INSERT INTO danh_muc (ten_danh_muc) VALUES (:ten_danh_muc)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([ ':ten_danh_muc' => $ten_danh_muc ]);

        // Commit giao dịch
        $conn->commit();

        // Chuyển hướng về trang danhMuc.php
        header("Location: danhMuc.php");
        exit();  // Đảm bảo không có lỗi chuyển hướng
    } catch (Exception $e) {
        // Rollback nếu có lỗi
        $conn->rollBack();
        echo "Lỗi: " . $e->getMessage();
    }
}
?>


    <div class="container">
        <h2>Thêm Sách Mới</h2>
        <form action="addDanhMuc.php" method="POST" enctype="multipart/form-data">
            <label for="ten_danh_muc">Tên Danh Mục:</label>
            <input type="text" id="ten_danh_muc" name="ten_danh_muc" required>
          <button  name="btn">Thêm Danh Mục</button>
        </form>
    </div>

</body>
</html>
