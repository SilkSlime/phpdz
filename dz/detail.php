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
$query = "SELECT * FROM `contents` WHERE `id`=$content_id;";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$content_date = $row["date"];
$content_theme = $row["theme"];
$content_title = $row["title"];
$content_description = decode($row["description"]);
$content_rating = $row["rating"];
$content_author = $row["author"];
?>

<?php
echo "
<div class=\"card text-left mt-5 mb-5 w-100\">
    <div class=\"card-header\"><h2>$content_title</h2></div>
    <div class=\"card-body\">
        <div class=\"form-row\">
            <div class=\"col-md-8\">
                <p><b>
                    $content_description
                </b></p>
            </div>
            <div class=\"col-md-4\">
                <div class=\"text-right\">$content_date</div>
                <div class=\"text-right\">Theme:<b> $content_theme</b></div>
                <div class=\"text-right\">Author: $content_author</div>
            </div>
        </div>
        ";
$query = "SELECT * FROM `paragraphs` WHERE `content_id` = $content_id ORDER BY `order`;";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $p_title = $row["title"];
    $p_language = $row["language"];
    $p_text = decode($row["text"]);
    echo "<h3>$p_title</h3>";
    if ($p_language != "plaintext") {
        echo "<pre><code class=\"$p_language\">";
        echo htmlentities($p_text);
        echo "</code></pre>";
    } else {
        echo "<p>";
        echo htmlentities($p_text);
        echo "</p>";
    }
}
echo "</div>
      <div class=\"card-footer\">";
////
echo "<div class=\"form-row\">";
echo "<div class=\"col-md-4\">
        <a class=\"btn btn-primary btn-outline btn-block disabled\" href>Rating: $content_rating/5</a>
      </div>";
if (in_array("RATE",$user_permissions)) {
    echo "<div class=\"col-md-4 text-center\">";
    render("rating_form", NULL, NULL, $content_id);
    echo "</div>";
    echo "<div class=\"col-md-4\">
              <button class=\"btn btn-success btn-outline btn-block\" type=\"submit\" form=\"rating\">Rate!</button>
          </div>";

} else {
    echo "<div class=\"col-md-8 text-center\">";
    alert("You don't have permission to rate!");
    echo "</div>";
}
echo "</div></div></div>";
?>

<div class="card m-3 mb-5">
    <div class="card-header">
        <h3>Comments</h3>
    </div>
    <div class="card-body">
        <?php
        if (in_array("COMMENT", $user_permissions)){
            echo "<form action=\"comment.php?content_id=$content_id\" method=\"POST\">
            <div class=\"input-group\">
                <textarea row=\"5\" class=\"form-control\" placeholder=\"Comment something...\" name=\"comment\"></textarea>
                <div class=\"input-group-append\">
                    <button class=\"btn btn-outline-success\" type=\"submit\">Comment</button>
                </div>
            </div>
        </form>";
        } else {
            alert("You don't have enough permission for that!");
        }
        ?>
    </div>
    <ul class="list-group list-group-flush">
    <?php
        $query = "SELECT * FROM `comments` WHERE `content_id`=$content_id ORDER BY UNIX_TIMESTAMP(`date`) DESC;";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $username = $row["username"];
            $text = htmlentities(decode($row["text"]));
            echo "<li class=\"list-group-item\"><b>$username: </b>$text</li>";
        }
    ?>
    </ul>
</div>

<script src="src/js/rateicon.js"></script>
<?php mysqli_close($connection);
require "render/template_end.php"; ?>