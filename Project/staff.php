<?php
session_start();
include("config.php");
// Nếu chưa đăng nhập thì quay về login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM menu ";
$result = $conn->query($sql);
if(!$result){
    die("Loi SQL: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff</title>
    <style>
        body{
            background-color:#cdad88;
        }
        .menu{
            display:flex;
            gap:20px;
            flex-wrap:wrap;
        }
        .card{
            width:220px;
            border:1px solid #ccc;
            padding:10px;
            text-align: center;
            border-radius: 10px;
            background-color:white;

        }
        .card img{
            width:100%;
            height:180px;
            object-fit:cover;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <div class="menu">
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="card">
                <img src = "images/<?php echo $row['image']; ?>">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo number_format($row['price']); ?> VND</p>
            </div>
       <?php } ?>
    </div>

    <a href="logout.php">Logout</a>
</body>
</html>