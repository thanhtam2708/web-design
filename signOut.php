<?php
session_start();
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
} elseif (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}
header("location:quantri/index.php");
die;