<?php

$tpl = 'admin/admin';
$content = '';
$modal_name = '';
$modal_content = '';
$mod_name = "Настройки уведомлений";
$content = "<article class='module width_full'>
		<div class='module_content'> ";

$f = new bootstrap\input();
$l = new model\setings();
if ($_POST) {
    $l->save('adminMail', $_POST['adminMail']);
}

foreach ($l->get('adminMail') as $key => $value) {
    $cur = $value->val;
}
$content .= "<form method='post' action='" . WWW_ADMIN_PATH . "setting/alerts'>";
$content .= $f->input('adminMail', 'Адрес для уведомлений:', 'text', 'adminMail', 'admin Mail', $cur);
$content .= "<button class='btn btn-info'>Сохранить</button>";
$content .= "</form>";


$content .= "</div></article>";

include TEMPLATE_DIR . DS . $tpl . ".html";
