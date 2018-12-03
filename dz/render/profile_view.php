<?php
$photo_url = $user["photo"];
if (in_array("COMMENT", $user_permissions)&&in_array("RATE", $user_permissions)&&in_array("DOWNLOAD", $user_permissions)) {
    $status = "active";
} else if (!(in_array("COMMENT", $user_permissions)&&in_array("RATE", $user_permissions)&&in_array("DOWNLOAD", $user_permissions))) {
    $status = "Inactive";
} else {
    $status = "Not full permissions";
}
if (in_array("ADMIN", $user_permissions)) {
    $status = "Administrator";
}
echo "
<div class=\"row\">
    <div class=\"col-4\">
        <div class=\"card h-100\">
            <img src=\"$photo_url\" alt=\"NO PROFILE IMAGE\">
        </div>
    </div>
    <div class=\"col-8\">
";
if ($user) {
    echo "<li class=\"list-group-item\">Name: ".$user["name"]."</li>";
    echo "<li class=\"list-group-item\">Surname: ".$user["surname"]."</li>";
    echo "<li class=\"list-group-item\">Email: ".$user["email"]."</li>";
    echo "<li class=\"list-group-item\">Group: ".$user["group"]."</li>";
    echo "<li class=\"list-group-item\">Status: ".$user["id"]."-".$status."</li>";
}
echo "</div></div>";