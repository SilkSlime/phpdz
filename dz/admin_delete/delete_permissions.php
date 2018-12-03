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
$user_id = get("user_id");
$next = get("next");
?>
<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    $query = "SELECT * FROM `permissions` WHERE `user_id`=$user_id AND `permission`=\"ADMIN\";";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 0) {
        $query = "DELETE FROM `permission` WHERE `id`=$user_id;";
        mysqli_query($connection, $query);
    }
}
redirect("../$next");
?>