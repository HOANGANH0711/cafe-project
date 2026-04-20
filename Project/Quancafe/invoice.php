
<?php
include "config.php";

$table_id = $_POST['table_id'] ?? 1;

$order = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE table_id=$table_id AND status='Đang order'
"));

if(!$order){
    echo "Không có hóa đơn!";
    exit();
}

$order_id = $order['id'];

$result = mysqli_query($conn, "
    SELECT m.name, od.quantity, od.price
    FROM order_details od
    JOIN menu m ON m.id = od.menu_id
    WHERE od.order_id=$order_id
");

$total = 0;
?>

<h2>🧾 HÓA ĐƠN THANH TOÁN</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Món</th>
    <th>Số lượng</th>
    <th>Tiền</th><?php
include "config.php";

$table_id = $_POST['table_id'] ?? 1;

$order = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM orders 
    WHERE table_id=$table_id AND status='Đang order'
"));

if(!$order){
    echo "<h3>Không có hóa đơn!</h3>";
    exit();
}

$order_id = $order['id'];

$result = mysqli_query($conn, "
    SELECT m.name, od.quantity, od.price
    FROM order_details od
    JOIN menu m ON m.id = od.menu_id
    WHERE od.order_id=$order_id
");

$total = 0;
?>

<h2>🧾 HÓA ĐƠN THANH TOÁN</h2>
<p>Bàn: <?php echo $table_id; ?></p>
<p>Thời gian: <?php echo date("d/m/Y H:i"); ?></p>

<table border="1" cellpadding="10" width="100%">
<tr>
    <th>Món</th>
    <th>SL</th>
    <th>Tiền</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): 
    $sub = $row['quantity'] * $row['price'];
    $total += $sub;
?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo number_format($sub); ?>đ</td>
</tr>
<?php endwhile; ?>

</table>

<h3>Tổng tiền: <?php echo number_format($total); ?>đ</h3>

<form action="payment.php" method="POST">
    <input type="hidden" name="table_id" value="<?php echo $table_id; ?>">
    <button type="submit">Xác nhận thanh toán</button>
</form>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): 
    $sub = $row['quantity'] * $row['price'];
    $total += $sub;
?>
<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td><?php echo number_format($sub); ?>đ</td>
</tr>
<?php endwhile; ?>

</table>

<h3>Tổng: <?php echo number_format($total); ?>đ</h3>

<form action="payment.php" method="POST">
    <input type="hidden" name="table_id" value="<?php echo $table_id; ?>">
    <button type="submit">Xác nhận thanh toán</button>
</form>