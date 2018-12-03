<html>
<head>
</head>
<body>
    <h3>Задание 1</h3>
    <?php
    if ($_POST["name"]==NULL) {
        echo "<h4>Hello, World!</h4>";
    } else {
        $name = $_POST["name"];
        echo "<h4>Hello, $name!</h4>";
    }
    ?>
    <form action="sem6.php" method="post">
       <input type="text" name="name" placeholder="Ur name">
       <input type="submit" value="Send!">
<!--    </form>-->
    <h3>Задание 2</h3>
<!--    <form action="sem6.php" method="post">-->
        <input type="checkbox" name="checkbox1" value="checkbox1"><br>
        <input type="checkbox" name="checkbox2" value="checkbox2" checked><br>
        <input type="radio" name="radio" value="first" checked><br>
        <input type="radio" name="radio" value="second"><br>
        <input type="submit" value="Send!">
<!--    </form>-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cb1 = $_POST["checkbox1"]; $cb2 = $_POST["checkbox2"]; $rb = $_POST["radio"];
        echo "Enabled: checkboxes: $cb1 $cb2, and radio: $rb";
    }
    ?>
    <h3>Задание 3</h3>
<!--    <form action="sem6.php" method="post">-->
        <select name="select">
            <option>AAA</option>
            <option>BBB</option>
            <option>CCC</option>
        </select>
        <select multiple="multiple" name="mselect[]">
            <option>DDD</option>
            <option>EEE</option>
            <option>FFF</option>
        </select>
        <input type="submit" value="Send!">
<!--    </form>-->
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $_POST["select"] . " ";
        foreach ($_POST["mselect"] as $item) {
            echo $item . " ";
        }
    }
    ?>
    <h3>Задание 4</h3>
<!--    <form action="sem6.php" method="post">-->
        <input type="text" placeholder="email" name="email">
        <input type="submit" value="Send!">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $pattern = "/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/";
        if (preg_match($pattern, $email)) {
            echo "Email $email is okay!";
        } else {
            echo "Email $email is NOT okay!!!";
        }
    }
    ?>

</body>
</html>
