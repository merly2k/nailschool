<?php
$tpl		 = 'admin';
$mod_name="управление презентациями школ";
$context='';
$nav=' <ul class="nav nav-tabs">';
$towns= new model\misto();
$ss= new model\school();
$f=new bootstrap\input();
$town=@$this->param[0];
foreach ($towns->getAll() as $t)
{
    if($t->link==$town){$active='active';} else {$active='';}
    $nav.='<li class="nav-item">'
	    . '<a class="nav-link '.$active.'" href="'.WWW_ADMIN_PATH.'school/'.$t->link.'">'
	    .$t->name_ua.'</a>'
	    . '</li> ';
}
$nav.="</ul>";
if(isset($town)):
    $data=(array)$ss->getByLink(@$this->param[0]);
//print_r($data);
    $forma= '<form method="POST">'.$f->renderFormByData('school',$data).''
	. '<button class="btn btn-info" type="submit">save</button></fotm>';

    $out=$forma;
	else:
    $out='';
endif;
$context.=$nav.$out;
include TEMPLATE_DIR . DS . $tpl . ".html";





























