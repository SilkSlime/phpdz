<?php
$navbarname = "Product";
$title = "Product Detail";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";

$product_id = $_GET["id"];
$comment = $_POST["comment"];

require "utility/checkrate.php";

if (($method == "POST")&&($logged)) {
    if ($comment == "") {
        require "utility/rate.php";
    } else {
        require "utility/comment.php";
    }
}
$request = "SELECT * FROM `items` WHERE `id` = $product_id;";
$result = mysqli_query($conn, $request);
$row = mysqli_fetch_assoc($result);

$product = $row["product"];
$type = $row["type"];
$description = $row["description"];
$manufacturer = $row["manufacturer"];
$price = $row["price"];
$image = $row["image"];
$rating = $row["rating"];


?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Product: <?php echo $product;?></h3></div>
    <div class="card-body">
        <?php
        echo "<p><b>Type:</b> $type</p>";
        echo "<p><b>Description:</b> $description</p>";
        echo "<p><b>Manufacturer:</b> $manufacturer</p>";
        echo "<p><b>Price:</b> $price</p>";
        echo "<p><img class=\"image\" src=\"$image\" alt=\"IMAGE\"></p>";
        echo "<p><b>Rating:</b> $rating</p>";

        if ($logged) {
            require "render/rate_form.php";
        } else {
            alert("Log in to rate!", "warning");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if ($admin_flg) {
            echo "
            <a class=\"btn btn-block btn-warning\" href=\"productedit.php?id=$product_id\">Edit Product</a>
            <a class=\"btn btn-block btn-danger\" href=\"productdelete.php?id=$product_id\">Delete Product</a>
            ";
        }
        ?>
    </div>
</div>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Comments</h3></div>
    <div class="card-body">
        <?php
        if ($logged) {
            echo "
        <form action=\"product.php?id=$product_id\" method=\"POST\">
            <textarea class=\"form-control\" name=\"comment\" placeholder=\"A random comment...\"></textarea>
            <input type=\"submit\" value=\"Post comment!\" class=\"btn btn-primary btn-block mt-3\">
        </form>
            ";
        }
        ?>

    </div>
    <div class="card-footer">
        <?php
        require "utility/getcomments.php";
        ?>
    </div>
</div>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>