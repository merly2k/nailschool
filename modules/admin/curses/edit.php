<?php

$c		 = new model\curses();
$tpl		 = 'admin/admin';
$context	 = '';
$lsize		 = ' 845×582px';
$id		 = $this->param[0];
$brouse		 = APP_PATH . '/images/curses/';
$web_brouse	 = WWW_IMAGE_PATH . 'curses/';
$mod_name	 = '';
if (!$_POST):
    $data			 = $c->getCurseById($id);
    $mod_name		 = "редактируем курс $data->miso/$data->link";
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
    if (@$_POST['hidestart'] == 'on')
    {
	$_POST['hidestart'] = 'Y';
    }
    else
    {
	$_POST['hidestart'] = 'N';
    }
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
    if (@$_POST['hidedeckr'] == 'on')
    {
	$_POST['hidedeckr'] = 'Y';
    }
    else
    {
	$_POST['hidedeckr'] = 'N';
    }
    if (@$_POST['hideprog'] == 'on')
    {
	$_POST['hideprog'] = 'Y';
    }
    else
    {
	$_POST['hideprog'] = 'N';
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
    if (@$_POST['showcomment'] == 'on')
    {
	$_POST['showcomment'] = 'Y';
    }
    else
    {
	$_POST['showcomment'] = 'N';
    }
    $_POST['image']	 = $image;
    // $context	 .= print_r($_POST);
    //$context	 .= print_r($image, true);
    $e=$c->editCurse($_POST);
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";
