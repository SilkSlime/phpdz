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
    $zach = $_POST["zach"];
    $kurs = $_POST["kurs"];
    $sql = "UPDATE student_db.stud SET kurs = $kurs WHERE zach = $zach";
    $res = mysqli_query($conn, $sql);

    if (mysqli_error($conn) != NULL) {
        echo "Nice!";
    } else {
        echo mysqli_error($conn);
    }
    echo "Студент с номером зачетки $zach теперь на $kurs курсе";
}
mysqli_close($conn);
?>
