<?php
echo "
<form action=\"auth.php\" method=\"POST\" id=\"form\">
<div class=\"form-row\">
    <div class=\"col-md-6 mb-3 mx-auto\">
        <label>Username</label>
        <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"username\" required>
    </div>
</div>
<div class=\"form-row\">
    <div class=\"col-md-6 mb-3 mx-auto\">
        <label>Password</label>
        <input type=\"password\" class=\"form-control\" name=\"pass\" placeholder=\"password\" required>
    </div>
</div>
</form>
";