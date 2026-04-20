<?php
include "config.php";

$table_id = $_POST['table_id'];

// lấy đúng order đang order
$order = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE table_id=$table_id 
    AND status='Đang order'
    LIMIT 1
"));

$order_id = $order['id'];

// cập nhật trạng thái
mysqli_query($conn, "
    UPDATE orders 
    SET status='Đã thanh toán' 
    WHERE id=$order_id
");

echo "<script>alert('Thanh toán thành công'); window.location='index.php';</script>";
?>