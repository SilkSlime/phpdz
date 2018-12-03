<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Activation...";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- GET/POST VARIABLES ----- ----- -----//
$user_id = get("user_id");
?>
<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    set_default_permissions($connection, $user_id);
}
redirect("admin_users.php");
?>