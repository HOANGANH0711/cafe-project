<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Bàn - Cafe Admin</title>
    <style>
        :root {
            --dark-coffee: #3e2723;
            --medium-coffee: #5d4037;
            --light-coffee: #d7ccc8;
            --gold-coffee: #bcaaa4;
        }

        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            display: flex; 
            background-color: #fdf5e6; 
        }

        /* Sidebar cố định */
        .sidebar { 
            width: 260px; 
            background: var(--dark-coffee); 
            color: white; 
            height: 100vh; 
            position: fixed; 
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
        }

        .sidebar h3 { text-align: center; border-bottom: 1px solid var(--gold-coffee); padding-bottom: 15px; }
        .sidebar ul { list-style: none; padding: 0; margin-top: 30px; }
        .sidebar ul li { margin-bottom: 15px; }
        .sidebar ul li a { 
            display: block; text-decoration: none; color: white; padding: 12px; 
            background: var(--medium-coffee); border-radius: 8px; text-align: center; transition: 0.3s;
        }
        .sidebar ul li a:hover { background: var(--gold-coffee); color: var(--dark-coffee); font-weight: bold; }

        /* Nội dung chính */
        .main-content { margin-left: 300px; padding: 40px; width: 100%; }

        h2 { color: var(--dark-coffee); margin-bottom: 20px; }

        .btn-add { 
            text-decoration: none; background: #795548; color: white; 
            padding: 10px 20px; border-radius: 5px; display: inline-block; margin-bottom: 20px; 
        }
        .btn-add:hover { background: var(--dark-coffee); }

        table { 
            width: 100%; border-collapse: collapse; background: white; 
            border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th { background: var(--dark-coffee); color: white; padding: 15px; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:hover { background-color: #f9f9f9; }

        /* Badge trạng thái bàn */
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
        }
        .status-empty { background: #e8f5e9; color: #2e7d32; } /* Màu xanh cho bàn trống */

        .btn-delete {
            color: #d32f2f;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-delete:hover { text-decoration: underline; }
    </style>
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
    <h2>Danh sách bàn cafe</h2>
    <a href="add_table.php" class="btn-add">+ Thêm bàn mới</a>
    
    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên bàn</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Truy vấn dữ liệu từ bảng tables_cafe
            $result = mysqli_query($conn, "SELECT * FROM tables_cafe ORDER BY id DESC");
            $stt = 1;
            while($row = mysqli_fetch_assoc($result)){ 
            ?>
            <tr>
                <td><?= $stt++ ?></td>
                <td><strong><?= $row['table_name'] ?></strong></td>
                <td>
                    <span class="status-badge status-empty">
                        <?= $row['status'] ?>
                    </span>
                </td>
                <td>
                    <a href="deletetable.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa bàn này?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>