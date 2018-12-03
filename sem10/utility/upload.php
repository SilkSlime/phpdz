<?php
if ($product_id) {
    $request = "UPDATE `items` SET `product` = \"$product\", `type` = \"$type\", `description` = \"$description\", `manufacturer` = \"$manufacturer\", `price` = $price WHERE `id`=$product_id;";
    $result = mysqli_query($conn, $request);
    if ($_FILES["image"]["name"]!="") {
        $serverdir = '/home/silkslime/server/sem10/';
        $uploadfile = 'product_img/' . $product_id;
        $fullpath = $serverdir . $uploadfile;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $fullpath)) {
            $request = "UPDATE `items` SET `image` = \"$uploadfile\" WHERE `id` = $product_id;";
            $result = mysqli_query($conn, $request);
            alert("Success edited item!", "success");
        }
    }
} else {
//Insert product without image path
    $request = "INSERT INTO `items` (`product`, `type`, `description`, `manufacturer`, `price`) VALUES (\"$product\", \"$type\", \"$description\", \"$manufacturer\", $price)";
    $result = mysqli_query($conn, $request);
//Get out product with id
    $request = "SELECT * FROM `db_sem10`.`items` WHERE `product` = \"$product\" AND `type` = \"$type\" AND `description` = \"$description\" and `manufacturer` = \"$manufacturer\" and `price` = \"$price\"";
    $result = mysqli_query($conn, $request);

    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];

    $serverdir = '/home/silkslime/server/sem10/';
    $uploadfile = 'product_img/' . $id;
    $fullpath = $serverdir . $uploadfile;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $fullpath)) {
        $request = "UPDATE `db_sem10`.`items` SET `image` = \"$uploadfile\" WHERE `id` = $id";
        $result = mysqli_query($conn, $request);
        alert("Success added item!", "success");
    }
}