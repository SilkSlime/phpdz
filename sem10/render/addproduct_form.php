<?php
echo "
<form action=\"addproduct.php\" method=\"POST\" id=\"form\" enctype=\"multipart/form-data\">
    <div class=\"form-row\">
        <div class=\"col-md-6 mb-3\">
            <label>Product name</label>
            <input type=\"text\" class=\"form-control\" name=\"product\" placeholder=\"Cucumber\" required>
        </div>
        <div class=\"col-md-6 mb-3\">
            <label>Type</label>
            <input type=\"text\" class=\"form-control\" name=\"type\" placeholder=\"Vegetable\" required>
        </div>
    </div>
    <div class=\"form-row\">
        <div class=\"col-md-12 mb-3\">
            <label>Description</label>
            <textarea class=\"form-control\" name=\"description\" placeholder=\"It is very good for you health!\"></textarea>
        </div>
    </div>
    <div class=\"form-row\">
        <div class=\"col-md-4 mb-3\">
            <label>Manufacturer</label>
            <input type=\"text\" class=\"form-control\" name=\"manufacturer\" placeholder=\"Nature Inc.\">
        </div>
        <div class=\"col-md-4 mb-3\">
            <label>Price (RUB)</label>
            <input type=\"number\" class=\"form-control\" name=\"price\" placeholder=\"100\" required>
        </div>
        <div class=\"col-md-4 mb-3\">
            <label>Photo</label>
            <div class=\"custom-file\">
                <input type=\"file\" class=\"custom-file-input\" name=\"image\">
                <label class=\"custom-file-label\"></label>
            </div>
        </div>
    </div>
</form>
";