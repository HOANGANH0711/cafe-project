<?php include 'config.php'; ?>

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users(username, password, role)
        VALUES('$username','$password','$role')");

    header("Location: list.php");
}
?>

<h2>Thêm tài khoản</h2>

<form method="POST">
    Tài khoản: <input type="text" name="username"><br><br>
    Mật khẩu: <input type="password" name="password"><br><br>

    Vai trò:
    <select name="role">
        <option>admin</option>
        <option>staff</option>
    </select><br><br>

    <button name="submit">Thêm</button>
</form>