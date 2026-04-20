
<?php 
include 'config.php'; 
include 'header.php'; 

$table_id = $_POST['table_id'] ?? 1;

$sql = "
SELECT m.name, od.quantity, od.price
FROM orders o
JOIN order_details od ON o.id = od.order_id
JOIN menu m ON m.id = od.menu_id
WHERE o.table_id = $table_id
AND o.status = 'Đang order'
";

$result = mysqli_query($conn,$sql);

$total = 0;
?>

<div class="container mt-4">
    <h2>🧾 HÓA ĐƠN THANH TOÁN</h2>

    <table class="table">
        <tr>
            <th>Món</th>
            <th>Số lượng</th>
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

    <h4 class="text-end">Tổng tiền: <?php echo number_format($total); ?>đ</h4>

    <form action="confirm_payment.php" method="POST">
        <input type="hidden" name="table_id" value="<?php echo $table_id; ?>">
        <button class="btn btn-success">Xác nhận thanh toán</button>
    </form>
</div>

<?php include 'footer.php'; ?>