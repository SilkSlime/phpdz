<?php
//$tstart = file("templatestart.html");
//foreach ($tstart as $str) {
//    echo $str;
//}
echo "
<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <title>Main page</title>
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\"
          integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">
</head>
<body>
<nav class=\"navbar navbar-light bg-light\">
    <a class=\"navbar-brand\">$navbarname</a>
    <div class=\"btn-group\" role=\"group\"\">";
require "logged.php";
echo "</div>
</nav>
<div class=\"container\">";