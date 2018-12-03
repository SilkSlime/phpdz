<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- GET/POST VARIABLES ----- ----- -----//
$content_id = get("content_id");
$rating = (int)post("stars");
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("RATE", $user_permissions)) {
    if ($rating > 5) $rating = 5;
    if ($rating < 1) $rating = 1;

    $user_id = $user["id"];

    //Get all user rates for this content
    $query = "SELECT * FROM `ratings` WHERE `content_id` = $content_id AND `user_id` = $user_id;";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 0) {
        //If not rated
        $query = "INSERT INTO `ratings` (`content_id`, `user_id`, `rating`) VALUES ($content_id, $user_id, $rating);";
        mysqli_query($connection, $query);
    } else {
        //change rate
        $query = "UPDATE `ratings` SET `rating`=$rating WHERE `user_id` = $user_id;";
        mysqli_query($connection, $query);
    }

    //Find avg of rates
    $query = "SELECT `rating` FROM `ratings` WHERE `content_id` = $content_id;";
    $result = mysqli_query($connection, $query);
    $sum_rating = 0;
    $num_rating = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $sum_rating += $row["rating"];
    }
    if ($num_rating != 0) {
        $rating = $sum_rating / $num_rating;
        $query = "UPDATE `contents` SET `rating`=$rating WHERE `id`=$content_id;";
        mysqli_query($connection, $query);
    } else $rating = 0;

    redirect("detail.php?content_id=$content_id");
}
redirect("detail.php?content_id=$content_id");
