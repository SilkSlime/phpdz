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
$p_id = get("p_id");
$next = get("next");
?>
<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    $query = "DELETE FROM `paragraphs` WHERE `id`=$p_id;";
    mysqli_query($connection, $query);
}
redirect("../$next");
?>