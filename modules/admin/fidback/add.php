<?php
$tpl='admin';
$fd= new model\feedbask();
$context='';
$mod_name="Новий отзыв";
$f=new bootstrap\input();
if(!$_POST):
	
$context.= '<form method="POST" enctype="multipart/form-data">'.$f->render_form('feedback')
	.'<button class="btn btn-info" type="submit">save</button></fotm>';
else:

 $uploaddir = APP_PATH.'/images/feedback/';


    $uploadfile = $uploaddir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
   $_POST['image']=basename($_FILES['image']['name']);
    unset($_POST['files']);
 //pprint($_POST);
    $fd->newFeedback($_POST);
    $context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "fidback/'); }, 900)</script>";
endif;
include TEMPLATE_DIR . DS . $tpl . ".html";


