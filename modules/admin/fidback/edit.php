<?php

$tpl		 = "admin";
$mod_name	 = "редактирование отзыва";
$context	 = "";
$fd		 = new model\feedbask();
$f		 = new bootstrap\input();
$id		 = $this->param[0];
$brouse		 = APP_PATH . '/images/feedback/';
$web_brouse	 = WWW_IMAGE_PATH . 'feedback/';
$lsize		 = '158×158px с круглой маской';
if (!$_POST):
    $data		 = $fd->getFeedback($id);
    //$context	 .= print_r($data[0], true);
    $data[0]->image	 = $web_brouse . $data[0]->image;
    $context	 .= '<form method="POST" enctype="multipart/form-data">'
	    . $f->renderFormByData('feedback', (array) $data[0])
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';
else:

    $_POST['id']	 = $id;
    $_POST['image']	 = basename($_POST['image']);
    unset($_POST['mypath']);
    $fd->UpdateFeedback($_POST);
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "fidback/'); }, 900)</script>";
endif;
include TEMPLATE_DIR . DS . $tpl . ".html";
