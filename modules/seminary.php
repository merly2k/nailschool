<?php
$otherTown='';
if(isset($_SESSION['lang'])){
$lang=mb_strtolower(@$_SESSION['lang']);
}else{$lang="ua";}

$link=$this->param[0];
$km=new model\misto();
$currentMisto=($km->getByName($link));
$mlang='name_'.$lang;
foreach ($km->getall($link)as $r){
    //print_r($r);
$otherTown.='<li><a class="" href="'.WWW_BASE_PATH.'curses/'.$r->link.'/">'.$r->$mlang.'</a></li>';
                        
}
$misto='<a id="choseCity" class="dropdown-toggle chose-city__current" href="#">'
                       .$currentMisto->$mlang.'
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="choseCity">'
                     .$otherTown
                    .'</ul>';

$seminars='';
$items='';
$item='<div class="course__item sem">
	<div class="top-text">
	    <h2 class="course__headline"><strong>АППАРАТНЫЙ МАНИКЮР</strong></h2>
	</div>
	<div class="course__price"><span class="course__price__price">
	    <strong>480</strong> грн</span>
	    <span class="course__price__day">Фото</span></div>
	<a class="course__btn popmake-zapisatsya-na-seminar-apparatnyj pum-trigger" href="#" style="cursor: pointer;">Записаться на семинар</a>
    </div>';

$tpl="seminary";
include TEMPLATE_DIR . DS . $tpl . ".html";
