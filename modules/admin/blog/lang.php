<?php
$tpl="admin";
use model\blogl;
use bootstrap\input;
$act=$this->param[0];
$lang =isset($this->param[1]) ? $this->param[1]:false;
$l=new blogl();
$f= new input();
$context='';

switch ($act)
{
    case 'new':
$mod_name="добавление статьи в блог (язык $lang)";
	if(!$_POST):
$context.='<form method="post">'
	.$f->renderFormByData('blog_lang', array('lang'=>"$lang",'link'=>'','name'=>'','article'=>'','autor'=>'','postdate'=>date('Y.m.d')))
	."<button type='submit' name='act' value='Удалить' class='btn btn-danger'>сохранить</button>"
	. '</form>';
	    else:
	$l->Insert($_POST);
	$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "blog/'); }, 900)</script>";
	endif;


	break;
    case 'del':
	break;

    default:
	$mod_name="редактирование статьи";
	if(!$_POST):
	foreach ($l->SelectBy($act) as $row){
	$context.='<form method="post">';
	$context.=$f->renderFormByData('blog_lang', (array)$row)
	."<button type='submit' class='btn btn-danger'>сохранить</button>"
	. '</form>';
	}
	else:
	    extract($_POST);
    $params=array(
	'link'=>$link,
	'name'=>$name,
	'article'=>$article,
	'autor'=>$autor,
	'postdate'=>$postdate
	
    );
	    $l->Update($params, $act);
	    $context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "blog/'); }, 900)</script>";
	endif;
	break;
}



include TEMPLATE_DIR . DS . $tpl . ".html";
?>
















































