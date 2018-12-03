<?php
echo "
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
    <a class=\"navbar-brand\" href=\"#\">$navbarname</a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"index.php\">Products List</a>
            </li>";
if ($admin_flg) {
    echo "
            <li class=\"nav-item active\">
                <a class=\"nav-link\" href=\"addproduct.php\">Add product</a>
            </li>";
}
echo "
        </ul>";
require "authbuttons.php";
echo "
    </div>
</nav>
<div class=\"container\">
";