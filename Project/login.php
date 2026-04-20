
<?php
session_start();
include("config.php");
if(isset($_GET['success'])){
    echo "Đã đăng nhập";
}
$error = "";
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coffee-Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background:url("background.jpg");
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            background: rgba(210, 180, 140, 0.9); /* Màu nâu nhạt trong suốt */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 { color: #fff; font-size: 3rem; margin-bottom: 5px; text-transform: uppercase; }
        h3 { color: #fff; margin-bottom: 30px; letter-spacing: 2px; }
        .input-group { margin-bottom: 20px; text-align: left; }
        label { display: block; color: #fff; font-weight: bold; margin-bottom: 5px; }
        input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 25px;
            background: #5d4037; /* Màu nâu đậm giống ảnh */
            color: white;
            box-sizing: border-box;
        }
        button {
            width: 150px;
            padding: 10px;
            border: none;
            border-radius: 20px;
            background: #4e342e;
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }
        button:hover { background: #3e2723; transform: scale(1.05); }
        .footer-links { margin-top: 20px; font-size: 0.9rem; }
        a { color: #3e2723; text-decoration: none; font-weight: bold; }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container { width: 90%; padding: 20px; }
            h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>LOG IN</h1>
        <h3>USER</h3>
        
        <form action="check_login.php" method="POST">
            <div class="input-group">
                <label>USERNAME</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label>PASSWORD</label>
                <input type="password" name="password" required>
            </div>
            <?php if($error != ""){ ?>
                <p style = "color:red; margin-top:5px;">
                    <?php echo $error; ?>
                </p>
            <?php } ?>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>