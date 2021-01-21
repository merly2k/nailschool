<?php

$towns		 = new model\misto();
$ss		 = new model\school();
$f		 = new bootstrap\input();
$town		 = @$this->param[0];
$brouse		 = APP_PATH . '/images/school/';
$web_brouse	 = WWW_IMAGE_PATH . 'school/';
$lsize		 = '800×280px';
if (!$_POST):
    $tpl		 = 'admin/admin';
    $mod_name	 = "управление презентациями школ";
    $context	 = '';
    $nav		 = ' <ul class="nav nav-tabs">';

    foreach ($towns->getAll() as $t)
    {
	if ($t->link == $town)
	{
	    $active = 'active';
	}
	else
	{
	    $active = '';
	}
	$nav .= '<li class="nav-item">'
		. '<a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'school/' . $t->link . '">'
		. $t->name_ua . '</a>'
		. '</li> ';
    }
    $nav .= "</ul>";
    if (isset($town)):
	$data			 = $ss->getByLink(@$this->param[0]);
	$data->osn_img		 = $web_brouse . $data->osn_img;
	$data->ergonomik_img	 = $web_brouse . $data->ergonomik_img;
	$data->location_img	 = $web_brouse . $data->location_img;
	$data->shop_img		 = $web_brouse . $data->shop_img;
	$data->konsult_img	 = $web_brouse . $data->konsult_img;
	//print_r($data);
	$forma			 = '<form enctype="multipart/form-data" method="POST">' . $f->renderFormByData('school', (array) $data) . ''
		. '<button class="btn btn-info" type="submit">save</button></fotm>';

	$out = $forma;
    else:
	$out = '';
    endif;
    $context .= $nav . $out;
    include TEMPLATE_DIR . DS . $tpl . ".html";
else:
    $_POST['osn_img']	 = basename($_POST['osn_img']);
    $_POST['ergonomik_img']	 = basename($_POST['ergonomik_img']);
    $_POST['location_img']	 = basename($_POST['location_img']);
    $_POST['shop_img']	 = basename($_POST['shop_img']);
    $_POST['konsult_img']	 = basename($_POST['konsult_img']);
    unset($_POST['files']);
    unset($_POST['mypath']);
    //print_r($_POST);
    $ss->update($_POST);
    setcookie("saved", 'saved', time() + 13); 
    setcookie("SameSite", 'None', time() + 13); 
    setcookie("Secure", 'Secure', time() + 13); 

    header("Location:" . WWW_ADMIN_PATH . 'school/' . $town);
endif;





























































































