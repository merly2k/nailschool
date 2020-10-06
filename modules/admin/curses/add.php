<?php

$tpl		 = 'admin';
$c		 = new model\curses();
$town		 = $this->param[0];
$context	 = '';
$mod_name	 = "Новий курс $town";
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
    $data = array(
	'link'		 => '',
	'name_ua'	 => '',
	'name_ru'	 => '',
	'name_en'	 => '',
	'image'		 => '',
	'anonce_ru'	 => '',
	'anonce_ua'	 => '',
	'hidedeckr'	 => 'N',
	'decription_ru'	 => '',
	'decription_ua'	 => '',
	'fulltext_ru'	 => '',
	'fulltext_ua'	 => '',
	'display'	 => 'Y',
	'display_r'	 => 'N',
	'darunok'	 => 'N',
	'darunok_ru'	 => '',
	'darunok_ua'	 => '',
	'miso'		 => "$town",
	'start'		 => date('Y-m-d'),
	'hidestart'	 => 'N',
	'finish'	 => '0',
	'coast'		 => '0',
	'action'	 => 'Y',
	'deadline'	 => '',
	'ac_coast'	 => '0',
	'porjadok'	 => '100',
	"basecolor"	 => $collist,
	"mashas"	 => $mashas,
	'video_ua'	 => '',
	'video_ru'	 => '',
	'googldock_ua'	 => '',
	'googldock_ru'	 => '',
	'tur'		 => '',
	'zrazki'	 => '',
	'vipusk'	 => '',
    );

    $context .= '<form method="POST">' . $f->renderFormByData('cursses', $data)
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';
else:
    unset($_POST['mypath']);
    $_POST['miso']	 = $town;
    $image		 = basename($_POST['image']);
    if ($_POST['basecolor'] == '')
    {
	$_POST['basecolor'] = 'maroon';
    }
    if (@$_POST['tur'] == 'on')
    {
	$_POST['tur'] = 'Y';
    }
    else
    {
	$_POST['tur'] = 'N';
    }
    if (@$_POST['hidestart'] == 'on')
    {
	$_POST['hidestart'] = 'Y';
    }
    else
    {
	$_POST['hidestart'] = 'N';
    }
    if (@$_POST['hidedeckr'] == 'on')
    {
	$_POST['hidedeckr'] = 'Y';
    }
    else
    {
	$_POST['hidedeckr'] = 'N';
    }
    if (@$_POST['display'] == 'on')
    {
	$_POST['display'] = 'Y';
    }
    else
    {
	$_POST['display'] = 'N';
    }
    if (@$_POST['display_r'] == 'on')
    {
	$_POST['display_r'] = 'Y';
    }
    else
    {
	$_POST['display_r'] = 'N';
    }
    if (@$_POST['darunok'] == 'on')
    {
	$_POST['darunok'] = 'Y';
    }
    else
    {
	$_POST['darunok'] = 'N';
    }
    if (@$_POST['vipusk'] == 'on')
    {
	$_POST['vipusk'] = 'Y';
    }
    else
    {
	$_POST['vipusk'] = 'N';
    }
    if (@$_POST['zrazki'] == 'on')
    {
	$_POST['zrazki'] = 'Y';
    }
    else
    {
	$_POST['zrazki'] = 'N';
    }
    if (@$_POST['action'] == 'on')
    {
	$_POST['action'] = 'Y';
    }
    else
    {
	$_POST['action'] = 'N';
    }
    $_POST['image']	 = $image;
//print_r($_POST);
    unset($_POST['files']);
    $c->add($_POST);
    $context	 .= $c->lastState;
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses/$town'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";









