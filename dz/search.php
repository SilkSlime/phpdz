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
<?php
$query = "SELECT * FROM `contents` WHERE `forum` = 0 ORDER BY UNIX_TIMESTAMP(`date`) DESC;";
$result = mysqli_query($connection, $query);
?>
<table class="table table-hover mt-5">
    <thead>
    <tr>
        <th scope="col">Theme</th>
        <th scope="col">Title</th>
        <th scope="col">Rating</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
while ($row = mysqli_fetch_assoc($result)) {
    $content_id = $row["id"];
    $theme = $row["theme"];
    $title = $row["title"];
    $rating = $row["rating"];
    $date = $row["date"];
    echo "
    <tr onclick=\"document.location = 'detail.php?content_id=$content_id';\">
        <td>$theme</td>
        <td>$title</td>
        <td>$rating</td>
        <td>$date</td>
    </tr>
    ";
}
    ?>
    </tbody>
</table>
