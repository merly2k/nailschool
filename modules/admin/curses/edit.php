<?php

$c		 = new model\curses();
$tpl		 = 'admin';
$context	 = '';
$lsize		 = ' 845×582px';
$mod_name	 = "редактируем курс";
$id		 = $this->param[0];
$brouse		 = APP_PATH . '/images/curses/';
$web_brouse	 = WWW_IMAGE_PATH . 'curses/';
if (!$_POST):
    $data			 = $c->getCurseById($id);
    $f			 = new bootstrap\input();
    $colors			 = new model\gradients();
    $fr			 = 'curses';
    $edits			 = (array) $data;
    $selected		 = $edits['basecolor'];
    $collist		 = $colors->getGradients();
    $collist['type']	 = 'imglist';
    $collist['path']	 = 'gradients';
    $collist['selected']	 = $selected;
    $edits['basecolor']	 = $collist;
    $edits['image']		 = $web_brouse . $edits['image'];

    $files	 = glob(APP_PATH . '/images/grl/' . '*.*');
    $files	 = array_map('basename', $files);
    foreach ($files as $fil)
    {
	$mashas[] = array('name' => "$fil", 'image' => "$fil");
    }
    $selected1		 = $edits['mashas'];
    $mashas['type']		 = 'imglist';
    $mashas['path']		 = 'grl';
    $mashas['selected']	 = $selected1;
    $edits['mashas']	 = $mashas;

//print_r($edits);
    $context .= '<form method="POST" enctype="multipart/form-data">' . $f->renderFormByData('cursses', $edits) . ''
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';

else:
    unset($_POST['mypath']);
    $_POST['id']	 = $id;
    $image		 = basename($_POST['image']);
    if (@$_POST['tur'] == 'on')
    {
	$_POST['tur'] = 'Y';
    }
    else
    {
	$_POST['tur'] = 'N';
    }
    if (@$_POST['display'] == 'on')
    {
	$_POST['display'] = 'Y';
    }
    else
    {
	$_POST['display'] = 'N';
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
    // $context	 .= print_r($_POST);
    //$context	 .= print_r($image, true);
    echo $c->editCurse($_POST);
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";






































































































