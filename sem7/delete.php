<?php
$servername = "localhost";
$username = "silkslime";
$password = ":fikOm&65dKLiVhyre";
$dbname = "student_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$ID = $_GET["ID"];
if (!$conn) {
    die("No connection! " . mysqli_connect_error() . "<br>");
} else {
    echo "Connection success!<br>";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sql = "DELETE FROM student_db.stud WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_error($conn) != NULL) {
        echo "Nice!";
    } else {
        echo mysqli_error($conn);
    }
    echo "Студент с id=$id удален";
}
mysqli_close($conn);
?>
