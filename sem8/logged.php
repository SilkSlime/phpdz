<?php
if ($logged) {
    echo "<a type=\"button\" class=\"btn btn-outline-danger\" href=\"logout.php\">Wanna logout, $username?</a>";
} else {
    echo "<a type=\"button\" class=\"btn btn-outline-primary\" href=\"auth.php\">Sign In</a>
    <a type=\"button\" class=\"btn btn-outline-success\" href=\"reg.php\">Sign Up</a>";
}