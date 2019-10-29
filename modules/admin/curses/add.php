<?php
$tpl='admin';
$c= new model\curses();
$town=$this->param[0];
$context='';
$mod_name="Новий курс";
$f=new bootstrap\input();
$colors=new model\gradients();
$collist=$colors->getGradients();
$collist['type']='imglist';
//$context.=print_r($collist,true);
if(!$_POST):
    $data=array(
	'link'=>'',
	'name_ua'=>'',
	'name_ru'=>'',
	'name_en'=>'',
	'image'=>'',
	'anonce_ru'=>'',
	'anonce_ua'=>'',
	'decription_ru'=>'',
	'decription_ua'=>'',
	'fulltext_ru'=>'',
	'fulltext_ua'=>'',
	'display'=>'Y',
	'miso'=>"$town",
	'start'=>date('Y-m-d'),
	'finish'=>'0',
	'coast'=>'0',
	'action'=>'Y',
	'ac_coast'=>'0',
	"basecolor"=>$collist);
	
$context.= '<form method="POST">'.$f->renderFormByData('cursses',$data)
	.'<button class="btn btn-info" type="submit">save</button></fotm>';
else:
$_POST['miso']=$town;
if(@!$_POST['display']){$_POST['display']='N';}
else
{
$_POST['display']='Y'   ; 
}
if(@!$_POST['action']){$_POST['action']='N';}
else
{
$_POST['action']='Y';
}
//print_r($_POST);
unset($_POST['files']); 
    $c->add($_POST);
    $context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses/$town'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";


