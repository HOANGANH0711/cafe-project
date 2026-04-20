<?php
include 'config.php';
    $sql = mysqli_query($conn, "SELECT id from tables_cafe ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($sql);
    $next = $row ? $row['id'] + 1 : 1;
    $table_name = "Bàn" . $next;
    mysqli_query($conn,"INSERT INTO tables_cafe(table_name, status)
                        VALUES('$table_name','Trống')");
    header("location: list_table.php");
    exit();
?>