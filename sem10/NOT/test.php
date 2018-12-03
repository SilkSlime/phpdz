<?php
session_start();
$issession = isset($_SESSION["logged"]);
echo var_dump($_SESSION);
echo "<br>$issession 22";