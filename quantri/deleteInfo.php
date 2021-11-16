<?php
require_once "../connection.php";
if ($_GET['info_id']) {
    $info_id = $_GET['info_id'];
    $sql = "DELETE from info where info_id = '$info_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $msg = "Xóa thành công";
    header("location:info.php");
    die;
}