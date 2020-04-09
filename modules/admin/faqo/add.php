<?php

$brouse		 = '';
$lsize		 = '';
$tpl		 = 'admin';
$c		 = new model\faqo();
$town		 = $this->param[0];
$context	 = '';
$mod_name	 = "Новий вопрос";
$f		 = new bootstrap\input();

if (!$_POST):
    $data = array(
	'misto'		 => $town,
	'porjadok'	 => '100',
	'question_ua'	 => '',
	'ansver_ua'	 => '',
	'question_ru'	 => '',
	'ansver_ru'	 => ''
    );

    $context .= '<form method="POST">' . $f->renderFormByData('faqo', $data)
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';
else:
//print_r($_POST);
    unset($_POST['files']);
    $c->add($_POST);
    $context .= $c->lastState;
    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "faqo/$town'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";


























