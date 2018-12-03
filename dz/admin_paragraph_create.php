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
//----- ----- ----- GET/POST VARIABLES ----- ----- -----//
$content_id = get("content_id");
?>

<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    echo "<div class=\"card m-3\">
    <div class=\"card-header text-center\"><h3>Create Paragraph</h3></div>
    <div class=\"card-body\">
        <form action=\"admin_paragraph_create.php?content_id=$content_id\" method=\"POST\" id=\"form\">
            <h4>Order</h4>
            <input class=\"form-control\" type=\"number\" name=\"order\" required>
            <h4>Title</h4>
            <input class=\"form-control\" type=\"text\" name=\"title\" required>
            <h4>Language</h4>
            <select class=\"form-control\" name=\"language\">
                <option>plaintext</option>
                <option>php</option>
                <option>html</option>
                <option>css</option>
                <option>c++</option>
                <option>python</option>
            </select>
            <h4>Text</h4>
            <textarea class=\"form-control\" rows=\"25\" name=\"text\" required></textarea>
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
    $language = post("language");
    $order = post("order");
    $text = post("text");
    $text = encode($text);
    $query = "INSERT INTO `paragraphs` (`title`, `language`, `order`, `content_id`, `text`) VALUES (\"$title\", \"$language\", \"$order\", \"$content_id\",\"$text\");";
    mysqli_query($connection, $query);
    redirect("admin_content_edit.php?content_id=$content_id");
}
?>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>