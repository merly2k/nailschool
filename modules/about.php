<?php 
$lang=mb_strtolower($_SESSION['lang']);
$tpl='index';
$spmenu= new spmenu();
$menu=$spmenu->render($lang);
$context='';
if($lang=='ua'):
$c= new model\sp();
$text=$c->getArticle('about');
$context="<div class='row'><div class='container'><h3>".$text->name."</h3>"
	. "<p class='introtext'>"
	. $text->article
	. "</p></div>";
else:
    $c= new model\spl();
$text=$c->getArticle('about',$lang);
$context="<div class='row'><div class='container'><h3>".$text->name."</h3>"
	. "<p class='introtext'>"
	. $text->article
	. "</p></div>";
endif;
include TEMPLATE_DIR . DS . $tpl . ".html";
?>














