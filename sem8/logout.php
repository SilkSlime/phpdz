<?php
session_start();
$navbarname = "Logout...";
$title = "Loguot...";
$session = isset($_SESSION["logged"]);
if ($session) {
    $logged = $_SESSION["logged"];
    $username = $_SESSION["username"];
}
$method = $_SERVER["REQUEST_METHOD"];
require "templatestart.php";
?>
<div class="card text-center mt-5">
    <form action="auth.php" method="POST">
        <div class="card-header"><h3>LOGOUTING...</h3></div>
        <div class="card-body">
            <h2>You are logged out!</h2>
        </div>
    </form>
</div>
<?php
    session_destroy();
    header("Refresh:0; url=auth.php");
?>
<?php require "templateend.php";?>