<?php include 'config.php'; ?>

<?php
$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: list_users.php");
?>