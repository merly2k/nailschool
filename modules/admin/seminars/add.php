<?php

$tpl		 = 'admin';
$c		 = new model\seminars();
$town		 = $this->param[0];
$context	 = '';
$mod_name	 = "Новий Семинар";
$f		 = new bootstrap\input();
$colors		 = new model\gradients();
$collist	 = $colors->getGradients();
$collist['type'] = 'imglist';
$collist['path'] = 'gradients';
$lsize		 = '845×582px';
$brouse		 = APP_PATH . '/images/curses/';
$web_brouse	 = WWW_IMAGE_PATH . 'curses/';
//$context.=print_r($collist,true);
$files		 = glob(APP_PATH . '/images/grl/' . '*.*');
$files		 = array_map('basename', $files);
foreach ($files as $fil)
{
    $mashas[] = array('name' => "$fil", 'image' => "$fil");
}
$selected1		 = '';
$mashas['type']		 = 'imglist';
$mashas['path']		 = 'grl';
$mashas['selected']	 = $selected1;


if (!$_POST):
    /* id int(11)
      link varchar(50)
      name_ru Название семинара
      decription_ru Описание семинара
      fulltext_ru longtextДетальная информация
      name_ua 	varchar(50)	Назва семінару
      decription_ua text опис семінару
      fulltext_ua text детально про семінар
      show set('yes', 'no')показувати
      miso varchar(50)
      start date початок
      finish int(4)длительность
      coast decimal(10,2)	ціна
      basecolor */

    $data = array(
	'link'		 => '',
	'name_ua'	 => '',
	'name_ru'	 => '',
	'show'		 => 'yes',
	'image'		 => '',
	'anonce_ru'	 => '',
	'anonce_ua'	 => '',
	'decription_ru'	 => '',
	'decription_ua'	 => '',
	'fulltext_ru'	 => '',
	'fulltext_ua'	 => '',
	'miso'		 => "$town",
	'start'		 => date('Y-m-d'),
	'finish'	 => '0',
	'coast'		 => '0',
	'action'	 => 'Y',
	'ac_coast'	 => '0',
	'porjadok'	 => '100',
	"basecolor"	 => $collist);

    $context .= '<form method="POST">' . $f->renderFormByData('seminars', $data)
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';
else:
    $_POST['miso'] = $town;
    if (@!$_POST['display'])
    {
	$_POST['display'] = 'N';
    }
    else
    {
	$_POST['display'] = 'Y';
    }
    if (@!$_POST['action'])
    {
	$_POST['action'] = 'N';
    }
    else
    {
	$_POST['action'] = 'Y';
    }
//print_r($_POST);
    unset($_POST['files']);
    $c->add($_POST);
    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "seminars/$town'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";















