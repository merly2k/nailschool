<?php

$refa	 = explode('/', $_SERVER['HTTP_REFERER']);
$town	 = array_pop($refa);
if (!$_POST):
    $tpl		 = 'admin';
    $brouse		 = '';
    $lsize		 = '';
    $context	 = '';
    $mod_name	 = "Новий пакет";
    $f		 = new bootstrap\input();
    $kurses		 = new model\curses();
    $curses		 = $kurses->getALLasArray($town);
    foreach ($curses as $val)
    {
	$ku[] = array('value' => $val->id, 'name' => $val->name_ru);
    }
    $ara	 = array('name_ua'	 => '',
	'name_ru'	 => '',
	'porjadok'	 => '100',
	'coast'		 => '',
	'dayz'		 => '',
	'kurs1_id'	 => $ku,
	'kurs2_id'	 => $ku,
	'kurs3_id'	 => $ku,
	'kurs4_id'	 => $ku,
	'kurs5_id'	 => $ku,
	'kurs6_id'	 => $ku,
	'kurs7_id'	 => $ku,
	'seminar'	 => "",
	'link'		 => "",
	'town'		 => "$town");
    $context .= '<form method="post">' . $f->renderFormByData('packets', $ara) . '<button class="btn btn-info">Сохранить</button></form>';

    include TEMPLATE_DIR . DS . $tpl . ".html";

else:

    $packets = new model\packets();
    if (@$_POST['seminar'] == 'on')
    {
	$_POST['seminar'] = 'Y';
    }
    else
    {
	$_POST['seminar'] = 'N';
    }
    if ($packets->addPackets($_POST) == '')
    {
	header('Location:' . WWW_ADMIN_PATH . 'packets');
    }
    else
    {
	echo $packets->lastState;
    }
endif;
