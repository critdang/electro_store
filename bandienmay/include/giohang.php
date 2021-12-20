<?php
 if(isset($_POST['themgiohang'])) {
 	$tensanpham = $_POST['tensanpham'];
 	$sanpham_id = $_POST['sanpham_id'];
 	$hinhanh = $_POST['hinhanh'];
 	$gia = $_POST['giasanpham'];
 	$soluong = $_POST['soluong'];
 	
 	$sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 	$count = mysqli_num_rows($sql_select_giohang);
 	if($count>0){
 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
 		$soluong = $row_sanpham['soluong'] + 1;
 		$sql_giohang = "UPDATE tbl_giohang SET soluong= '$soluong' WHERE sanpham_id='$sanpham_id'";
 	}else{
 		$soluong = $soluong;
 		$sql_giohang = "INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";
 	}
 	$insert_row = mysqli_query($con,$sql_giohang);
 	if($insert_row==0) {
 		header('Location:index.php?quanly=chitiesp&id='.$sanpham_id);
 	}

 }elseif(isset($_POST['capnhatsoluong'])){


 	for ($i=0;$i<count($_POST['product_id']);$i++) {
 	 	$sanpham_id = $_POST['product_id'][$i];
 		$soluong = $_POST['soluong'][$i];
 		if($soluong <=0){
 			$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}else{
 		$sql_update = mysqli_query($con,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
 	}
 }

 }elseif(isset($_GET['xoa'])){
 	$id = $_GET['xoa'];
 	$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE giohang_id='$id'");
}elseif(isset($_GET['dangxuat'])){
	$id = $_GET['dangxuat'];
	if($id==1){
		unset($_SESSION['dangnhap_home']);
		//viết code trên giỏ hàng nên 0 thể . ? nếu không nhảy vào trang index mà nó thực hiện
	}


 }elseif(isset($_POST['thanhtoan'])){
 	$name = $_POST['name'];
 	$phone = $_POST['phone'];
 	$email = $_POST['email'];
 	$password = md5($_POST['password']);
 	$note = $_POST['note'];
 	$address = $_POST['address'];
 	$giaohang = $_POST['giaohang'];

 	// <!-- Trường nào tương ứng biến nào mà lấy được -->
 	$sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,email,address,note,giaohang,password) values('$name','$phone','$email','$address','$note','$giaohang','$password')");
 	if($sql_khachhang){
 		// Lấy tất cả từ table khách hàng sắp xếp theo id khách hàng giảm dần và limit 1 object cho 1 lần
 		$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
 		$mahang = rand(0,9999);
 		// 1 khách hàng cho 1 lần thì k cần lôi ra nữa
	 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
	 		$khachhang_id = $row_khachhang['khachhang_id'];
	 		$_SESSION['dangnhap_home'] = $row_khachhang['name'];//khi điền full thông tin thì tạo session mới. giống như topbar
	 		$_SESSION['khachhang_id'] = $khachhang_id;
	 		for ($i=0;$i<count($_POST['thanhtoan_product_id']);$i++) {

	 	 	$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
 			$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

	 }
 }elseif(isset($_POST['thanhtoandangnhap'])){

 	$khachhang_id = $_SESSION['khachhang_id'];//lấy được khách hàng id từ bên topbar sau khi đăng kí và đăng nhập 
	//chỉ cần lấy 1 khách nên k cần vòng lặp
 	// <!-- Trường nào tương ứng biến nào mà lấy được -->
 		// Lấy tất cả từ table khách hàng sắp xếp theo id khách hàng giảm dần và limit 1 object cho 1 lần
 		$mahang = rand(0,9999);
 		// 1 khách hàng cho 1 lần thì k cần lôi ra nữa
	 		//khi điền full thông tin thì tạo session mới. giống như topbar
	 		for ($i=0;$i<count($_POST['thanhtoan_product_id']);$i++) {
	 	 	$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values('$sanpham_id','$soluong','$mahang','$khachhang_id')");
 			$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

	 }
 
?>


	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Checkout
			</h3>
			<?php 
			if(isset($_SESSION['dangnhap_home'])){
				echo '<p style="color:#000";>Xin chào bạn: '.$_SESSION['dangnhap_home'].'<a href="index.php?quanly=giohang&dangxuat=1"> Logout</a></p>';
			}else{
				echo '';
			}
			?>
			<!-- //tittle heading -->

			<div class="checkout-right">
			<?php 
			$sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
			?>

			
				</h4>
				<div class="table-responsive">
					<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>SL No.</th>
								<th>Product</th>
								<th>Quality</th>
								<th>Product Name</th>

								<th>Price</th>
								<th>Total</th>
								<th>Remove</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 0;
						$total = 0;
						while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){

							$subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
							$total+=$subtotal;
							$i++;
						?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="images/<?php echo $row_fetch_giohang['hinhanh'] ?>" alt=" " height="120" class="img-responsive">
									</a>
								</td>
								<td class="invert">
									<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
									<input type="hidden"  name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
								</td>
								<td class="invert"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_fetch_giohang['giasanpham']).'vnd' ?></td>
								<td class="invert"><?php echo number_format($subtotal).'vnd' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">Delete</a>
								</td>
							</tr>
							<?php
							}
							?>
							<tr >
								<td colspan = "7"> Total Price: <?php echo number_format($total).'vnd' ?></td>

							</tr>
							<tr>
								<td colspan = "7"><input type="submit" class="btn btn-success"  value="Update" name="capnhatsoluong">
								<?php
								$sql_giohang_select = mysqli_query($con,"SELECT * FROM tbl_giohang");
								$count_giohang_select = mysqli_num_rows($sql_giohang_select);

								if(isset($_SESSION['dangnhap_home']) && $count_giohang_select>0){
									//thanh toán đăng nhập chỉ tồn tại khi có sản phẩm và session
									while($row_1 = mysqli_fetch_array($sql_giohang_select)){
								?>

								<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
								<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
								<?php 
								}
								?>
								<input type="submit" class="btn btn-primary"  value="Checkout cart" name="thanhtoandangnhap">
								<?php 
								}
								?>
								
								</td>
							
							</tr>
						</tbody>
					</table>
				</form>
				</div>
			</div>
			<?php
				if(!isset($_SESSION['dangnhap_home'])){
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Add a new Details</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Full Name" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Mobile Number" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Address" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Password" name="password" required="">
									</div>
									<div class="controls form-group">
										 <textarea style="resize:none;" class="form-control"  placeholder="Note" name="note" required=""></textarea> 
									</div>
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Select Method to deliver</option>
											<option value="1">Internet Banking</option>
											<option value="2">Cash </option>
											<option value="3">Visa</option>

										</select>
									</div>
								</div>
								<?php 
								$sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
								while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){
								?>
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
									<input type="hidden"  name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
								<?php
								}
								?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%;" value="Submit"  ></button>
							</div>
						</div>
					</form>
					<div class="checkout-right-basket">
						<a href="payment.html">Make a Payment
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>
	<!-- //checkout page -->