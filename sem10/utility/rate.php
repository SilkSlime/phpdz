<?php
$rate = post("rate");
if ($rate > 5) {$rate = 5;}
if ($rate!=0) {
    if ($rated) {
        $request = "UPDATE `ratings` SET `rating`=$rate WHERE `product_id`=$product_id and `user_id`=$user_id;";
        $result = mysqli_query($conn, $request);
    } else {
        $request = "INSERT INTO `ratings` (`product_id`, `user_id`, `rating`) VALUES ($product_id, $user_id, $rate);";
        $result = mysqli_query($conn, $request);
    }

    $request = "SELECT `rating` FROM `ratings` WHERE `product_id`=$product_id;";
    $result = mysqli_query($conn, $request);

    $sumrating = 0.0;
    while ($row = mysqli_fetch_assoc($result)) {
        $sumrating += (int)$row["rating"];
    }
    $sumrating = (double)$sumrating / (double)mysqli_num_rows($result);

    $request = "UPDATE `items` SET `rating` = $sumrating WHERE `id` = $product_id;";
    $result = mysqli_query($conn, $request);
}
$rated = true;