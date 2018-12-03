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
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    echo "
    <div class=\"card m-3\">
        <div class=\"card-header text-center\"><h3>Create Content</h3></div>
        <div class=\"card-body\">
            <form action=\"admin_content_create.php\" method=\"POST\" id=\"form\">
                <h4>Title</h4>
                <input class=\"form-control\" type=\"text\" name=\"title\" required>
                <h4>Theme</h4>
                <input class=\"form-control\" type=\"text\" name=\"theme\" required>
                <h4>Description</h4>
                <textarea class=\"form-control\" rows=\"5\" name=\"description\" required></textarea>
            </form>
        </div>
        <div class=\"card-footer\">";
    form_button("Create", "success", true);
    echo "
        </div>
    </div>";
}
?>

<?php
if ($method == "POST" and in_array("ADMIN", $user_permissions)) {
    $title = post("title");
    $theme = post("theme");
    $description = post("description");
    $date = date("Y-m-d H:i:s");
    $user_id = $user["id"];
    $author = $user["username"];
    $description = encode($description);
    $query = "INSERT INTO `contents` (`title`, `theme`, `description`, `date`, `author`, `user_id`) VALUES (\"$title\", \"$theme\", \"$description\", \"$date\", \"$author\", $user_id);";
    mysqli_query($connection, $query);
    redirect("admin_content.php");
    }
?>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>