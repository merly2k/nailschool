<?php

$template = "admin";
$context='';
$mod_name='Управление настройками сайта/переводы';
$langs=new db();
$tran= new model\translation();
$f= new bootstrap\input();
$tab='';
$tabcontent='';
foreach ($langs->get_result("select * from `lang`") as $l)
{
    
$tab.= '<li class="nav-item">'
	. '<a class="nav-link" data-toggle="pill" href="#'.$l->lang_eu.'">'.$l->langname.'</a>'
	. ' </li>';
    


$fr= "<br><form method='post' action='".WWW_ADMIN_PATH."settings/translation/save'>";
foreach ($tran->getLang($l->lang_eu) as $k=>$frases)
{
    $fr.=$f->input('lang', '', 'hidden', 'lang', '', $l->lang_eu);
    $fr.=$f->input('sa'.$k, $frases->ident, 'text', $frases->ident,'введите перевод',htmlentities($frases->langtext));
}
    $fr.="<button type='submit' class='btn btn-info'>save</button>";
    $fr.="</form>";
$tabcontent.='<div class="tab-pane container fade" id="'.$l->lang_eu.'">'
	.$l->langname.' - переведенные фразы <hr>'
	. $fr
	. '</div>';
}
$context.='<ul class="nav nav-pills">';
$context.=$tab.'</ul>';
$context.='<div class="tab-content">'.$tabcontent.'</div>';
include TEMPLATE_DIR . DS . $template . ".html";
