<?php
require "utility/functions.php";
session_start();
session_destroy();
redirect("index.php");
?>