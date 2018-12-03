<?php
echo "<ul class=\"list-group list-group-flush text-left\">";
$request = "SELECT * FROM `comments` WHERE `product_id` = $product_id;";
$result = mysqli_query($conn, $request);
while ($row = mysqli_fetch_assoc($result)) {
    $author = $row["username"];
    $comment = $row["comment"];
    echo "<li class=\"list-group-item\"><b>$author: </b>$comment</li>";
}
echo "</ul>";
//<ul class="list-group list-group-flush">
//  <li class="list-group-item"><b>$au</b>$b</li>
//  <li class="list-group-item">Dapibus ac facilisis in</li>
//  <li class="list-group-item">Morbi leo risus</li>
//  <li class="list-group-item">Porta ac consectetur ac</li>
//  <li class="list-group-item">Vestibulum at eros</li>
//</ul>