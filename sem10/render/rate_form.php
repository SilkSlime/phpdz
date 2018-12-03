<?php
if ($rated) {
    $rate_caption = "Change Rate?";
} else {
    $rate_caption = "Rate!";
}
echo "
<form action=\"product.php?id=$product_id\" method=\"POST\" id=\"form\">
    <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
        <label class=\"btn btn-danger\">
            <input type=\"radio\" name=\"rate\" autocomplete=\"off\" value=\"1\">1
        </label>
        <label class=\"btn btn-danger\">
            <input type=\"radio\" name=\"rate\" autocomplete=\"off\" value=\"2\">2
        </label>
        <label class=\"btn btn-warning\">
            <input type=\"radio\" name=\"rate\" autocomplete=\"off\" value=\"3\">3
        </label>
        <label class=\"btn btn-success\">
            <input type=\"radio\" name=\"rate\" autocomplete=\"off\" value=\"4\">4
        </label>
        <label class=\"btn btn-success\">
            <input type=\"radio\" name=\"rate\" autocomplete=\"off\" value=\"5\">5
        </label>
    </div>
    <input class=\"btn btn-primary\" type=\"submit\" value=\"$rate_caption!\" form=\"form\">
</form>
";
//<form action="product.php?id=5" method="POST" id="form">
//    <div class="btn-group btn-group-toggle" data-toggle="buttons">
//        <label class="btn btn-dark">
//            <input type="radio" name="rate" autocomplete="off" value="1">1
//        </label>
//        <label class="btn btn-secondary">
//            <input type="radio" name="rate" autocomplete="off" value="2">2
//        </label>
//        <label class="btn btn-danger">
//            <input type="radio" name="rate" autocomplete="off" value="3">3
//        </label>
//        <label class="btn btn-warning">
//            <input type="radio" name="rate" autocomplete="off" value="4">4
//        </label>
//        <label class="btn btn-success">
//            <input type="radio" name="rate" autocomplete="off" value="5">5
//        </label>
//    </div>
//    <input class="btn btn-primary" type="submit" value="Rate!" form="form">
//</form>