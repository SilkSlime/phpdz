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

    <div class="jumbotron mt-5">
        <h1 class="display-4">КТИ</h1>
        <p class="lead">
            КТИ
        </p>
        <hr class="my-4">
        <p>КТИ</p>
    </div>
    <div class="mb-5">
        <?php
        $query = "SELECT * FROM `contents` WHERE `theme` = \"cti\" AND `forum` = 0 ORDER BY UNIX_TIMESTAMP(`date`) DESC;";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $title = $row["title"];
            $description = $row["description"];
            $content_id = $row["id"];
            echo "
            <div class=\"card m-3\">
            <div class=\"card-header\">
                <h3>$title (NEW!)</h3>
            </div>
            <div class=\"card-body\">
                $description
            </div>
            <div class=\"card-footer\">
                <a class=\"btn btn-block btn-primary btn-outline\" href=\"detail.php?content_id=$content_id\">See detail...</a>
            </div>
        </div>
            ";
        }
        ?>
    </div>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>