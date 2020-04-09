<?php

$otherTown = '';
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower(@$_SESSION['lang']);
}
else
{
    $lang = "ua";
}
$tpl		 = "online";
$link		 = $this->param[0];
$km		 = new model\misto();
$currentMisto	 = ($km->getByName($link));
$mlang		 = 'name_' . $lang;
$curses		 = new model\curses();
$packs		 = new model\packets();
$bc['ua']	 = 'Курси у ';
$bc['ru']	 = 'Курсы в ';
$vidminnik	 = array('ua'	 => array(
	'dnipro'	 => 'Дніпрі',
	'kyiv'		 => 'Київі',
	'zaporizhzhya'	 => 'Запоріжжї',
	'nicolaev'	 => 'Миколаєві',
    ),
    'ru'	 => array(
	'dnipro'	 => 'Днепре',
	'kyiv'		 => 'Киеве',
	'zaporizhzhya'	 => 'Запорожье',
	'nicolaev'	 => 'Николаеве',
    )
);


include TEMPLATE_DIR . DS . $tpl . ".html";
