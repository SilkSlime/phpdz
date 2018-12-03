<?php
$navbarname = "Edit Item";
$title = "Edit Item";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

$product_id = $_GET["id"];

if ($admin_flg) {
    $request = "DELETE FROM `items` WHERE `id` = $product_id;";
    $result = mysqli_query($conn, $request);
    $request = "DELETE FROM `ratings` WHERE `product_id` = $product_id;";
    $result = mysqli_query($conn, $request);
    $request = "DELETE FROM `comments` WHERE `product_id` = $product_id;";
    $result = mysqli_query($conn, $request);
}
redirect("index.php");
?>