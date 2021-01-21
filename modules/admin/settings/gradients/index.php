<?php

$tpl		 = 'admin/admin';
$context	 = '';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "Настройки градиентов";
$brouse		 = '';
$lsize		 = '';
$grad		 = new model\gradients();
$context	 .= "<a class='btn btn-info' href='" . WWW_ADMIN_PATH . "settings/gradients/add'>добавить градиент</a><hr>";
$context	 .= '<div class="row">';
foreach ($grad->getAll() as $val)
{
    //$context .= print_r($val, true);
    $context .= '<div class="card col-3" style="' . "background-image: -moz-linear-gradient(0deg, $val->start 0%, $val->middle 30%, $val->end 100%) !important;
    background-image: -webkit-linear-gradient(0deg, $val->start 0%, $val->middle 30%, $val->end 100%) !important;
    background-image: -ms-linear-gradient(0deg, $val->start  0%, $val->middle 30%, $val->end 100%) !important;"
	    . '"><a href="' . WWW_ADMIN_PATH . 'settings/gradients/edit/' . $val->name . '">' . $val->name . '</a></div>';
}
$context .= '</div>';


include TEMPLATE_DIR . DS . $tpl . ".html";
