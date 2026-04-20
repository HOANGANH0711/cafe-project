<?php
session_start();
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // chỉ tìm theo username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        // kiểm tra mật khẩu đã hash
        if(password_verify($password, $user['password'])){

            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] == 'admin'){
                header("Location: Admin/index.php");
            }else{
                header("Location: Quancafe/index.php");
            }
            exit();

        }else{
            $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu!";
            header("Location: login.php");
            exit();
        }

    }else{
        $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu!";
        header("Location: login.php");
        exit();
    }
}
?>