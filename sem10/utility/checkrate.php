<?php
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
$request = "SELECT * FROM `ratings` WHERE `user_id`=\"$user_id\" and `product_id`=\"$product_id\"";
$result = mysqli_query($conn, $request);
if (mysqli_num_rows($result) > 0) {
    $rated = true;
} else {
    $rated = false;
}