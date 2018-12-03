<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- RENDER ----- ----- -----//
render("template_start");
render("navbar", $user, $user_permissions);
?>

<div class="card text-center mt-5">
    <div class="card-header"><h3><?php echo $user["username"];?></h3></div>
    <div class="card-body text-left">
        <?php
            if ($user) {
                render("profile_view", $user, $user_permissions);
            }
        ?>
    </div>
    <div class="card-footer text-center">
        <?php
        if ($user) {
            echo "
            <div class=\"btn-group w-100\" role=\"group\">
                <a href=\"profile_edit.php\" class=\"btn btn-warning w-100\">Edit</a>
                <a href=\"profile_delete.php\" class=\"btn btn-danger w-100\">Delete</a>
            </div>
        ";
        }
        ?>
    </div>
</div>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>