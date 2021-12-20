<?php
	session_start(); 
	if(!isset($_SESSION['dangnhap'])) {
		header('Location: index.php');
	}
		if(isset($_GET['login'])){
		$dangxuat = $_GET['login'];
	}else{
		$dangxuat = '';
	}
	if($dangxuat == 'dangxuat'){
		session_destroy();
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome Admin</title>
</head>
<body>
	<p>Xin chào : <?php echo $_SESSION['dangnhap'] ?><a href="?login=dangxuat">Đăng xuất</a></p>
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Đơn hàng <span class="sr-only">(current)</span></a>
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
	        <a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
	      </li>
	    </ul>
	  </div>
	</nav>
</body>
</html>