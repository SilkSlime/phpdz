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
$user_id = $user["id"];
$username = $user["username"];
$date = date("Y-m-d H:i:s");
$text = encode(post("comment"));

?>
<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("COMMENT", $user_permissions)) {
    $query = "INSERT INTO `comments` (`content_id`, `user_id`, `username`, `date`, `text`) VALUES ($content_id, $user_id, \"$username\", \"$date\", \"$text\");";
    mysqli_query($connection, $query);
    echo mysqli_error($connection);
}
redirect("detail.php?content_id=$content_id");
?>