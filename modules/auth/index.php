<?php

//print_r($_POST);
//error_reporting(999999);
$template = "login";
$cont_id = @$this->param[0];
if (@$_SESSION['message'] == 'error') {
    $content = "<div class='row bg-warning'>
    
</div>";
} else {
    $content = "";
}

$_SESSION['message'] = '';
include TEMPLATE_DIR . $template . ".html";
?>