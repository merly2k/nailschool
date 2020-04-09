<?php

$c	 = new model\faqo();
$tpl	 = 'admin';
$context = '';
$brouse	 = '';
$lsize	 = '';

$mod_name	 = "редактируем курс";
$id		 = $this->param[0];
if (!$_POST):
    $data	 = $c->getById($id);
    $f	 = new bootstrap\input();
    $edits	 = (array) $data[0];
//    print_r($edits);
    $context .= '<form method="POST" enctype="multipart/form-data">' . $f->renderFormByData('faqo', $edits) . ''
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';

else:
    unset($_POST['mypath']);
    $_POST['id']	 = $id;
    // $context	 .= print_r($_POST);
    //$context	 .= print_r($image, true);
    echo $c->edit($_POST);
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "faqo'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";


















































































































