<?php
require "utility/functions.php";
session_start();
$connection = mysql_start();
$user = session("user");
$user_permissions = get_user_permissions_from_db($connection, $user["id"]);
//----- ----- ----- VARIABLES ----- ----- -----//
$site_title = "Sign Up";
$method = $_SERVER["REQUEST_METHOD"];
//----- ----- ----- VARIABLES ----- ----- -----//
render("template_start");
render("navbar", $user, $user_permissions);
//----- ----- ----- VARIABLES ----- ----- -----//
if (!in_array("ADMIN", $user_permissions)) redirect("index.php");
//----- ----- ----- VARIABLES ----- ----- -----//
$p_id = get("p_id");
?>

<?php
$query = "SELECT * FROM `paragraphs` WHERE `id`=$p_id";
$row = mysqli_fetch_assoc(mysqli_query($connection, $query));
$content_id = $row["content_id"];
$title = $row["title"];
$language = $row["language"];
$order = $row["order"];
$text = $row["text"];
$text = htmlentities(decode($text));
?>

<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    echo "<div class=\"card m-3\">
    <div class=\"card-header text-center\"><h3>Edit Paragraph</h3></div>
    <div class=\"card-body\">
        <form action=\"admin_paragraph_edit.php?p_id=$p_id\" method=\"POST\" id=\"form\">
            <h4>Order</h4>
            <input class=\"form-control\" type=\"number\" name=\"order\" value=\"$order\" required>
            <h4>Title</h4>
            <input class=\"form-control\" type=\"text\" name=\"title\" value=\"$title\" required>
            <h4>Language</h4>
            <select class=\"form-control\" name=\"language\" value=\"css\">
                <option>plaintext</option>
                <option>php</option>
                <option>html</option>
                <option>css</option>
                <option>c++</option>
                <option>python</option>
            </select>
            <h4>Text</h4>
            <textarea class=\"form-control\" rows=\"25\" name=\"text\" required>$text</textarea>
        </form>
    </div>
    <div class=\"card-footer\">";
    form_button("Edit", "success", true);
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
    $query = "UPDATE `paragraphs` SET `title`=\"$title\", `language`=\"$language\", `text`='$text', `order`=\"$order\" WHERE `id`=$p_id;";
    mysqli_query($connection, $query);
    redirect("admin_content_edit.php?content_id=$content_id", 1);
    echo "<h1><a href=\"admin_content_edit.php?content_id=$content_id\">Если вас не перенаправило, кликните сюда...</a><h1>";
}
?>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>