<?php
require_once "../connection.php";
if ($_GET['user_id']) {
    $user_id = $_GET['user_id'];
    $sql = "DELETE from user where user_id = $user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $msg = "Xóa thành công";
    header("location:user.php");
    die;
}