<?php
echo "
<form action=\"reg.php\" method=\"POST\" id=\"form\">
    <div class=\"form-row\">
        <div class=\"col-md-6 mb-3\">
            <label>Email</label>
            <input type=\"email\" class=\"form-control\" name=\"email\" placeholder=\"example@mail.com\" required>
        </div>
        <div class=\"col-md-6 mb-3\">
            <label>Username</label>
            <input type=\"text\" class=\"form-control\" name=\"username\" placeholder=\"username\" required>
        </div>
    </div>
    <div class=\"form-row\">
        <div class=\"col-md-6 mb-3\">
            <label>Password</label>
            <input type=\"password\" class=\"form-control\" name=\"pass\" placeholder=\"password\" required>
        </div>
        <div class=\"col-md-6 mb-3\">
            <label>Repeat password</label>
            <input type=\"password\" class=\"form-control\" name=\"pass2\" placeholder=\"password\" required>
        </div>
    </div>
</form>
";