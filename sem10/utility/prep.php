<?php
session_start();
$issession = isset($_SESSION["logged"]);
if ($issession) {
    $logged = $_SESSION["logged"];
    $user_id = $_SESSION["user_id"];
    $username = $_SESSION["username"];
    $admin_flg = $_SESSION["admin_flg"];
}
$method = $_SERVER["REQUEST_METHOD"];