<?php
$navbarname = "Register";
$title = "Register";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";
?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Register</h3></div>
    <div class="card-body">
        <?php
        if (!$logged) {
            require "render/reg_form.php";
        }
        else {
            alert("You are already auth! But you can logout to register an another account...", "warning");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (!$logged) {
            if (($method == "GET") && (!$logged)) {
                echo "<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"Register!\" form=\"form\">";
            }
            if ($method == "POST") {
                $email = $_POST["email"];
                $username = $_POST["username"];
                $pass = $_POST["pass"];
                $pass2 = $_POST["pass2"];

                $errors = array();

                require "utility/checkregister.php";

                if (!$errors) {
                    $request = "SELECT * FROM `users` WHERE `username` = \"$username\" or email = \"$email\";";
                    $result = mysqli_query($conn, $request);
                    if (mysqli_num_rows($result) > 0) {
                        $errors[] = "Already used username/email!";
                    } else {
                        $phash = password_hash($pass, PASSWORD_ARGON2I);
                        $request = "INSERT INTO `db_sem10`.`users` (`email`, `username`, `phash`) VALUES (\"$email\", \"$username\", \"$phash\")";
                        $result = mysqli_query($conn, $request);
                        if (!$result) {
                            $errors[] = "An error with DB, try later...";
                        }
                    }
                }

                if ($errors) {
                    submit_input("Register!");
                    foreach ($errors as $e) {
                        alert($e);
                    }
                } else {
                    alert("You are registrated now! Redirecting...", "success");
                    redirect("auth.php");
                }
            }
        }
        ?>
    </div>
</div>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>