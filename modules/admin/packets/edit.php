<?php

$tpl		 = 'admin';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$mod_name	 = "редактируем пакет";
$id		 = $this->param[0];
$context	 = $id;
$c		 = new model\packets();
$data		 = $c->getPacket($id);
$sel		 = new model\curses();
$ss		 = $sel->getALL($data[0]->town);
if (!$_POST):
    foreach ($ss as $r)
    {
	$slist[] = array('value'	 => $r->id,
	    'name'	 => $r->name_ua
	);
    }
    $re			 = (array) $data[0];
    $slist['selected']	 = $re['kurs1_id'];
    $re['kurs1_id']		 = $slist;

    $slist['selected']	 = $re['kurs2_id'];
    $re['kurs2_id']		 = $slist;

    $slist['selected']	 = $re['kurs3_id'];
    $re['kurs3_id']		 = $slist;

    $slist['selected']	 = $re['kurs4_id'];
    $re['kurs4_id']		 = $slist;

    $slist['selected']	 = $re['kurs5_id'];
    $re['kurs5_id']		 = $slist;

    $slist['selected']	 = $re['kurs6_id'];
    $re['kurs6_id']		 = $slist;

    $slist['selected']	 = $re['kurs7_id'];
    $re['kurs7_id']		 = $slist;


//$context.=print_r($re);

    $f = new bootstrap\input();



    $context .= '<form method="POST">' . $f->renderFormByData('packets', $re)
	    . '<button type="submit" class="btn btn-info">сохранить</button></form>';

    include TEMPLATE_DIR . DS . $tpl . ".html";
else:
    if (@$_POST['seminar'] == 'on')
    {
	$_POST['seminar'] = 'Y';
    }
    else
    {
	$_POST['seminar'] = 'N';
    }
    $_POST['id'] = $id;

    $c->editPackets($_POST);
    if ($c->lastState != '')
    {
	echo $c->lastState;
    }
    else
    {
	header("Location:" . WWW_ADMIN_PATH . 'packets');
    };
endif;

































































