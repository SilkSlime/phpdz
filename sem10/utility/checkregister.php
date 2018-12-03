<?php
$usernamepattern = "/^[A-Za-z][A-Za-z0-9_]{5,}/";
$paspattern = "/(?=^.{8,}$)((?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[,.!?:;\-%$#@&*^|\/\\~[\]{}]))^.*/";
//Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is bad!";
}
//Validate username
if (!preg_match($usernamepattern, $username)) {
    $errors[] = "Username is bad!";
}
//Validate password
if (!preg_match($paspattern, $pass)) {
    $errors[] = "Password is bad!";
}
if ($pass != $pass2) {
    $errors[] = "Passwords are not equal!";
}