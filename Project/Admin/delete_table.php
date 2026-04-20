<?php 
include 'config.php'; 
// Ép kiểu ID về số nguyên để bảo mật
$id = (int)$_GET['id'];

// Thực hiện xóa
mysqli_query($conn, "DELETE FROM tables_cafe WHERE id=$id");

// Chuyển hướng về trang danh sách
header("Location: list_table.php");
exit(); 
// Đã xóa bỏ đoạn code dư thừa ở dưới dòng này
?>