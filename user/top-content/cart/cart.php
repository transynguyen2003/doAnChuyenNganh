<?php
// Include file connect.php cho PDO
include '../../connect.php';

// Bắt đầu session
session_start();
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

// Làm rỗng giỏ hàng
if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) {
    unset($_SESSION['giohang']);
}

// Xóa sản phẩm trong giỏ hàng
if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['giohang'], $_GET['delid'], 1);
}

// Lấy dữ liệu từ form thêm sản phẩm
if (isset($_POST['addcart']) && ($_POST['addcart'])) {
    $hinh = $_POST['hinh_anh'];
    $tensp = $_POST['ten_sach'];
    $gia = $_POST['gia_ban'];
    $soluong = $_POST['so_luong'];
    $id_sach = $_POST['id_sach']; // Sửa lại cú pháp
    $fl = 0;

    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        if ($_SESSION['giohang'][$i][1] == $tensp) {
            $fl = 1;
            $_SESSION['giohang'][$i][3] += $soluong;
            break;
        }
    }

    if ($fl == 0) {
        $sp = [$hinh, $tensp, $gia, $soluong, $id_sach]; // Thêm id_sach vào giỏ hàng
        $_SESSION['giohang'][] = $sp;
    }
}


// Hiển thị giỏ hàng
function showgiohang()
{
    if (isset($_SESSION['giohang']) && is_array($_SESSION['giohang'])) {
        if (sizeof($_SESSION['giohang']) > 0) {
            $tong = 0;
            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                $tt = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                $tong += $tt;
                echo '<tr>
                        <td>' . ($i + 1) . '</td>
                        <td><img src="../../img/' . $_SESSION['giohang'][$i][0] . '" alt=""></td>
                        <td>' . $_SESSION['giohang'][$i][1] . '</td>
                        <td>' . $_SESSION['giohang'][$i][2] . '</td>
                        <td>' . $_SESSION['giohang'][$i][3] . '</td>
                        <td>' . $tt . '</td>
                        <td><a href="cart.php?delid=' . $i . '">Xóa</a></td>
                    </tr>';
            }
            echo '<tr>
                    <th colspan="5">Tổng đơn hàng</th>
                    <th>' . $tong . '</th>
                </tr>';
        } else {
            echo "Giỏ hàng rỗng!";
        }
    }
}

// Xử lý đặt hàng
if (isset($_POST['dathang']) && $_POST['dathang']) {
    if (!isset($_SESSION['id_nguoi_dung'])) {
        echo "<script>alert('Vui lòng đăng nhập để đặt hàng.');</script>";
        header("Location: ../../login/index.php"); // Đường dẫn đến trang đăng nhập
        exit;
    }

    $hoten = $_POST['hoten'];
    $diachi = $_POST['diachi'];
    $dienthoai = $_POST['dienthoai'];
    $email = $_POST['email'];
    $pttt = $_POST['pttt'];
    $giohang = $_SESSION['giohang'];
    $tongdonhang = 0;

    foreach ($giohang as $sp) {
        $tongdonhang += $sp[2] * $sp[3];
    }

    try {
        // Lưu thông tin đơn hàng
        $sql = "INSERT INTO don_hang (id_nguoi_dung, hoten, diachi, dienthoai, email, pttt, tongdonhang, ngaydat) 
        VALUES (:id_nguoi_dung, :hoten, :diachi, :dienthoai, :email, :pttt, :tongdonhang, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id_nguoi_dung' => $_SESSION['id_nguoi_dung'],
            ':hoten' => $hoten,
            ':diachi' => $diachi,
            ':dienthoai' => $dienthoai,
            ':email' => $email,
            ':pttt' => $pttt,
            ':tongdonhang' => $tongdonhang,
        ]);


        $id_donhang = $conn->lastInsertId();

        // Lưu thông tin chi tiết đơn hàng
        $sql_ct = "INSERT INTO chi_tiet_don_hang (id_donhang, tensp, dongia, soluong, id_sach)
        VALUES (:id_donhang, :tensp, :dongia, :soluong, :id_sach)";
        $stmt_ct = $conn->prepare($sql_ct);

        foreach ($giohang as $sp) {
        $stmt_ct->execute([
            ':id_donhang' => $id_donhang,
            ':tensp' => $sp[1],
            ':dongia' => $sp[2],
            ':soluong' => $sp[3],
            ':id_sach' => $sp[4], // Sử dụng id_sach đã lưu trong giỏ hàng
        ]);
        }


        // Xóa giỏ hàng sau khi đặt hàng thành công
        unset($_SESSION['giohang']);
        echo "<script>alert('Đặt hàng thành công! Cảm ơn bạn đã mua sắm.');</script>";
    } catch (PDOException $e) {
        echo "Lỗi khi đặt hàng: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | View Cart</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="boxcenter">
        <div class="row mb header">
            <h1> SIÊU THỊ TRỰC TUYẾN</h1>
        </div>
        <div class="row mb menu">
            <ul>
                <li><a href="../../index.php">Trang chủ</a></li>
                <li><a href="cart.php">Giỏ hàng</a></li>
                <li><a href="#">Liên hệ</a></li>
                <li><a href="#">Góp ý</a></li>
                <li><a href="#">Hỏi đáp</a></li>
            </ul>
        </div>
        <div class="row mb ">
            <form action="" method="post"></form>
            <div class="boxtrai mr" id="bill">
                <div class="row">
                    <h1>THÔNG TIN NHẬN HÀNG</h1>
                    <form action="" method="post">
                        <table class="thongtinnhanhang">
                            <tr>
                                <td width="20%">Họ tên</td>
                                <td><input type="text" name="hoten" required></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td><input type="text" name="diachi" required></td>
                            </tr>
                            <tr>
                                <td>Điện thoại</td>
                                <td><input type="text" name="dienthoai" required></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" name="email" required></td>
                            </tr>
                            <tr>
                                <td>
                                    Thanh toán khi nhận hàng <input type="radio" name="pttt" value="1" required>
                                    Thanh toán bằng ví momo <input type="radio" name="pttt" value="2">
                                    Thanh toán chuyển khoản <input type="radio" name="pttt" value="3">
                                </td>
                            </tr>
                        </table>
                        <input type="submit" value="ĐỒNG Ý ĐẶT HÀNG" name="dathang">
                    </form>
                </div>
                <div class="row mb">
                    <h1>GIỎ HÀNG</h1>
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Hình</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền ($)</th>
                            <th>Xóa</th>
                        </tr>
                        <?php showgiohang(); ?>
                    </table>
                </div>
                <div class="row mb">
                    <a href="cart.php?delcart=1"><input type="button" value="XÓA GIỎ HÀNG"></a>
                    <a href="index.php"><input type="button" value="TIẾP TỤC ĐẶT HÀNG"></a>
                </div>
            </div>
        </div>
        <div class="row mb footer">
            Copyright © 2021 - HOTB
        </div>
    </div>
</body>

</html>
