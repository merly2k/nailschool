<?php
$tpl='admin';
$context='';
$mod_name="редактируем пакет";
$id=$this->param[0];
$c= new model\packets();
$data=$c->getPacket($id);
$f=new bootstrap\input();
if(!$_POST):
$context.= '<form method="POST">'.$f->renderFormByData('packets',(array)$data[0])
	.'<button type="submit" class="btn btn-info">сохранить</button></form>';

include TEMPLATE_DIR . DS . $tpl . ".html";
else:
$_POST['id']=$id;
    $c->editPackets($_POST);
if ($c->lastState!=''){echo $c->lastState;}else{
    header("Location:".WWW_ADMIN_PATH.'packets');
};
endif;



























