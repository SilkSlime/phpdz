<?php
session_start();
$navbarname = "Auth";
$title = "Auth";
$session = isset($_SESSION["logged"]);
if ($session) {
    $logged = $_SESSION["logged"];
    $username = $_SESSION["username"];
}
$method = $_SERVER["REQUEST_METHOD"];
require "templatestart.php";
?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Auth</h3></div>
    <div class="card-body">
        <?php
            if (!$logged) {
                echo "
<form action=\"auth.php\" method=\"POST\" id=\"form\">
<div class=\"form-row\">
    <div class=\"col-md-6 mb-3 mx-auto\">
        <label>Username</label>
        <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"username\" required>
    </div>
</div>
<div class=\"form-row\">
    <div class=\"col-md-6 mb-3 mx-auto\">
        <label>Password</label>
        <input type=\"password\" class=\"form-control\" name=\"pass\" placeholder=\"password\" required>
    </div>
</div>
</form>";
            } else {
                echo "
<div class=\"alert alert-warning\">
You are already auth!
</div>";
            }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (($method == "GET")&&(!$logged)) {
            echo "<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"Log in!\" form=\"form\">";
        }
        if ($method == "POST") {
            $username = $_POST["username"];
            $pass = $_POST["pass"];

            $okay = true;
            $errors = array();

            require 'db.php';
            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            $ID = $_GET["ID"];
            if (!$conn) {
                die("<h4>No connection db! " . mysqli_connect_error() . "</h4><br>");
            }

            $sql = "SELECT * FROM `users` WHERE `username` = \"$username\";";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) == 0) {
                $okay = false;
                $errors[] = "No username match!";
            } else {
                $row = mysqli_fetch_assoc($res);
                $phash = $row["phash"];
                $pver = password_verify($pass, $phash);
                if (!$pver) {
                    $okay = false;
                    $errors[] = "Wrong password!";
                }
            }
            if (!$okay) {
                echo "
<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"Log in!!\">
<div class=\"alert alert-danger mt-3\">
";
                foreach ($errors as $e) {
                    echo "<p>$e</p>";
                }
                echo "</div>";
            } else {
                $_SESSION["username"] = $username;
                $_SESSION["logged"] = true;
                header("Refresh:0; url=main.php");
            }
        }
        ?>
    </div>
</div>
<?php require "templateend.php";?>