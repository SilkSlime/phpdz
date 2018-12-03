<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<a href="sem7.php">Список студентов...</a>
<h1>ADD STUDENT:</h1>
<form action="create.php" method="post">
    <p>Номер зачетки: <input type="text" name="zach"></p>
    <p>Фамилия: <input type="text" name="sur"></p>
    <p>Имя: <input type="text" name="name"></p>
    <p>Отчество: <input type="text" name="path"></p>
    <p>Возраст: <input type="number" name="age"></p>
    <p>Факультет: <input type="text" name="fak"></p>
    <p>Кафедра: <input type="text" name="kaf"></p>
    <p>Курс: <input type="number" name="kurs"></p>
    <input type="submit">
</form>
<h2>
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

    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $zach = $_POST["zach"];
        $sur = $_POST["sur"];
        $name = $_POST["name"];
        $path = $_POST["path"];
        $age = $_POST["age"];
        $fak = $_POST["fak"];
        $kaf = $_POST["kaf"];
        $kurs = $_POST["kurs"];
        $sql = "INSERT INTO stud (zach, surname, `name`, patronimic, `age`, fak, kaf, kurs) VALUES ($zach, $sur, $name, $path, $age, $fak, $kaf, $kurs)";
        echo $sql;
        $res = mysqli_query($conn, $sql);

        if (mysqli_error($conn) != NULL) {
            echo "NICEEEEE!!!";
        } else {
            echo mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    ?>
</h2>
</body>
</html>