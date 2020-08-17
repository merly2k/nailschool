<?php

$brouse		 = '';
$lsize		 = '';
$template	 = "admin";
$mod_name	 = 'Управление переменными';
$sc		 = new model\sysvars();


if (!$_POST):
    $seminarcoast	 = $sc->getVar('seminarcoast');
    $context	 = '<ul class="nav nav-pills">';
    $context	 .= "<form class='form-inline' method='POST' action='" . WWW_ADMIN_PATH . "settings/vars'>"
	    . "<label class='form-label'>цена семинара: </label>"
	    . " <input class='form-control' name='varvalue' value='$seminarcoast'>"
	    . "<button type='submit' class='btn btn-primary'>save</button>"
	    . "</form>";
    $context	 .= '</ul>';
else:
    $context = $sc->update('seminarcoast', $_POST['varvalue']);
    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/vars'); }, 900)</script>";
endif;
include TEMPLATE_DIR . DS . $template . ".html";
