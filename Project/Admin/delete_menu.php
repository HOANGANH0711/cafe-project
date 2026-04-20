<?php 
include 'config.php'; 
$id = intval($_GET['id']);

// Lấy tên ảnh để xóa file vật lý
$res = mysqli_query($conn, "SELECT image FROM menu WHERE id=$id");
$row = mysqli_fetch_assoc($res);
if($row['image']) {
    unlink("../uploads/".$row['image']);
}

mysqli_query($conn, "DELETE FROM menu WHERE id=$id");
header("Location: index.php");
?>