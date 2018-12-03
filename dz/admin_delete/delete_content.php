<?php
require "../utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- GET/POST VARIABLES ----- ----- -----//
$content_id = get("content_id");
$next = get("next");
?>
<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    $query = "DELETE FROM `contents` WHERE `id`=$content_id;";
    mysqli_query($connection, $query);

    $query = "DELETE FROM `paragraphs` WHERE `content_id`=$content_id;";
    mysqli_query($connection,$query);
    $query = "DELETE FROM `comments` WHERE `content_id`=$content_id;";
    mysqli_query($connection,$query);
    $query = "DELETE FROM `ratings` WHERE `content_id`=$content_id;";
    mysqli_query($connection,$query);
}
//redirect("../$next");
?>