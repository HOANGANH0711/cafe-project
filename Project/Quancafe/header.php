<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">   
    <link rel="stylesheet" href="style_header.css">   
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-4 py-2">
        <div class="w-100 d-flex align-items-center justify-content-between">

            <!-- Bên trái: Logo -->
            <div class="logo">
                <span class="navbar-brand mb-0 fs-4">CAFE</span>
            </div>

            <!-- Ở giữa: Menu đồ uống -->
            <div class="menu-drink d-flex gap-4 text-white">
                <a href="index.php" class="text-white text-decoration-none">Tất cả</a>
                <a href="index.php?category=Coffee" class="text-white text-decoration-none">Cà phê</a>
                <a href="index.php?category=Tea" class="text-white text-decoration-none">Trà</a>
                <a href="index.php?category=Juice" class="text-white text-decoration-none">Nước ép</a>
                <a href="index.php?category=Smoothie" class="text-white text-decoration-none">Sinh tố</a>
            </div>

            <!-- Bên phải: Avatar + tên nhân viên -->
            <div class="staff-info d-flex align-items-center gap-2 text-white" onclick="toggleMenu()" style ="cursor:pointer">
                <img src="images/avatar.png" class="rounded-circle" width="40" height="40" style="object-fit:cover;">
                <span>
                    <?php echo $_SESSION['username']; ?>
                </span>
                <ul id="dropdownMenu" class = "menu-list">
                    <li><a href = "../logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <script>
        function toggleMenu(){
            let menu = document.getElementById("dropdownMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // click ngoài menu thì đóng
        document.addEventListener("click", function(e){
            let menu = document.getElementById("dropdownMenu");
            let staff = document.querySelector(".staff-info");

            if(!staff.contains(e.target)){
                menu.style.display = "none";
            }
        })
    </script>
</body>