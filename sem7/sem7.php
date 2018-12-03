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
echo "<h3>Задание 5.1</h3>";
    $sql = "SELECT * FROM stud;";
    $res = mysqli_query($conn, $sql);
    echo mysqli_error($conn);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            echo "id: " . $row["id"] .
                "; Zachetka: " . $row["zach"] .
                "; Surname: " . $row["surname"] .
                "; Name: " . $row["name"] .
                "; Patronimic: " . $row["patronimic"] .
                "; Age: " . $row["age"] .
                "; Fakultet: " . $row["fak"] .
                "; Kafedra: " . $row["kaf"] .
                "; Kurs: " . $row["kurs"] .
                "<br>";
        }
    }
echo "<h3>Задание 5.2</h3>";
$sql = "SELECT * FROM stud WHERE `id`=3;";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"] .
            " " . $row["surname"] .
            " " . $row["name"] .
            " " . $row["patronimic"] .
            "<br>";
    }
}
echo "<h3>Задание 5.3</h3>";
$sql = "SELECT * FROM stud WHERE `surname`=\"Petrov\";";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"] .
            " " . $row["surname"] .
            " " . $row["name"] .
            " " . $row["patronimic"] .
            "<br>";
    }
}
echo "<h3>Задание 5.4</h3>";
$sql = "SELECT * FROM stud WHERE `fak`=\"IU\" and `age`>20;";
$res = mysqli_query($conn, $sql);
echo mysqli_error($conn);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"] .
            " " . $row["surname"] .
            " " . $row["name"] .
            " " . $row["patronimic"] .
            " " . $row["age"] . " year old" .
            "<br>";
    }
}
echo "<h3>Задание 5.5</h3>";
$sql = "SELECT * FROM stud WHERE `fak`=\"IU\" and (`kurs`=3 or `kurs`=5);";
$res = mysqli_query($conn, $sql);
echo mysqli_error($conn);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"] .
            " " . $row["surname"] .
            " " . $row["name"] .
            " " . $row["patronimic"] .
            " " . $row["kurs"] . " kurs" .
            "<br>";
    }
}
echo "<h3>Задание 5.6</h3>";
$sql = "SELECT * FROM stud ORDER BY `surname`;";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        echo "id: " . $row["id"] .
            " " . $row["surname"] .
            " " . $row["name"] .
            " " . $row["patronimic"] .
            "<br>";
    }
}
mysqli_close($conn);
?>
<h3>Задание 6</h3>
<form action="change.php" method="post">
    <p>Номер зачетки: <input type="text" name="zach"></p>
    <p>Курс: <input type="number" name="kurs"></p>
    <input type="submit" value="Изменить...">
</form>
<h3>Задание 7</h3>
<form action="delete.php" method="post">
    <p>ID: <input type="number" name="id"></p>
    <input type="submit" value="Удалить...">
</form>