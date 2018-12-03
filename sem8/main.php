<?php
    session_start();
    $navbarname = "Main";
    $title = "Welcome!";
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
        <div class="card-header"><h3>CAN U SEE THE MAGICK?</h3></div>
        <div class="card-body">
            <?php
            if ($method == "GET") {
                if ($logged) {
                    echo "<h1>Welcome, $username!</h1>
                    <h3>WOW Its POMIDORKI.pNg ITS AWSOME! MAGIC!!!</h3>";
                } else {
                    echo "U are not authorized and ne mojete see this magic! Authorize NOW (or register):";
                    include "logged.php";
                }
            }
            ?>
        </div>
        <div class="card-footer">
        </div>
    </form>
</div>
<?php require "templateend.php";?>