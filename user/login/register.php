<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<?php
session_start();
ob_start();

	include("../connect.php");
	include("../funtion/funtion.php");
	
	// if(isset ($_POST['login'])&& ($_POST['login'])){
	// 	$name=$_POST['name'];
	// 	$pass=$_POST['password'];
	// 	$role=checkUser($name,$pass);
	// 	$_SESSION['role']=$role;
	// 	if($role==1){
	// 		header("Location: ../../admin/index.php");
	// 	} 
	// 	else if($role==0)
	// 	{
	// 		header("Location: ../../user/index.php");
			
	// 	}
	// 	else 
	// 	{
	// 		$txt_err="user name hoặc password không chính xác";
	// 	}
	// }
    
    if (isset($_POST['register'])) {
        // Lấy dữ liệu từ form
        $username = trim($_POST['name']);
        $password = $_POST['password'];
        $email = trim($_POST['email']);
        $fullname = trim($_POST['ho_ten']);
        $address = trim($_POST['dia_chi']);
        $phone = trim($_POST['so_dien_thoai']);
    
        // Kiểm tra dữ liệu hợp lệ
        if (strlen($password) < 6) {
            echo "Mật khẩu phải có ít nhất 6 ký tự!";
            exit;
        }
    
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
        // Kết nối cơ sở dữ liệu và kiểm tra tồn tại tài khoản
        $conn = connectdb();
        $stmt = $conn->prepare("SELECT * FROM nguoi_dung WHERE ten_dang_nhap = :username OR email = :email");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            echo "Tên đăng nhập hoặc email đã tồn tại!";
            exit;
        }
    
        // Thêm tài khoản mới
        $stmt = $conn->prepare("
            INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, email, ho_ten, dia_chi, so_dien_thoai, role, ngay_tao) 
            VALUES (:username, :password, :email, :fullname, :address, :phone, 0, NOW())
        ");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            echo "Đăng ký thành công! <a href='../../user/login/index.php'>Đăng nhập ngay</a>";
        } else {
            echo "Đăng ký thất bại. Vui lòng thử lại!";
        }
    }
    ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Classy Login form Widget Flat Responsive Widget Template :: w3layouts</title>
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Classy Login form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<!--Google Fonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
<!--header start here-->
<div class="header">
		<div class="header-main">
		       <h1>Classy Register Form</h1>
			<div class="header-bottom">
				<div class="header-right w3agile">
					
					<div class="header-left-bottom agileinfo">
						
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">						
					<input type="text"  value="User name" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"required>
					<input type="password"  value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"required>
                    <input type="text"  value="Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'email';}"required>
                    <input type="text"  value="Fullname" name="ho_ten" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'ho_ten';}"required>
                    <input type="text"  value="Address" name="dia_chi" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dia_chi';}"required>
                    <input type="text"  value="Number" name="so_dien_thoai" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'so_dien_thoai';}"required>
						<div class="remember">
			             <span class="checkbox1">
							   <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember me</label>
						 </span>
						
						<div class="clear"> </div>
					  </div>
					   
					  <input type="submit" value="Register" name="register">					
					</form>					
				</div>
				</div>			  
			</div>
		</div>
</div>
<!--header end here-->
<div class="copyright">
	<p>© 2016 Classy Login Form. All rights reserved | Design by  <a href="http://w3layouts.com/" target="_blank">  W3layouts </a></p>
</div>
<!--footer end here-->
</body>
</html>