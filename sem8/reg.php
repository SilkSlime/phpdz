<?php
session_start();
$navbarname = "Register";
$title = "Register";
$session = isset($_SESSION["logged"]);
if ($session) {
    $logged = $_SESSION["logged"];
    $username = $_SESSION["username"];
}
$method = $_SERVER["REQUEST_METHOD"];
require "templatestart.php";
?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Register</h3></div>
    <div class="card-body">
        <?php
        if (!$logged) {
            echo "
<form action=\"reg.php\" method=\"POST\" id=\"form\">
    <div class=\"form-row\">
        <div class=\"col-md-6 mb-3\">
            <label>Email</label>
            <input type=\"email\" class=\"form-control\" name=\"email\" placeholder=\"example@mail.com\" required>
        </div>
        <div class=\"col-md-6 mb-3\">
            <label>Username</label>
            <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"username\" required>
        </div>
    </div>
    <div class=\"form-row\">
        <div class=\"col-md-6 mb-3\">
            <label>Password</label>
            <input type=\"password\" class=\"form-control\" name=\"pass\" placeholder=\"password\" required>
        </div>
        <div class=\"col-md-6 mb-3\">
            <label>Repeat password</label>
            <input type=\"password\" class=\"form-control\" name=\"pass2\" placeholder=\"password\" required>
        </div>
    </div>
</form>
";
        } else {
            echo "
<div class=\"alert alert-warning\">
You are already auth! But you can logout to register an another account...
</div>";
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (($method == "GET")&&(!$logged)) {
            echo "<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"Register!\" form=\"form\">";
        }
        if ($method == "POST") {
            $email = $_POST["email"];
            $username = $_POST["username"];
            $pass = $_POST["pass"];
            $pass2 = $_POST["pass2"];

            $usernamepattern = "/^[A-Za-z][A-Za-z0-9_]{5,}/";
            $paspattern = "/(?=^.{8,}$)((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[,.!?:;\-%$#@&*^|\/\\~[\]{}]))^.*/";

            $success = true;
            $errors = array();

            //Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $success = false;
                $errors[] = "Email is bad!";
            }
            //Validate username
            if (!preg_match($usernamepattern, $username)) {
                $success = false;
                $errors[] = "Username is bad!";
            }
            //Validate password
            if (!preg_match($paspattern, $pass)) {
                $success = false;
                $errors[] = "Password is bad!";
            }
            if ($pass != $pass2) {
                $success = false;
                $errors[] = "Passwords are not equal!";
            }

            require 'db.php';
            $conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
            $ID = $_GET["ID"];
            if (!$conn) {$errors[] = "No connection to DB!";}

            $sql = "SELECT * FROM `users` WHERE `username` = \"$username\" or email = \"$email\";";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $success = false;
                $errors[] = "Already used username/email!";
            } else {
                $phash = password_hash($pass, PASSWORD_ARGON2I);
                $sql = "INSERT INTO `db_auth`.`users` (`email`, `username`, `phash`) VALUES (\"$email\", \"$username\", \"$phash\")";
                $res = mysqli_query($conn, $sql);
            }
            if (!$success) {
                foreach ($errors as $e) {
                    echo "<h4>$e</h4><br>";
                }
                echo "<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"Register!\" form=\"form\">";
            } else {
                echo "<h3>You are registrated now! Redirecting...</h3>";
                $_SESSION["username"] = $username;
                $_SESSION["logged"] = true;
                header("Refresh:0; url=main.php");
            }
        }
        ?>
    </div>
</div>
<?php require "templateend.php";?>