<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some quality items</span>
						</div>
						<h2 class="section-title">Sách Tiểu Thuyet</h2>
					</div>
					<div class="product-list" data-aos="fade-up">
						<div class="row">
					<?php
					include("../connect.php"); // Kết nối cơ sở dữ liệu

					try {
						// Truy vấn sách thuộc danh mục "Tiểu thuyết"
						$sql = "
							SELECT s.*
							FROM sach s
							JOIN sach_danh_muc sd ON s.id_sach = sd.id_sach
							JOIN danh_muc dm ON sd.id_danh_muc = dm.id_danh_muc
							WHERE dm.ten_danh_muc = 'Tiểu thuyết'
						";
						$stmt = $conn->query($sql); // Thực hiện câu truy vấn

						if ($stmt->rowCount() > 0) { // Nếu có kết quả
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Duyệt từng bản ghi
								?>
							<div class="col-md-3">
								<div class="product-item">
									<figure class="product-style">
										<img src="img/<?php echo $row['hinh_anh']; ?>" alt="Books" class="product-item">
										<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
											Cart</button>
									</figure>
									<figcaption>
										<h3><?php echo $row['ten_sach']; ?></h3>
										<span><?php echo $row['tac_gia']; ?></span>
										<div class="item-price"><?php echo $row['gia_ban']; ?></div>
									</figcaption>
								</div>
							</div>
            <?php
        }
    } else {
        echo "<tr><td colspan='4'>Không có sách nào trong danh mục 'Tiểu thuyết'!</td></tr>";
    }
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage(); // Bắt lỗi và hiển thị thông báo
}
?>

						</div><!--ft-books-slider-->
					</div><!--grid-->


				</div>