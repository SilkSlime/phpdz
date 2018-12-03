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

<div class="card text-center mt-5">
    <div class="card-header"><h3>Sign Up</h3></div>
    <div class="card-body">
        <?php
        if (!$user) {
            render("signup_form");
        }
        else {
            alert("You are already auth! But you can logout to register an another account...", "warning");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if (!$user) {
            form_button("Sign Up!", "success", true);
            if ($method == "POST") {
                $new_user["email"] = post("email");
                $new_user["username"] = post("username");
                $new_user["name"] = post("name");
                $new_user["surname"] = post("surname");
                $new_user["group"] = post("group");
                $new_user["pass"] = post("pass");
                $new_user["pass2"] = post("pass2");
                $errors = check_signup($connection, $new_user);
                if (!$errors) {
                    create_user($connection, $new_user);
                    redirect("signin.php");
                } else {
                    print_errors($errors);
                }
            }
        }
        ?>
    </div>
</div>

<?php mysqli_close($connection);
require "render/template_end.php"; ?>