<div class="main-slider pattern-overlay">
	<?php 
	include("../connect.php");
	 try {
            // Truy vấn dữ liệu
            $sql = "SELECT * FROM sach";
            $stmt = $conn->query($sql); // Sử dụng phương thức query để thực hiện câu lệnh SQL

            if ($stmt->rowCount() > 0) { // Sử dụng rowCount để đếm số bản ghi trả về
                $i = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { // Sử dụng fetch(PDO::FETCH_ASSOC) để lấy dữ liệu
                    $i++;
                  
    ?>
				<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title"><?php echo $row["ten_sach"] ; ?></h2>
								<p><?php echo $row["mo_ta"] ; ?></p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
											class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div><!--banner-content-->
							
							<img src="images/<?php echo $row["hinh_anh"] ; ?>" alt="banner" class="banner-image">
						</div><!--slider-item-->

    <?php
                }
            } else {
                echo "<tr><td colspan='4'>Không có danh mục nào!</td></tr>";
            }
        } catch (PDOException $e) {
            echo "Lỗi: " . $e->getMessage(); // Bắt lỗi và hiển thị thông báo
        }
    ?>


					
						
						<div class="slider-item">
							<div class="banner-content">
								<h2 class="banner-title">Birds gonna be Happy</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
									ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
									urna, a eu.</p>
								<div class="btn-wrap">
									<a href="#" class="btn btn-outline-accent btn-accent-arrow">Read More<i
											class="icon icon-ns-arrow-right"></i></a>
								</div>
							</div>
							<img src="images/main-banner2.jpg" alt="banner" class="banner-image">
						</div>

					</div>