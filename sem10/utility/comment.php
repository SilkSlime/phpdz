<?php
$request = "INSERT INTO `comments` (`product_id`, `user_id`, `comment`, `username`) VALUES ($product_id, $user_id, \"$comment\", \"$username\");";
$result = mysqli_query($conn, $request);
