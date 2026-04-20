<?php
include 'config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = "";

    // nếu có upload ảnh
    if(!empty($_FILES['image']['name'])){

        // đổi tên ảnh
        $filename = str_replace(" ","_",$name);

        // lấy đuôi file
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // tạo tên ảnh mới
        $image = $filename."_".time().".".$ext;

        // upload ảnh
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
    }

    // thêm dữ liệu vào database
    $sql = "INSERT INTO menu (name, price, category, image) 
            VALUES ('$name','$price','$category','$image')";

    if(mysqli_query($conn,$sql)){
        header("Location: index.php");
        exit();
    }else{
        echo "Lỗi: ".mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="style.css">

<h2>Thêm món mới</h2>

<form method="POST" enctype="multipart/form-data">

    Tên: 
    <input type="text" name="name" required>
    <br><br>

    Giá: 
    <input type="number" name="price" required>
    <br><br>

    Loại:
    <select name="category">
        <option value="Coffee">Coffee</option>
        <option value="Tea">Tea</option>
        <option value="Juice">Juice</option>
        <option value="Smoothie">Smoothie</option>
    </select>
    <br><br>

    Ảnh:
    <input type="file" name="image">
    <br><br>

    <button type="submit" name="submit">Thêm</button>

</form>