<?php 
include 'config.php'; 
// ===== XỬ LÝ AJAX =====
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $result = mysqli_query($conn, "SELECT status FROM tables_cafe WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
    
    $newStatus = ($row['status'] == 'Trống') ? 'Có khách' : 'Trống';
    
    mysqli_query($conn, "UPDATE tables_cafe SET status='$newStatus' WHERE id=$id");
    
    echo $newStatus;
    exit();
    }
 $table_id = $_GET['table_id'] ?? 1;   
include 'header.php'; 
// ===== LẤY DỮ LIỆU =====
$tables = mysqli_query($conn, "SELECT * FROM tables_cafe");
?>

<link rel="stylesheet" href="style.css">
<div class="row">
<div class="row">
        <div class="col-md-8">
            <h3 class="mb-4" style="color: #4e342e; font-weight: bold;">☕ Menu Đồ Uống</h3>
            <div class="row g-3">
                <?php 
                    if(isset($_GET['category'])){
                        $category = $_GET['category'];
                        $sql_menu = "SELECT * FROM menu WHERE category='$category'";
                    }else{
                        $sql_menu = "SELECT * FROM menu";
                    }

                    $result_menu = mysqli_query($conn, $sql_menu);

                    while($item = mysqli_fetch_assoc($result_menu)): 
                ?>
                <div class="col-md-4 mb-3"> <div class="card h-100 shadow-sm border-0">
                        <img src="../Admin/images/<?php echo $item['image']; ?>" 
                             style="width: 100%; height: 120px; object-fit: cover;" alt="Ảnh">
                        <div class="card-body p-2 text-center">
                            <h6 class="card-title fw-bold small mb-1"><?php echo $item['name']; ?></h6>
                            <p class="text-success small mb-2"><?php echo number_format($item['price']); ?>đ</p>
                            <button class="btn btn-success btn-sm w-100" onclick="buyNow(<?php echo $item['id']; ?>, '<?php echo $item['name']; ?>', <?php echo $item['price']; ?>)">Mua ngay</button>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <hr class="my-5">
            <h3 class="mb-4" style="color: #4e342e; font-weight: bold;">🪑 Sơ đồ bàn</h3>
            <div class="d-flex flex-wrap gap-3 mb-5">
                <?php
                $sql_tables = "SELECT * FROM tables_cafe";
                $result_tables = mysqli_query($conn, $sql_tables);
                while($table = mysqli_fetch_assoc($result_tables)):
                    $class = ($table['status'] == 'Có khách') ? 'bg-danger' : 'bg-success';
                ?>
                <div id="table-<?php echo $table['id']; ?>" 
                     class="table-item p-3 <?php echo $class; ?> text-white rounded shadow-sm text-center"
                     style="width: 100px; cursor: pointer;"
                     onclick="toggleTable(<?php echo $table['id']; ?>)">
                    <span class="fw-bold"><?php echo $table['table_name']; ?></span><br>
                    <small><?php echo $table['status']; ?></small>
                </div>
                <?php endwhile; ?>
            </div>
        </div> <div class="col-md-4">
            <div class="card shadow-sm p-3 border-0" style="position: sticky; top: 20px; border-top: 5px solid #4e342e;">
                <h3 class="mb-3" style="color: #4e342e;" id="bill-title">🧾 Hóa đơn - Bàn <?php echo $table_id; ?></h3>
                <div class="bill-box">
<?php
$table_id = $_GET['table_id'] ?? 1;

$sql = "
    SELECT m.name, od.quantity, od.price
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    JOIN menu m ON m.id = od.menu_id
    WHERE o.table_id = $table_id
    AND o.status = 'Đang order'
";

$result = mysqli_query($conn, $sql);
$total = 0;
?>

<ul class="list-group mb-3">
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <?php 
            $sub = $row['quantity'] * $row['price'];
            $total += $sub;
        ?>
        <li class="list-group-item d-flex justify-content-between small border-0">
            <span>
                <?php echo $row['name']; ?> x <?php echo $row['quantity']; ?>
            </span>
            <strong>
                <?php echo number_format($sub); ?>đ
            </strong>
        </li>
    <?php endwhile; ?>
</ul>

<hr>

<h5 class="text-end">
    Tổng: 
    <span class="text-danger fw-bold">
        <?php echo number_format($total); ?>đ
    </span>
</h5>
                    <form action="payment.php" method="POST">
                        <input type="hidden" name="table_id" value="<?php echo $table_id ?>">

                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Thanh toán
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let currentTable = <?php echo $table_id; ?>;
function toggleTable(id) {
    document.getElementById("bill-title").innerText =
        "🧾 Hóa đơn - Bàn " + id;
    let card = document.getElementById("table-" + id);
    let statusText = card.querySelector("small");

    card.style.transform = "scale(0.95)";

    fetch("index.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + id
    })
    .then(res => res.text())
    .then(data => {
        data = data.trim();
        statusText.innerText = data;

        setTimeout(() => {
            card.classList.remove("bg-danger", "bg-success");

        if (data === "Có khách") {
            card.classList.add("bg-danger");
        } else {
            card.classList.add("bg-success");
        }

            card.style.transform = "";

             // ✅ thêm dòng này
            window.location = "index.php?table_id=" + id;
        }, 150);
    });
}
</script>
<script>
let total = 0;

function buyNow(menu_id) {
    fetch("oder.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "table_id=" + currentTable + "&menu_id=" + menu_id + "&quantity=1"
    })
    .then(() => {
        window.location = "index.php?table_id=" + currentTable;
    });
}


</script>
<?php include 'footer.php'; ?>