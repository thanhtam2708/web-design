<?php
require_once "../connection.php";
if ($_GET['pro_id']) {
    $pro_id = $_GET['pro_i'];
    $sql = "DELETE from products where pro_id = $pro_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $msg = "Xóa thành công";
    header("location:product.php");
    die;
}