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
<?php include("../connect.php") ?>
<?php 
if (isset($_POST['btn'])) {
    try {
        // Nhận dữ liệu từ form
        $ten_sach = $_POST['ten_sach'];
        $tac_gia = $_POST['tac_gia'];
        $gia = $_POST['gia'];
        $mo_ta = $_POST['mo_ta'];
        $so_luong = $_POST['so_luong'];
        $img = $_FILES['img']['name'];
        $img_tmp_name = $_FILES['img']['tmp_name'];
        $danh_muc = $_POST['danh_muc'];

        // Bắt đầu giao dịch
        $conn->beginTransaction();

        // Thêm sách vào bảng `sach`
        $sql = "INSERT INTO sach (ten_sach, tac_gia, gia_ban, mo_ta, so_luong, hinh_anh) 
                VALUES (:ten_sach, :tac_gia, :gia_ban, :mo_ta, :so_luong, :hinh_anh)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':ten_sach' => $ten_sach,
            ':tac_gia' => $tac_gia,
            ':gia_ban' => $gia,
            ':mo_ta' => $mo_ta,
            ':so_luong' => $so_luong,
            ':hinh_anh' => $img
        ]);

        // Lấy ID của sách vừa thêm
        $id_sach = $conn->lastInsertId();

        // Thêm liên kết vào bảng `sach_danh_muc`
        $sql1 = "INSERT INTO sach_danh_muc (id_sach, id_danh_muc) VALUES (:id_sach, :id_danh_muc)";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute([
            ':id_sach' => $id_sach,
            ':id_danh_muc' => $danh_muc
        ]);

        // Di chuyển ảnh vào thư mục 'img/product/'
        if (move_uploaded_file($img_tmp_name, '../user/img/' . $img)) {
            // Commit nếu tất cả đều thành công
            $conn->commit();
            echo "Thêm sách và danh mục thành công!";
        } else {
            throw new Exception("Không thể di chuyển tệp ảnh.");
        }

        header("Location: index.php");
    } catch (Exception $e) {
        $conn->rollBack(); // Rollback giao dịch nếu có lỗi
        echo "Lỗi: " . $e->getMessage();
    }
}
    

?>

    <div class="container">
        <h2>Thêm Sách Mới</h2>
        <form action="addSach.php" method="POST" enctype="multipart/form-data">
            <label for="ten_sach">Tên Sách:</label>
            <input type="text" id="ten_sach" name="ten_sach" required>

            <label for="tac_gia">Tác Giả:</label>
            <input type="text" id="tac_gia" name="tac_gia" required>

            <label for="gia">Giá Sách:</label>
            <input type="number" id="gia" name="gia" required>

            <label for="mo_ta">Mô Tả:</label>
            <textarea id="mo_ta" name="mo_ta" rows="4" required></textarea>

            <label for="gia">Số Lượng:</label>
            <input type="number" id="so_luong" name="so_luong" required>

            <label for="gia">Hình ảnh:</label>
            <input type="file" id="img" name="img" required>

            <label for="danh_muc">Danh Mục:</label>
            <select id="danh_muc" name="danh_muc" required>
                <option value="1">Tiểu thuyết</option>
                <option value="2">Khoa học</option>
                <option value="3">Lịch sử</option>
                <option value="4">Phát triển bản thân</option> 
                <option value="5">Tâm lý</option> 
                <option value="6">Văn học trẻ</option>    
            </select>

            <button  name="btn">Thêm Sách</button>
        </form>
    </div>

</body>
</html>
