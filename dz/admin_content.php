<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Admin Content List";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- RENDER ----- ----- -----//
render("template_start");
render("navbar", $user, $user_permissions);
?>

<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
//Create new news button
    echo "<a class=\"btn btn-block btn-primary mt-3\" href=\"admin_content_create.php\">Create New!</a>";
//Get all contents
    $query = "SELECT * FROM `contents` ORDER BY UNIX_TIMESTAMP(`date`) DESC;";
    $result = mysqli_query($connection, $query);
//Render table header
    $row = mysqli_fetch_assoc($result);
    echo "<table class=\"table table-striped mt-3 text-center\"><thead><tr>";
    foreach ($row as $key => $value) {
        if ($key != "description") {
            echo "<th>$key</th>";
        }
    }
    echo "<th>Extra</th></tr></thead><tbody>";
//render table body
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $content_id = $row["id"];
        echo "<tr onclick=\"document.location = 'detail.php?content_id=$content_id';\">";
        foreach ($row as $key => $value) {
            if ($key != "description") {
                echo "<td>$value</td>";
            }
        }
        $content_id = $row["id"];
        echo "
    <td><div class=\"btn-group\" role=\"group\">
        <a class=\"btn btn-warning\" href=\"admin_content_edit.php?content_id=$content_id\">Edit</a>
        <a class=\"btn btn-danger\" href=\"admin_delete/delete_content.php?content_id=$content_id&next=admin_content.php\">Delete</a>
    </div></td></tr>";
    }
    echo "</tbody><table class=\"table table-striped mt-3 text-center\">";
}
?>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>