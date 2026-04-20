<?php 
include 'config.php'; 

// 1. XỬ LÝ THÊM TÀI KHOẢN (Máy xử lý nằm ở đây)
if(isset($_POST['add_user'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // Mã hóa mật khẩu để bảo mật
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users(username, password, role) VALUES('$username','$password','$role')";
    if(mysqli_query($conn, $sql)){
        header("Location: list_users.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Tài khoản - Cafe Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="sidebar">
    <h3>QUẢN LÝ ADMIN</h3>
    <ul>
        <li><a href="index.php">☕ Quản lý Menu</a></li>
        <li><a href="list_table.php">🪑 Quản lý Bàn</a></li>
        <li><a href="list_users.php">👤 Quản lý Tài khoản</a></li>
        <li><a href="list_invoice.php">🧾 Quản lý Hóa Đơn</a></li>
        <li style="margin-top: 15px;">
            <a href="../logout.php" class="btn-logout">Đăng xuất</a>
        </li>
    </ul>
</div>

<div class="main-content">
    <h2>Danh sách tài khoản hệ thống</h2>
    
    <button onclick="openForm()" class="btn-add">+ Thêm tài khoản mới</button>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên đăng nhập</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
            $stt = 1;
            while($row = mysqli_fetch_assoc($result)){ 
                $roleClass = ($row['role'] == 'admin') ? 'role-admin' : 'role-staff';
            ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><strong><?= htmlspecialchars($row['username']) ?></strong></td>
                <td>
                    <span class="role-badge <?= $roleClass ?>">
                        <?= htmlspecialchars($row['role']) ?>
                    </span>
                </td>
                <td>
                    <a href="delete_users.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Xóa tài khoản này?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div id="popupForm" class="popup-overlay">
    <div class="popup-content">
        <span class="close-btn" onclick="closeForm()">&times;</span>
        <h2 style="text-align: center; color: #3e2723;">Thêm tài khoản</h2>
        
        <form method="POST">
            <div class="form-group">
                <label>Tên đăng nhập:</label>
                <input type="text" name="username" required placeholder="Ví dụ: staff_01">
            </div>
            <div class="form-group">
                <label>Mật khẩu:</label>
                <input type="password" name="password" required placeholder="Nhập mật khẩu">
            </div>
            <div class="form-group">
                <label>Vai trò:</label>
                <select name="role">
                    <option value="staff">Staff (Nhân viên)</option>
                    <option value="admin">Admin (Quản trị)</option>
                </select>
            </div>
            <button type="submit" name="add_user" class="btn-submit">Lưu tài khoản</button>
        </form>
    </div>
</div>

<script>
    // Hàm mở và đóng Popup
    function openForm() { document.getElementById("popupForm").style.display = "flex"; }
    function closeForm() { document.getElementById("popupForm").style.display = "none"; }
    
    // Đóng Popup khi click ra ngoài vùng nội dung
    window.onclick = function(event) {
        if (event.target == document.getElementById("popupForm")) { closeForm(); }
    }
</script>

</body>
</html>