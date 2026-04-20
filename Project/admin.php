<?php
session_start();

// Nếu chưa đăng nhập thì quay về login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
</head>
<body>
    <h2>Xin chào, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Đây là trang admin.</p>

    <a href="logout.php">Logout</a>
</body>
</html>