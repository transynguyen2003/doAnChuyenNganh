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

// Lấy thông tin sách từ bảng 'sach'
$sql = "SELECT * FROM sach WHERE id_sach = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$this_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy danh sách danh mục
$sql_danh_muc = "SELECT * FROM danh_muc";
$stmt_danh_muc = $conn->prepare($sql_danh_muc);
$stmt_danh_muc->execute();
$danh_mucs = $stmt_danh_muc->fetchAll(PDO::FETCH_ASSOC);

// Lấy danh mục sách hiện tại từ bảng 'sach_danh_muc'
$sql_sach_danh_muc = "SELECT id_danh_muc FROM sach_danh_muc WHERE id_sach = ?";
$stmt_sach_danh_muc = $conn->prepare($sql_sach_danh_muc);
$stmt_sach_danh_muc->execute([$this_id]);
$existing_category = $stmt_sach_danh_muc->fetch(PDO::FETCH_ASSOC);
$selected_danh_muc = $existing_category ? $existing_category['id_danh_muc'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $ten_sach = $_POST['ten_sach'];
    $tac_gia = $_POST['tac_gia'];
    $gia = $_POST['gia'];
    $mo_ta = $_POST['mo_ta'];
    $so_luong = $_POST['so_luong'];
    $danh_muc = $_POST['danh_muc'];

    // Xử lý ảnh
    $img = $_FILES['img']['name'];
    $img_tmp_name = $_FILES['img']['tmp_name'];
    if (!empty($img)) {
        move_uploaded_file($img_tmp_name, '../user/img/' . $img);
    } else {
        $img = $row['hinh_anh']; // Giữ nguyên ảnh cũ nếu không chọn ảnh mới
    }

    // Cập nhật thông tin sách trong bảng 'sach'
    $update_sql = "UPDATE sach SET 
        ten_sach = ?, 
        tac_gia = ?, 
        gia_ban = ?, 
        mo_ta = ?, 
        so_luong = ?, 
        hinh_anh = ?
        WHERE id_sach = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->execute([$ten_sach, $tac_gia, $gia, $mo_ta, $so_luong, $img, $this_id]);

    // Cập nhật hoặc thêm lại mối quan hệ trong bảng 'sach_danh_muc'
    if ($selected_danh_muc) {
        $update_danh_muc_sql = "UPDATE sach_danh_muc SET id_danh_muc = ? WHERE id_sach = ?";
        $update_danh_muc_stmt = $conn->prepare($update_danh_muc_sql);
        $update_danh_muc_stmt->execute([$danh_muc, $this_id]);
    } else {
        $insert_danh_muc_sql = "INSERT INTO sach_danh_muc (id_sach, id_danh_muc) VALUES (?, ?)";
        $insert_danh_muc_stmt = $conn->prepare($insert_danh_muc_sql);
        $insert_danh_muc_stmt->execute([$this_id, $danh_muc]);
    }

    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <h2>Sửa Thông Tin Sách</h2>
    <form action="edit.php?this_id=<?php echo $this_id; ?>" method="POST" enctype="multipart/form-data">
        <label for="ten_sach">Tên Sách:</label>
        <input type="text" id="ten_sach" name="ten_sach" value="<?php echo $row['ten_sach'] ?>" required>

        <label for="tac_gia">Tác Giả:</label>
        <input type="text" id="tac_gia" name="tac_gia" value="<?php echo $row['tac_gia'] ?>" required>

        <label for="gia">Giá Sách:</label>
        <input type="number" id="gia" name="gia" value="<?php echo $row['gia_ban'] ?>" required>

        <label for="mo_ta">Mô Tả:</label>
        <textarea id="mo_ta" name="mo_ta" rows="4" required><?php echo $row['mo_ta'] ?></textarea>

        <label for="so_luong">Số Lượng:</label>
        <input type="number" id="so_luong" name="so_luong" value="<?php echo $row['so_luong'] ?>" required>

        <label for="img">Hình ảnh:</label>
        <img class="product-image" src="../user/img/<?php echo $row['hinh_anh']; ?>" alt="Hình ảnh sản phẩm">
        <input type="file" id="img" name="img">

        <label for="danh_muc">Danh Mục:</label>
        <select id="danh_muc" name="danh_muc" required>
                <option value="1">Tiểu thuyết</option>
                <option value="2">Khoa học</option>
                <option value="3">Lịch sử</option>   
                <option value="4">Phát triển bản thân</option> 
                <option value="5">Tâm lý</option> 
                <option value="6">Văn học trẻ</option> 
            </select>

        <button type="submit">Lưu Chỉnh Sửa</button>
    </form>
</div>

