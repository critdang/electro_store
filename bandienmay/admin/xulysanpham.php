<?php 
	include('../db/connect.php');
?>
<?php

	if(isset($_POST['themsanpham'])){
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'] ?? "";
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'] ?? "";
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';

		$sql_insert_product = mysqli_query($con,"INSERT INTO tbl_sanpham(sanpham_name,sanpham_chitiet,sanpham_mota,sanpham_gia,sanpham_giakhuyenmai,sanpham_soluong,sanpham_image,category_id) values ('$tensanpham','$chitiet','$mota','$gia','$giakhuyenmai','$soluong','$hinhanh','$danhmuc')");
		move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
	}elseif(isset($_POST['capnhatsanpham'])){
		$id_update = $_POST['id_update'];
		$tensanpham = $_POST['tensanpham'];
		$hinhanh = $_FILES['hinhanh']['name'] ?? "";
		$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'] ?? ""; 
		// hỗ trợ upload
		$soluong = $_POST['soluong'];
		$gia = $_POST['giasanpham'];
		$giakhuyenmai = $_POST['giakhuyenmai'];
		$danhmuc = $_POST['danhmuc'];
		$chitiet = $_POST['chitiet'];
		$mota = $_POST['mota'];
		$path = '../uploads/';

		if($hinhanh=='') {
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name ='$tensanpham',sanpham_chitiet ='$chitiet',sanpham_mota ='$mota',sanpham_gia ='$gia',sanpham_giakhuyenmai ='$giakhuyenmai',sanpham_soluong ='$soluong',category_id ='$danhmuc' WHERE sanpham_id='$id_update'";
		}else{
			move_uploaded_file($hinhanh_tmp,$path.$hinhanh);
			$sql_update_image = "UPDATE tbl_sanpham SET sanpham_name ='$tensanpham',sanpham_chitiet ='$chitiet',sanpham_mota ='$mota',sanpham_gia ='$gia',sanpham_giakhuyenmai ='$giakhuyenmai',sanpham_soluong ='$soluong',sanpham_image='$hinhanh',category_id ='$danhmuc' WHERE sanpham_id='$id_update'";
		}
		mysqli_query($con,$sql_update_image);
	}

?>
<?php 
	if(isset($_GET['xoa'])){
		$id = $_GET['xoa'];
		$sql_xoa = mysqli_query($con,"DELETE FROM tbl_sanpham WHERE sanpham_id = '$id'");
		$path_delete = '../uploads/';

	}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
	<meta charset="utf-8">
	<title>Sản phẩm</title>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulydanhmucbaiviet.php">Danh mục bài viết</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulybaiviet.php">Bài viết</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Sản phẩm</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
	      </li>
	    </ul>
	  </div>
	</nav><br>
	<div class="container">
		<div class="row">
			 <?php 
				if(isset($_GET['quanly'])=='capnhat'){
					$id_capnhat = $_GET['capnhat_id'];
					$sql_capnhat = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_id = '$id_capnhat'");
					$row_capnhat = mysqli_fetch_array($sql_capnhat);
					$id_category_1 = $row_capnhat['category_id'];
					?>
					<div class="col-md-4">
					<h4>Cập nhật sản phẩm</h4>
					
					<form action="" method="POST" enctype="multipart/form-data">
						<label>Tên sản phẩm</label>
						<input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['sanpham_name'] ?>"> <br>
						<input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['sanpham_id'] ?>"> 
						<label>Hình ảnh</label>
						<input type="file" class="form-control" name="hinhanh"><br>
						<img src="../uploads/<?php echo $row_capnhat['sanpham_image']?>" height="80" width="80"><br>
						<label>Giá</label>
						<input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['sanpham_gia'] ?>"> <br>
						<label>Giá khuyến mãi</label>
						<input type="text" class="form-control" name="giakhuyenmai" value="<?php echo $row_capnhat['sanpham_giakhuyenmai'] ?>"> <br>
						<label>Số lượng</label>
						<input type="text" class="form-control" name="soluong" value="<?php echo $row_capnhat['sanpham_soluong'] ?>"> <br>
						<label>Mô tả</label>
						<textarea class="form-control" rows="10" name="mota"><?php echo $row_capnhat['sanpham_mota'] ?></textarea><br>
						<label>Chi tiết</label>
						<textarea class="form-control" rows="10" name="chitiet"><?php echo $row_capnhat['sanpham_chitiet'] ?></textarea><br>
						<label>Danh mục</label>
						<?php 
						$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC")
						 ?>
						<select name="danhmuc">
							<option value="" class="form-control">---------Chọn danh mục--------------</option>
							<?php 
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
									if($id_category_1 == $row_danhmuc['category_id']){
							?>
							<option selected value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name']?> 
							
							<?php 
								}else{
							?>
							<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name']?> 
							</option>
							<?php

								} 
							}
							?>
							</select><br>
						<input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
					</form>
					</div>
					<?php
					}else{
						?> 
					<div class="col-md-4">
					<h4>Thêm sản phẩm</h4>
					
					<form action="" method="POST" enctype="multipart/form-data">
						<label>Tên sản phẩm</label>
						<input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"> <br>
						<label>Hình ảnh</label>
						<input type="file" class="form-control" name="hinhanh"><br>
						<label>Giá</label>
						<input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"> <br>
						<label>Giá khuyến mãi</label>
						<input type="text" class="form-control" name="giakhuyenmai" placeholder="Giá khuyến mãi"> <br>
						<label>Số lượng</label>
						<input type="text" class="form-control" name="soluong" placeholder="Số lượng"> <br>
						<label>Mô tả</label>
						<textarea class="form-control" name="mota"></textarea><br>
						<label>Chi tiết</label>
						<textarea class="form-control" name="chitiet"></textarea><br>
						<label>Danh mục</label>
						<?php
						$sql_danhmuc = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC")
						 ?>
						<select name="danhmuc">
							<option value="" class="form-control">---------Chọn danh mục--------------</option>
							<?php 
								while($row_danhmuc = mysqli_fetch_array($sql_danhmuc)){
							?>
							<option value="<?php echo $row_danhmuc['category_id'] ?>"><?php echo $row_danhmuc['category_name']?> 
							</option>
							<?php 
							}
							?>
							</select><br>
						<input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
					</form>
					</div>
				 	<?php 
						}
					?> 
			
			<div class="col-md-4">
				<h4>Liệt kê sản phẩm</h4>
				<?php
				$sql_select_sp = mysqli_query($con,"SELECT * FROM tbl_sanpham,tbl_category WHERE tbl_sanpham.category_id = tbl_category.category_id ORDER BY tbl_sanpham.sanpham_id DESC"); 
				?> 
				<table class="table table-bordered ">
				<tr>
					<th>Thứ tự</th>
					<th>Tên sản phẩm</th>
					<th>Hình ảnh</th>
					<th>Số lượng</th>
					<th>Danh mục</th>
					<th>Giá sản phẩm</th>
					<th>Giá khuyến mãi</th>
					<th>Quản lý</th>
				</tr>
				<?php
				$i=0;
					while($row_sp = mysqli_fetch_array($sql_select_sp)){
						$i++;
				?> 
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row_sp['sanpham_name'] ?></td>
					<td><img src="../uploads/<?php echo $row_sp['sanpham_image'] ?>" height="80" width="80"></td>
					<td><?php echo $row_sp['sanpham_soluong'] ?></td>
					<td><?php echo $row_sp['category_name'] ?></td>
					<td><?php echo $row_sp['sanpham_gia'] ?></td>
					<td><?php echo $row_sp['sanpham_giakhuyenmai'] ?></td>
					<td><a href="?xoa=<?php echo $row_sp['sanpham_id'] ?>">Xóa</a> || <a href="?quanly=capnhat&capnhat_id=<?php echo $row_sp['sanpham_id'] ?>">Cập nhật</a></td>
				</tr>
				 <?php 
				}
				?> 
			</table>
			</div>
		</div>
	</div>
</body>
</html>