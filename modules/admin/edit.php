<?php
//echo $this->param[0];

$a= new model\leads();
$f=new bootstrap\input();
$template = "admin";
$context='';
$mod_name="Работа с лидами"; 
if(!$_POST):

$con=$a->getById($this->param[0]);
$fields=(array)$con;
 $fields['sdate']=(new DateTime("$con->sdate"))->format('Y-m-d');	//
 $fields['lastedit']=(new DateTime())->format('Y-m-d');	//
$context.='<form method="post">'.$f->renderFormByData('leads', $fields)
	."<button type='submit' class='btn btn-info'>save</button>"
	. "</form>";
else:
    $data=array(
    'link'=>$_POST['link'] ,
    'name'=>$_POST['name'],
    'meta'=>$_POST['meta'] ,
    'article'=>$_POST['article']
	);
    $a->save($data, $_POST['link']);
    $context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "'); }, 900)</script>";
endif;
include TEMPLATE_DIR . DS . $template . ".html";
?>






























