<?php
function render($path, $user = NULL, $user_permissions = NULL, $content_id = NULL) {
    require "render/$path.php";
}

function alert($message, $type = "danger") {
    echo "
    <div class=\"alert alert-$type\" role=\"alert\">
        $message
    </div>
    ";
}

function print_errors($errors) {
    foreach ($errors as $e) {
        alert($e);
    }
}

function form_button($value, $type, $block = false, $outline = false, $form = "form") {
//
    $bclass = "btn";
    if ($outline) {$bclass = $bclass." btn-outline-$type";}
    else {$bclass = $bclass." btn-$type";}
    if ($block) {$bclass = $bclass." btn-block";}
    echo "<input class=\"$bclass\" type=\"submit\" value=\"$value\" form=\"$form\">";
}

function get($key) {
    return $_GET[$key];
}

function post($key){
    return $_POST[$key];
}

function session($key) {
    return $_SESSION[$key];
}

function redirect($url, $timer=0) {
    header("Refresh:$timer; url=$url");
}

function mysql_start() {
    $db_servername="localhost";
    $db_username="username";
    $db_password="password";
    $db_name="database";
    $connection = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
    return $connection;
}

function mysql_end($connection) {
    mysqli_close($connection);
}

function get_user_permissions_from_db($connection, $user_id) {
    $user_permissions = array();
    $query = "SELECT * FROM `permissions` WHERE `user_id` = \"$user_id\";";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $user_permissions[] = $row["permission"];
    }
    return $user_permissions;
}

function check_signin($connection, $username, $password) {
    $errors = array();
    $query = "SELECT * FROM `users` WHERE `username` = \"$username\";";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 1) {
        $errors[] = "No username match!";
    } else {
        $row = mysqli_fetch_assoc($result);
        $phash = $row["phash"];
        if (!password_verify($password, $phash)) {
            $errors[] = "Wrong password!";
        }
    }
    return $errors;
}

function set_user_session($connection, $username) {
    $query = "SELECT * FROM `users` WHERE `username` = \"$username\";";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $user["id"] = $row["id"];;
    $user["email"] = $row["email"];;
    $user["username"] = $row["username"];;
    $user["name"] = $row["name"];
    $user["surname"] = $row["surname"];
    $user["group"] = $row["group"];
    $_SESSION["user"] = $user;
}

function check_signup($connection, $new_user) {
    $errors = array();
    $username_pattern = "/^[A-Za-z][A-Za-z0-9_]{5,}/";
    $name_pattern = "/^[A-Za-z]{2,32}/";
    $pass_pattern = "/(?=^.{8,}$)((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[,.!?:;\-%$#@&*^|\/\\~[\]{}]))^.*/";
    //Validate email
    if (!filter_var($new_user["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is bad!";
    }
    //Validate username
    if (!preg_match($username_pattern, $new_user["username"])) {
        $errors[] = "Username is bad!";
    }
    //Validate name
    if (!preg_match($name_pattern, $new_user["name"])) {
        $errors[] = "Name is bad!";
    }
    //Validate surname
    if (!preg_match($name_pattern, $new_user["surname"])) {
        $errors[] = "Surname is bad!";
    }
    //Validate password
    if (!preg_match($pass_pattern, $new_user["pass"])) {
        $errors[] = "Password is bad!";
    }
    if ($new_user["pass"] != $new_user["pass2"]) {
        $errors[] = "Passwords are not equal!";
    }
    //Validate exist
    if (!$errors) {
        $username = $new_user["username"];
        $email = $new_user["email"];
        $query = "SELECT * FROM `users` WHERE `username` = \"$username\" or email = \"$email\";";
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Already used username or email!";
        }
    }
    return $errors;
}

function create_user($connection, $new_user) {
    $email = $new_user["email"];
    $username = $new_user["username"];
    $name = $new_user["name"];
    $surname = $new_user["surname"];
    $group = $new_user["group"];
    $phash = password_hash($new_user["pass"], PASSWORD_ARGON2I);
    $query = "INSERT INTO `users` (`email`, `username`, `name`, `surname`, `group`, `phash`) VALUES (\"$email\", \"$username\", \"$name\", \"$surname\", \"$group\", \"$phash\");";
    mysqli_query($connection, $query);
}

function set_default_permissions($connection, $user_id) {
    $query = "SELECT `id` FROM `users` WHERE `id` = \"$user_id\";";
    $result = mysqli_query($connection, $query);
    $user_id = mysqli_fetch_assoc($result)["id"];
    $query = "INSERT INTO `permissions` (`user_id`, `permission`) VALUES ($user_id, \"COMMENT\");";
    mysqli_query($connection, $query);
    $query = "INSERT INTO `permissions` (`user_id`, `permission`) VALUES ($user_id, \"DOWNLOAD\");";
    mysqli_query($connection, $query);
    $query = "INSERT INTO `permissions` (`user_id`, `permission`) VALUES ($user_id, \"RATE\");";
    mysqli_query($connection, $query);
}

function get_sign_buttons($user){
    if (!$user) {
        $sign_buttons = "
    <div class=\"btn-group\" role=\"group\">
        <a type=\"button\" class=\"btn btn-outline-primary\" href=\"signin.php\">Sign In</a>
        <a type=\"button\" class=\"btn btn-outline-success\" href=\"signup.php\">Sign Up</a>
    </div>
    ";
    } else {
        $sign_buttons = "
    <div class=\"btn-group\" role=\"group\">
        <a type=\"button\" class=\"btn btn-outline-success\" href=\"profile.php\">Profile</a>
        <a type=\"button\" class=\"btn btn-outline-danger\" href=\"signout.php\">Sign Out</a>
    </div>
    ";
    }
    return $sign_buttons;
}

function get_nav_string($href, $title) {
    return "
    <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"$href.php\">$title</a>
    </li>
    ";
}

function get_nav_list($user_permissions) {
    $navlist_string = "";
    $navlist = array();
    /////
    $navlist[] = get_nav_string("search", "Search");
    $navlist[] = get_nav_string("forum", "Forum");

    /////
    if (in_array("ADMIN", $user_permissions)) {
        $navlist[] = get_nav_string("admin_content", "A-Content");
        $navlist[] = get_nav_string("admin_users", "A-Users");

    }
    /////
    foreach ($navlist as $navitem) {
        $navlist_string= $navlist_string.$navitem;
    }
    return $navlist_string;
}

function delete_permissions($connection, $user_id) {
    $query = "DELETE FROM `permissions` WHERE `user_id` = $user_id AND `permission`!=\"ADMIN\";";
    mysqli_query($connection,$query);
}

function encode($text) {
    $text = str_replace('"','”', $text);
    $text = str_replace("'",'’', $text);
    $text = str_replace("\\",'⧸', $text);
    return $text;
}

function decode($text) {
    $text = str_replace('”','"', $text);
    $text = str_replace("’",'\'', $text);
    $text = str_replace('⧸','\\', $text);
    return $text;
}
?>