<?php
$navbarname = "Edit Item";
$title = "Edit Item";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";

$product_id = $_GET["id"];
$request = "SELECT * FROM `items` WHERE `id` = $product_id;";
$result = mysqli_query($conn, $request);

$row = mysqli_fetch_assoc($result);

$product = $row["product"];
$type = $row["type"];
$description = $row["description"];
$manufacturer = $row["manufacturer"];
$price = $row["price"];
?>
    <div class="card text-center mt-5">
        <div class="card-header"><h3>Edit Item</h3></div>
        <div class="card-body">
            <?php
            if ($admin_flg) {
                require "render/editproduct_form.php";
            } else {
                alert("Permission denied!");
            }
            ?>
        </div>
        <div class="card-footer">
            <?php
            if ($admin_flg) {
                if ($method == "GET") {
                    submit_input("Complete!");
                }
                if ($method == "POST") {
                    $errors = array();
                    $product = post("product");
                    $type = post("type");
                    $description = post("description");
                    $manufacturer = post("manufacturer");
                    $price = post("price");
                    require "utility/checkimage.php";
                    if (!$errors) {
                        require "utility/upload.php";
                        redirect("product.php?id=$product_id");
                    }
                }
            }
            ?>
        </div>
    </div>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>