<?php
function alert($msg, $type="danger") {
    echo "
    <div class=\"alert alert-$type mt-1 md-1\">
        $msg
    </div>
    ";
}
function submit_input($msg, $form="form") {
    echo "<input class=\"btn btn-outline-primary btn-block\" type=\"submit\" value=\"$msg\" form=\"$form\">";
}
function post($key){
    return $_POST[$key];
}
function redirect($to, $sec=0) {
    header("Refresh:$sec; url=$to");
}