<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some quality items</span>
						</div>
						<h2 class="section-title">Popular Books</h2>
					</div>

					<ul class="tabs">
						<li data-tab-target="#all-genre" class="active tab">Sách tiểu thuyết</li>
						<li data-tab-target="#business" class="tab">Sách Khoa Học</li>
						<li data-tab-target="#technology" class="tab">Sách Lịch Sử</li>
						<li data-tab-target="#romantic" class="tab">Sách Phát Triển Bản Thân</li>
						<li data-tab-target="#adventure" class="tab">Sách Tâm Lý</li>
						<li data-tab-target="#fictional" class="tab">Sách Văn Học Trẻ</li>
					</ul>

					<div class="tab-content">
						<div id="all-genre" data-tab-content class="active">
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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

								<!-- <div class="col-md-3">
									<div class="product-item">
										<figure class="product-style">
											<img src="images/tab-item2.jpg" alt="Books" class="product-item">
											<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to
												Cart</button>
										</figure>
										<figcaption>
											<h3>Once upon a time</h3>
											<span>Klien Marry</span>
											<div class="item-price">$ 35.00</div>
										</figcaption>
									</div>
								</div> -->

							

							</div>
							
						</div>
						<div id="business" data-tab-content>
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
							WHERE dm.ten_danh_muc = 'Khoa học'
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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
								

							</div>
						</div>

						<div id="technology" data-tab-content>
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
							WHERE dm.ten_danh_muc = 'Phát triển bản thân'
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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
								
							</div>
						</div>

						<div id="romantic" data-tab-content>
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
							WHERE dm.ten_danh_muc = 'Lịch sử'
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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
							</div>
						</div>

						<div id="adventure" data-tab-content>
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
							WHERE dm.ten_danh_muc = 'Tâm lý'
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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
							</div>
						</div>

						<div id="fictional" data-tab-content>
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
							WHERE dm.ten_danh_muc = 'Văn học trẻ'
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
											<div class="item-price"><?php echo $row['gia_ban']; ?> VNĐ</div>
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
							</div>
						</div>

					</div>

				</div>