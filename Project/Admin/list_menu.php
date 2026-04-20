<?php include 'config.php'; ?>
<link rel="stylesheet" href="style.css">
<table border="1" cellpadding="10">
    <tr>
        <th>STT</th><th>Tên</th><th>Giá</th><th>Ảnh</th><th>Loại</th><th>Hành động</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM menu");
    $stt = 1;
    while($row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $stt++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo number_format($row['price'], 0, ',', '.'); ?> đ</td>
        <td>
            <?php if($row['image'] != ""){ ?>
                <img src="../images/<?php echo trim($row['image']); ?>" width="80" alt="Lỗi ảnh">
            <?php } ?>
        </td>
        <td><?php echo $row['category']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Sửa</a> | 
            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Xóa hả?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>