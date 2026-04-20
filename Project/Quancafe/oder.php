<?php
include 'config.php';

$table_id = $_POST['table_id'];
$menu_id = $_POST['menu_id'];
$quantity = $_POST['quantity'];

$result = mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE table_id=$table_id 
    AND status='Đang order'
    LIMIT 1
");

if(mysqli_num_rows($result) > 0){
    $order = mysqli_fetch_assoc($result);
    $order_id = $order['id'];
}else{
    
    mysqli_query($conn, "
        INSERT INTO orders(table_id, status, total) 
        VALUES($table_id, 'Đang order', 0)
    ");
    $order_id = mysqli_insert_id($conn);
}

$menu = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT price FROM menu WHERE id=$menu_id
"));
$price = $menu['price'];

mysqli_query($conn,"
    INSERT INTO order_details(order_id,menu_id,quantity,price)
    VALUES($order_id,$menu_id,$quantity,$price)
");

mysqli_query($conn, "
    UPDATE orders 
    SET total = (
        SELECT SUM(quantity * price) 
        FROM order_details 
        WHERE order_id = $order_id
    )
    WHERE id = $order_id
");

header("Location: index.php");
exit();
?>