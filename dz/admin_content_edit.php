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
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (!in_array("ADMIN", $user_permissions)) redirect("index.php");
//----- ----- ----- GET/POST VARIABLES ----- ----- -----//
$content_id = get("content_id");
?>

<?php
//----- ----- ----- CHECK PERMISSIONS ----- ----- -----//
if (in_array("ADMIN", $user_permissions)) {
    $query = "SELECT * FROM `contents` WHERE `id`=$content_id";
    $row = mysqli_fetch_assoc(mysqli_query($connection, $query));
    $title = $row["title"];
    $theme = $row["theme"];
    $description = $row["description"];
    $description = decode($description);
    echo "
    <div class=\"card m-3\">
        <div class=\"card-header text-center\"><h3>Edit Content</h3></div>
        <div class=\"card-body\">
            <form action=\"admin_content_edit.php?content_id=$content_id\" method=\"POST\" id=\"form\">
                <h4>Title</h4>
                <input class=\"form-control\" type=\"text\" name=\"title\" value=\"$title\" required>
                <h4>Theme</h4>
                <input class=\"form-control\" type=\"text\" name=\"theme\" value=\"$theme\" required>
                <h4>Description</h4>
                <textarea class=\"form-control\" rows=\"5\" name=\"description\" required>$description</textarea>
            </form>
        </div>
        <div class=\"card-footer\">";
    form_button("Edit!", "success", true);
    echo "
        </div>
    </div>";
    ?>
    <?php
    if ($method == "POST" and in_array("ADMIN", $user_permissions)) {
        $title = post("title");
        $theme = post("theme");
        $description = post("description");

        $description = encode($description);

        $query = "UPDATE `contents` SET `title`=\"$title\", `theme`=\"$theme\", `description`=\"$description\" WHERE `id`=\"$content_id\" ;";
        $result = mysqli_query($connection, $query);
        redirect("admin_content.php", 1);
        echo "<h1><a href=\"admin_content.php\">Если вас не перенаправило, кликните сюда...</a></h1>";
    }
    ?>
    <?php
    echo "<a class=\"btn btn-block btn-primary\" href=\"admin_paragraph_create.php?content_id=$content_id\">Create new paragraph</a>";
    $query = "SELECT * FROM `paragraphs` WHERE `content_id` = $content_id ORDER BY `order`;";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $p_id = $row["id"];
        $p_title = $row["title"];
        $p_language = $row["language"];
        $p_text = $row["text"];
        $p_order = $row["order"];
        echo "
        <div class=\"card m-3\">
            <div class=\"card-header\">
                <h3>
                    <span class=\"badge badge-secondary\">$p_order</span>
                    $p_title
                </h3>
            </div>
            <div class=\"card-body\">";
        if ($p_language != "plaintext") {
            echo "<pre><code class=\"$p_language\">";
            $p_text = decode($p_text);
            echo htmlentities($p_text);
            echo "</code></pre>";
        } else {
            echo "<p>";
            $p_text = decode($p_text);
            echo htmlentities($p_text);
            echo "</p>";
        }
        echo "
            </div>
            <div class=\"card-footer\">
                <a class=\"btn btn-sm btn-warning btn-outline\" href=\"admin_paragraph_edit.php?p_id=$p_id\">Edit</a>
                <a class=\"btn btn-sm btn-danger btn-outline\"
                   href=\"admin_delete/delete_paragraph.php?p_id=$p_id&next=admin_content_edit.php?content_id=$content_id\">Delete</a>
            </div>
        </div>
        ";
    }
}
?>



<?php mysqli_close($connection);
require "render/template_end.php"; ?>