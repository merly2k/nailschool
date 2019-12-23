<?php
$c= new model\curses();
$tpl='admin';
$context='';
$mod_name="редактируем курс";
$id=$this->param[0];
if(!$_POST):
$data=$c->getCurseById($id);
$f=new bootstrap\input();
$colors=new model\gradients();

$edits=(array)$data;
$selected=$edits['basecolor'];
$collist=$colors->getGradients();
$collist['type']='imglist';
$collist['selected']=$selected;
$edits['basecolor']=$collist;
$context.='<form method="POST">'.$f->renderFormByData('cursses',$edits).''
	. '<button class="btn btn-info" type="submit">save</button></fotm>';

else:
$_POST['id']=$id;
unset($_POST['files']); 
    $c->editCurse($_POST);
    //echo $c->lastState;
    $context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";































