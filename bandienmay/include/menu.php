
	<?php
		$sql_category = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');

	?>	
	<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option value="">Menu</option>
							<?php
							while($row_category = mysqli_fetch_array($sql_category)){
							?>
							
							<option value="<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></option>
							<?php
								}?>
							?>
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="index.php">Home
								<span class="sr-only">(current)</span>
							</a>
						</li>
						<?php
							$sql_category_danhmuc = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
							while($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)) {
						?>
						<li class="nav-item  mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link " href="?quanly=danhmuc&id=<?php echo $row_category_danhmuc['category_id'] ?>" role="button" aria-haspopup="true" aria-expanded="false">
								<?php echo $row_category_danhmuc['category_name'] ?>
							</a>
						</li>
						<?php
						}
						?>
							<div class="dropdown-menu">
								<div class="agile_inner_drop_nav_info p-4">
									<h5 class="mb-3">TV, Appliances, Electronics</h5>
									<div class="row">
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												<li>
													<a href="product2.html">Televisions</a>
												</li>
												<li>
													<a href="product2.html">Home Entertainment Systems</a>
												</li>
												<li>
													<a href="product2.html">Headphones</a>
												</li>
												<li>
													<a href="product2.html">Speakers</a>
												</li>
												<li>
													<a href="product2.html">MP3, Media Players & Accessories</a>
												</li>
												<li>
													<a href="product2.html">Audio & Video Accessories</a>
												</li>
												<li>
													<a href="product2.html">Cameras</a>
												</li>
												<li>
													<a href="product2.html">DSLR Cameras</a>
												</li>
												<li>
													<a href="product2.html">Camera Accessories</a>
												</li>
											</ul>
										</div>
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												<li>
													<a href="product2.html">Musical Instruments</a>
												</li>
												<li>
													<a href="product2.html">Gaming Consoles</a>
												</li>
												<li>
													<a href="product2.html">All Electronics</a>
												</li>
												<li>
													<a href="product2.html">Air Conditioners</a>
												</li>
												<li>
													<a href="product2.html">Refrigerators</a>
												</li>
												<li>
													<a href="product2.html">Washing Machines</a>
												</li>
												<li>
													<a href="product2.html">Kitchen & Home Appliances</a>
												</li>
												<li>
													<a href="product2.html">Heating & Cooling Appliances</a>
												</li>
												<li>
													<a href="product2.html">All Appliances</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="?quanly=tintuc">About us</a>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<?php 
							$sql_danhmuctin = mysqli_query($con,"SELECT * FROM tbl_danhmuc_tin ORDER BY danhmuc_tin_id DESC");
							?>
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								News
							</a>
							<div class="dropdown-menu">
								<?php
								while ($row_danhmuctin= mysqli_fetch_array($sql_danhmuctin)) {
								?>
								<a class="dropdown-item" href="?quanly=tintuc&id_tin=<?php echo $row_danhmuctin['danhmuc_tin_id'] ?>"><?php echo $row_danhmuctin['tendanhmuc'] ?></a>
								<?php 
								}
								?>
							</div>
						</li>
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Trang
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="product.html">Sản phẩm mới</a>
								
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="checkout.html">Kiểm tra đơn hàng</a>
								<a class="dropdown-item" href="payment.html">Thanh toán</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Liên hệ</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>
	<!-- //navigation -->