<?php
$conn = mysqli_connect("localhost","root","","cafe_db");
if(!$conn){
    die("kết nối thất bại");
}
echo"Kết nối thành công";
?>
