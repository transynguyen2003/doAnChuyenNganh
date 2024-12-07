<?php include("header.php");?>
<body>
    <?php include("connect.php");
           
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include("sidebar.php");
                         
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
