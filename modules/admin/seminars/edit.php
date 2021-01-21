<?php

$c		 = new model\seminars();
$tpl		 = 'admin/admin';
$context	 = '';
$mod_name	 = "редактируем семинар";
$id		 = $this->param[0];
$brouse		 = '';
$lsize		 = '';
if (!$_POST):
    $data	 = $c->getById($id);
    $f	 = new bootstrap\input();
    $colors	 = new model\gradients();

    $edits			 = (array) $data;
    $selected		 = $edits['basecolor'];
    $collist		 = $colors->getGradients();
    $collist['type']	 = 'imglist';
    $collist['path']	 = 'gradients';
    $collist['selected']	 = $selected;
    $edits['basecolor']	 = $collist;
    //$edits['image']		 = $web_brouse . $edits['image'];

    $files	 = glob(APP_PATH . '/images/grl/' . '*.*');
    $files	 = array_map('basename', $files);
    foreach ($files as $fil)
    {
	$mashas[] = array('name' => "$fil", 'image' => "$fil");
    }
    //$selected1		 = $edits['mashas'];
    //$mashas['type']		 = 'imglist';
    //$mashas['path']		 = 'grl';
    //$mashas['selected']	 = $selected1;
    //$edits['mashas']	 = $mashas;


    $context .= '<form method="POST">' . $f->renderFormByData('seminars', $edits) . ''
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';

else:
    $_POST['id']	 = $id;
    unset($_POST['files']);
    $c->editCurse($_POST);
    //echo $c->lastState;
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "seminars/'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";












































