<?php 
include "config.php"; 
session_start();
?>
<link rel="stylesheet" href="style.css">
<!-- POPUP THÊM MÓN -->
<div id="popupForm" class="popup-overlay">
    <div class="popup-content">
        <span class="close-btn" onclick="closeForm()">&times;</span>
        
        <h2>Thêm món mới</h2>
        <form action="add_menu.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
            <label>Tên:</label>
            <input type="text" name="name" required>
            </div>

            <div class="form-group">
            <label>Giá:</label>
            <input type="number" name="price" required>
            </div>

            <div class="form-group">
            <label>Loại:</label>
            <select name="category">
            <option value="Coffee">Coffee</option>
            <option value="Tea">Trà</option>
            <option value="Juice">Nước ép</option>
            <option value="Smoothie">Đá xay</option>
            <option value="Milktea">Trà sữa</option>
            </select>
            </div>

            <div class="form-group">
            <label>Ảnh:</label>
            <input type="file" name="image">
            </div>

            <button type="submit" name="submit" class="btn-submit">Thêm món</button>

        </form>
    </div>
</div>
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
    <h2 style="color: #3e2723;">Danh sách món uống</h2>

    <button onclick="openForm()" class="btn-add">+ Thêm món mới</button>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên món</th>
                <th>Giá bán</th>
                <th>Hình ảnh</th>
                <th>Loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $result = mysqli_query($conn, "SELECT * FROM menu");
            $stt = 1;
            while($row = mysqli_fetch_assoc($result)){ 
            ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><strong><?= $row['name'] ?></strong></td>
                <td style="color: #a52a2a;"><?= number_format($row['price'], 0, ',', '.') ?> đ</td>
                <td><img src="images/<?php echo $row['image']; ?>" width="80" style="border-radius: 8px;"></td>
                <td><?= $row['category'] ?></td>
                <td>
                    <a href="edit_menu.php?id=<?= $row['id'] ?>" style="color: #5d4037;">Sửa</a> | 
                    <a href="delete_menu.php?id=<?= $row['id'] ?>" style="color: #d32f2f;" onclick="return confirm('Xóa món này?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>


<script>
function openForm() {
    document.getElementById("popupForm").style.display = "flex";
}

function closeForm() {
    document.getElementById("popupForm").style.display = "none";
}

// click ra ngoài cũng đóng
window.onclick = function(event) {
    let popup = document.getElementById("popupForm");
    if (event.target === popup) {
        popup.style.display = "none";
    }
}
</script>