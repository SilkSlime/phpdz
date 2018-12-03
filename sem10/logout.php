<?php
$navbarname = "Logout...";
$title = "Loguot...";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";
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
    redirect("index2.php")
?>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>