<?php
require_once "../connection.php";
if ($_GET['cate_id']) {
    $cate_id = $_GET['cate_id'];
    $sql = "DELETE from categories where cate_id = $cate_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $msg = "Xóa thành công";
    header("location:cate.php");
    die;
}