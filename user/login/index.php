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
	
	if (isset($_POST['login']) && $_POST['login']) {
		$name = $_POST['name'];
		$pass = $_POST['password'];
	
		// Gọi hàm checkUser để lấy thông tin người dùng
		$userInfo = checkUser($name, $pass);
	
		if ($userInfo != -1) {
			// Lưu id_nguoi_dung và role vào session
			$_SESSION['id_nguoi_dung'] = $userInfo['id_nguoi_dung'];
			$_SESSION['role'] = $userInfo['role'];
	
			// Điều hướng dựa trên role
			if ($_SESSION['role'] == 1) {
				header("Location: ../../admin/index.php");
			} else if ($_SESSION['role'] == 0) {
				header("Location: ../../user/index.php");
			}
		} else {
			$txt_err = "Tên đăng nhập hoặc mật khẩu không chính xác";
		}
	}
	$name = isset($_POST['name']) ? $_POST['name'] : ''; // Giữ giá trị của username
	$password = isset($_POST['password']) ? $_POST['password'] : ''; // Giữ giá trị của password

	
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
<style>
	.header-left-bottom input[type="submit"] {
    background: #ff3366;
    color: #FFF;
    font-size: 26px;
    padding: 0.3em 1.2em;
    width: 49.5%;
    font-weight: 500;
    transition: 0.5s all;
    -webkit-transition: 0.5s all;
    -moz-transition: 0.5s all;
    -o-transition: 0.5s all;
    display: inline-block;
    cursor: pointer;
    outline: none;
    border: none;
    border-radius: 3px;
    font-family: 'Roboto Condensed', sans-serif;
}
</style>
</head>
<body>
<!--header start here-->
<div class="header">
		<div class="header-main">
		       <h1>Classy Login Form</h1>
			<div class="header-bottom">
				<div class="header-right w3agile">
					
					<div class="header-left-bottom agileinfo">
						
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
						<?php 
							if (isset($txt_err) && $txt_err != "") {
								echo "<div style='color: red;'>$txt_err</div>";
							}
						?>
						<input type="text" name="name" placeholder="User name" value="<?php echo htmlspecialchars($name); ?>" />
						<input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>" />
						
						<div class="remember">
							<span class="checkbox1">
								<label class="checkbox"><input type="checkbox" name="remember_me" checked=""><i> </i>Remember me</label>
							</span>
							<div class="forgot">
								<h6><a href="#">Forgot Password?</a></h6>
							</div>
							<div class="clear"> </div>
						</div>

						<input type="submit" value="Register" name="register">
						<?php
						if (isset($_POST['register'])) {
							header("Location: register.php");
							exit();
						}
						?>

						<input type="submit" value="Login" name="login">						
					</form>

						<?php 
							if(isset($txt_err) && $txt_err!=""){
								echo $txt_err;
							}
						?>
					<input type="text"  value="User name" name="name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'User name';}"/>
					<input type="password"  value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
						<div class="remember">
			             <span class="checkbox1">
							   <label class="checkbox"><input type="checkbox" name="" checked=""><i> </i>Remember me</label>
						 </span>
						 <div class="forgot">
						 	<h6><a href="#">Forgot Password?</a></h6>
						 </div>
						<div class="clear"> </div>
					  </div>
					   
					  <input type="submit" value="Register" name="register">
					  <?php
						if (isset($_POST['register'])) {
							header("Location: register.php");
							exit();
						}
						?>

					  <input type="submit" value="Login" name="login">						
					</form>	
					<div class="header-left-top">
						<div class="sign-up"> <h2>or</h2> </div>
					
					</div>
					<div class="header-social wthree">
							<a href="#" class="face"><h5>Facebook</h5></a>
							<a href="#" class="twitt"><h5>Twitter</h5></a>
						</div>
						
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