<?php
include "connect.php"; // Kết nối PDO từ file connect.php

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    // Truy vấn tìm kiếm sử dụng PDO
    $sql = "SELECT * FROM sach WHERE ten_sach LIKE :keyword OR tac_gia LIKE :keyword OR mo_ta LIKE :keyword";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['keyword' => "%$query%"]);

    // Lấy kết quả
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("header.php"); ?>

<body>
    <?php include("connect.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include("sidebar.php"); ?>
            <!-- Main Content -->
            <div class="col-md-10 main-content">
               <?php include("taskbar.php"); ?>

               <section class="content mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold">Danh sách sản phẩm</h4>
                        <a href="addSach.php">
                            <button class="btn btn-success">
                                <i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới
                            </button>
                        </a>         
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Sách</th>
                                    <th>Mô Tả</th>
                                    <th>Hoạt động</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php                              
                                if (count($result) > 0) {
                                    $i = 0;
                                    foreach ($result as $row) {
                                        $i++;
                                        echo "<tr>";
                                        echo "<td><p>" . $i . "</p></td>";
                                        echo "<td><p>" . htmlspecialchars($row["ten_sach"]) . "</p></td>";
                                        echo "<td><p>" . htmlspecialchars($row["mo_ta"]) . "</p></td>";                  
                            ?>                                                                                                                    
                                    <td>
                                        <a href="edit.php?this_id=<?php echo $row['id_sach'] ?>">
                                            <button class="btn btn-sm btn-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="delete.php?this_id=<?php echo $row['id_sach'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không?')">
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>Không tìm thấy sách phù hợp!</td></tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php 
} else {
    echo "<p>Hãy nhập từ khóa để tìm kiếm sách.</p>";
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>