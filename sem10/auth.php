<?php
$navbarname = "Auth";
$title = "Auth";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";
?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Auth</h3></div>
    <div class="card-body">
        <?php
        if (!$logged) {
            require "render/auth_form.php";
        } else {
            alert("You are already auth!", "warning");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (!$logged) {
            if ($method == "GET") {
                submit_input("Log In!");
            }
            if ($method == "POST") {
                $username = post("username");
                $pass = post("pass");

                $errors = array();


                $request = "SELECT * FROM `users` WHERE `username` = \"$username\";";
                $result = mysqli_query($conn, $request);

                if (mysqli_num_rows($result) == 0) {
                    $errors[] = "No username match!";
                } else {
                    $row = mysqli_fetch_assoc($result);
                    $phash = $row["phash"];
                    $pver = password_verify($pass, $phash);
                    if (!$pver) {
                        $errors[] = "Wrong password!";
                    }
                }
                if ($errors) {
                    submit_input("Log In!");
                    foreach ($errors as $e) {
                        alert($e);
                    }
                } else {
                    $_SESSION["logged"] = 1;
                    $_SESSION["user_id"] = $row["id"];
                    $_SESSION["username"] = $username;
                    $_SESSION["admin_flg"] = $row["admin_flg"];
                    redirect("index2.php", 0);
                }
            }
        }
        ?>
    </div>
</div>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>