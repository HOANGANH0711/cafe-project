<?php 
include 'config.php'; 
$id = intval($_GET['id']);
$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id=$id"));

if(isset($_POST['update'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['category'];

    if(!empty($_FILES['image']['name'])){

        // đổi tên món
        $newName = str_replace(" ", "_", $name);

        // lấy đuôi file
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // tên ảnh mới
        $image = $newName . "_" . time() . "." . $ext;

        // upload vào folder images
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/" . $image);

        // xóa ảnh cũ
        if($row['image'] && file_exists("../images/" . trim($row['image']))){
            unlink("../images/" . trim($row['image']));
        }

        // update có ảnh
        mysqli_query($conn, "
            UPDATE menu 
            SET name='$name',
                price='$price',
                category='$category',
                image='$image'
            WHERE id=$id
        ");

    } else {

        // update không đổi ảnh
        mysqli_query($conn, "
            UPDATE menu 
            SET name='$name',
                price='$price',
                category='$category'
            WHERE id=$id
        ");
    }

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa món</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3>QUẢN LÝ ADMIN</h3>
    <ul>
        <li><a href="index.php">☕ Quản lý Menu</a></li>
        <li><a href="list_table.php">🪑 Quản lý Bàn</a></li>
        <li><a href="list_users.php">👤 Quản lý Tài khoản</a></li>
        <li style="margin-top: 50px;">
            <a href="logout.php" style="background-color: #d32f2f;">🚪 Đăng xuất</a>
        </li>
    </ul>
</div>

<div class="main-content">
    <h2>Sửa món: <?= htmlspecialchars($row['name']) ?></h2>
    
    <form method="POST" enctype="multipart/form-data" class="form-container">
        <div class="form-group">
            <label>Tên món:</label>
            <input type="text" name="name" value="<?= $row['name'] ?>" required>
        </div>

        <div class="form-group">
            <label>Giá bán:</label>
            <input type="number" name="price" value="<?= $row['price'] ?>" required>
        </div>

        <div class="form-group">
            <label>Loại:</label>
            <select name="category">
                <option value="Coffee" <?= $row['category']=="Coffee"?"selected":"" ?>>Coffee</option>
                <option value="Tea" <?= $row['category']=="Tea"?"selected":"" ?>>Tea</option>
            </select>
        </div>

        <div class="form-group">
            <label>Ảnh hiện tại:</label><br>
            <img src="../uploads/<?= $row['image'] ?>" width="120" style="border-radius: 8px; margin-bottom: 10px;">
        </div>

        <div class="form-group">
            <label>Chọn ảnh mới (để trống nếu không đổi):</label>
            <input type="file" name="image">
        </div>

        <button name="update" class="btn-submit">Cập nhật thay đổi</button>
        <a href="index.php" style="text-decoration: none; margin-left: 10px;">Hủy bỏ</a>
    </form>
</div>

</body>
</html>