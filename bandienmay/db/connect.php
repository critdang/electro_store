<?php
$con = new mysqli("localhost","root","","bandienmay");

// Check connection
if (mysqli_connect_error()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();

}
// Change character set to utf8
$con -> set_charset("utf8");

?>