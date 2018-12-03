<?php
echo "
<form action=\"signin.php\" method=\"POST\" id=\"form\">
    <div class=\"form-row\">
        <div class=\"col-md-12 mb-3\">
            <label>Username</label>
            <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"John1337\" required>
        </div>
    </div>
    <div class=\"form-row\">
        <div class=\"col-md-12 mb-3\">
            <label>Password</label>
            <input type=\"password\" class=\"form-control\" name=\"pass\" placeholder=\"Rassword\" required>
        </div>
    </div>
</form>
";
?>