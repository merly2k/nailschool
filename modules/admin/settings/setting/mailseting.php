<?php

$template = "admin";
$mod_name = 'Настройка Подписки';
$content = "<article class='module width_full'>
		<div class='module_content'> ";

$f = new bootstrap\input();
$l = new model\setings();
if ($_POST) {
    $l->save('fileurl', $_POST['fileurl']);
}

foreach ($l->get('fileurl') as $key => $value) {
    $cur = $value->val;
}
$content .= "<form method='post' action='" . WWW_ADMIN_PATH . "subscriblers/seting'>";
$content .= $f->input('fileurl', 'адрес файла', 'text', 'fileurl', 'file URL', $cur);
$content .= "<button class='btn btn-info'>Сохранить</button>";
$content .= "</form>";


$content .= "</div></article>";

include TEMPLATE_DIR . DS . $template . ".html";
