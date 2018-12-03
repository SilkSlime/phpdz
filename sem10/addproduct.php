<?php
$navbarname = "Add Item";
$title = "Add Item";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";
?>
<div class="card text-center mt-5">
    <div class="card-header"><h3>Add Item</h3></div>
    <div class="card-body">
        <?php
        if ($admin_flg) {
            require "render/addproduct_form.php";
        } else {
            alert("Permission denied!");
        }
        ?>
    </div>
    <div class="card-footer">
        <?php
        if ($admin_flg) {
            if ($method == "GET") {
                submit_input("Add Item!");
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
                }
            }
        }
        ?>
    </div>
</div>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>