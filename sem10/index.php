<?php
$navbarname = "Products";
$title = "Products";

require "utility/prep.php";
require "utility/func.php";
require "utility/db.php";

require "render/templatestart.php";
require "render/navbar.php";

$request = "SELECT * FROM `items`";
$result = mysqli_query($conn, $request);
?>
<div class="row mt-3">
    <div class="col">
        <input id="searchType" onkeyup="searchType()" type="text" class="form-control" placeholder="Search for type">
    </div>
    <div class="col">
        <input id="searchManufacturer" onkeyup="searchManufacturer()" type="text" class="form-control" placeholder="Search for manufacturer">
    </div>
</div>
<table class="table table-hover mt-3" id="myTable">
    <thead>
    <tr>
        <th scope="col">Type</th>
        <th scope="col">Product</th>
        <th scope="col">Manufacturer</th>
        <th scope="col" id="priceth" onclick="sortTable(3)">Price <img id="price" class="svg u" src="src/ud.svg"></th>
        <th scope="col" id="ratingth" onclick="sortTable(4)">Rating <img id="rating" class="svg u" src="src/ud.svg"></th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $type = $row["type"];
        $product = $row["product"];
        $manufacturer = $row["manufacturer"];
        $price = $row["price"];
        $rating = $row["rating"];
        if (!$rating) {
            $rating = "Not Ranked";
        }
        echo "
        <tr onclick=\"document.location = 'product.php?id=$id';\">
            <td>$type</td>
            <td>$product</td>
            <td>$manufacturer</td>
            <td>$price</td>
            <td>$rating</td>
        </tr>
        ";
    }
    ?>
    </tbody>
</table>
<script>
    function searchType() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("searchType");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function searchManufacturer() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("searchManufacturer");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("myTable");
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount ++;
            } else {
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
<script>
    $(function(){
        $('#priceth').on('click', function() {
            $("#rating").attr("src", "src/ud.svg")
            if ($("#price").hasClass("u")) {
                $("#price").toggleClass("u");
                $("#price").attr("src", "src/u.svg")
            } else {
                $("#price").toggleClass("u");
                $("#price").attr("src", "src/d.svg")
            }
        });
        $('#ratingth').on('click', function() {
            $("#price").attr("src", "src/ud.svg")
            if ($("#rating").hasClass("u")) {
                $("#rating").toggleClass("u");
                $("#rating").attr("src", "src/u.svg")
            } else {
                $("#rating").toggleClass("u");
                $("#rating").attr("src", "src/d.svg")
            }
        });
    });
</script>
<?php mysqli_close($conn);
require "render/templateend.php"; ?>