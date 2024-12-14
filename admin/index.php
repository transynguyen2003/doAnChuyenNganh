
<?php
session_start();
ob_start();
if(isset($_SESSION['role']) &&$_SESSION['role']==1){
include("header.php");?>
<body>
    <?php include("connect.php");
           
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php
            if(isset($_GET['act'])){
                switch ($_GET['act']) {
                    case 'tac_gia':
                       include("tacGia.php");
                        break;
                    case 'danh_muc':
                        include("danhMuc.php");
                        break;
                     case 'tac_gia':
                       include("tacGia.php");
                        break;
                    case 'dang_xuat':
                        unset($_SESSION['role']);
                        header("location:../user/login/index.php");
                             break;
                    default:
                    include("sidebar.php");
                        break;
                }
            }
            else{
                include("sidebar.php");
            }
                         
            ?>
            <!-- Main Content -->
            <div class="col-md-10 main-content">
               <?php include("taskbar.php"); ?>

                <?php include("main.php"); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
}
else{
    header("location:../user/login/index.php");
   
}
?>
