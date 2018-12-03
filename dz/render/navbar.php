<?php
$sign_buttons = get_sign_buttons($user);
$nav_list = get_nav_list($user_permissions);
echo "
<nav class=\"navbar navbar-expand-lg navbar-light bg-light\">
    <a class=\"navbar-brand\" href=\"index.php\"><span class=\"site-name-f\">Code</span><span class=\"site-name-s\">Poster</span></a>
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo02\" aria-controls=\"navbarTogglerDemo02\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
        <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarTogglerDemo02\">
        <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">
            $nav_list
        </ul>
        $sign_buttons
    </div>
</nav>
<div class=\"container\">
";