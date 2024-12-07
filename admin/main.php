<section class="content mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary fw-bold">Danh sách sản phẩm</h4>
                        <a href="addSach.php"><button  class="btn btn-success"><i class="fas fa-plus-circle me-2" onclick="">
                    </i>Thêm sản phẩm mới</button></a>         
                      
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
    <thead class="table-primary">
        <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Mô tả danh mục</th>
            <th>Hoạt động</th>
        </tr>
    </thead>
    <tbody>
    <?php
        try {
            // Truy vấn dữ liệu
            $sql = "SELECT * FROM sach";
            $stmt = $conn->query($sql); // Sử dụng phương thức query để thực hiện câu lệnh SQL

            if ($stmt->rowCount() > 0) { // Sử dụng rowCount để đếm số bản ghi trả về
                $i = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Sử dụng fetch(PDO::FETCH_ASSOC) để lấy dữ liệu
                    $i++;
                    echo "<tr>";
                    echo "<td><p>" . $i . "</p></td>";
                    echo "<td><p>" . $row["ten_sach"] . "</p></td>";
                    echo "<td><p>" . $row["mo_ta"] . "</p></td>";
    ?>
            <td>
                <a href="edit.php?this_id=<?php echo $row['id_sach']; ?>">
                    <button class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i>
                    </button>
                </a>
                <a href="delete.php?this_id=<?php echo $row['id_sach']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này không?')">
                    <button class="btn btn-sm btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </a>
            </td>
        </tr>
    <?php
                }
            } else {
                echo "<tr><td colspan='4'>Không có danh mục nào!</td></tr>";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage(); // Bắt lỗi và hiển thị thông báo
        }
    ?>
    </tbody>
</table>

                    </div>
                </section>