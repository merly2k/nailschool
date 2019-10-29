<?php

$template = "admin";
$mod_name = 'Настройка слайдеров';
$content = "<article class='module width_full'>
		<div class='module_content'> ";

$f = new bootstrap\input();
$l = new model\setings();
if ($_POST) {

    if (@$_POST['sliderHIT'] == 'on') {
        $l->save('sliderHIT', 1);
    } else {
        $l->save('sliderHIT', 0);
    }
    if (@$_POST['sliderDS'] == 'on') {
        $l->save('sliderDS', 1);
    } else {
        $l->save('sliderDS', 0);
    }
    if (@$_POST['newestDS'] == 'on') {
        $l->save('sliderNewest', 1);
    } else {
        $l->save('sliderNewest', 0);
    }
}

foreach ($l->get('sliderHIT') as $key => $value) {
    $slh = ($value->val == 1) ? 'checked' : '';
}
foreach ($l->get('sliderDS') as $key => $value) {
    $sld = ($value->val == 1) ? 'checked' : '';
}
foreach ($l->get('sliderNewest') as $key => $value) {
    $sln = ($value->val == 1) ? 'checked' : '';
}

$content .= "<form class='form-inline' method='post' action='" . WWW_ADMIN_PATH . "setting/sliders'>";
$content .= $f->checkbox('hit', 'Показывать слайдер хитов', 'sliderHIT', "$slh");
$content .= $f->checkbox('ds', 'Показывать слайдер акций', 'sliderDS', "$sld");
$content .= $f->checkbox('newest', 'Показывать слайдер новинок', 'newestDS', "$sln");
$content .= $f->input('h', '', 'hidden', 'sliderS', "d");

$content .= "<button class='btn btn-info'>Сохранить</button>";
$content .= "</form>";


$content .= "</div></article>";

include TEMPLATE_DIR . DS . $template . ".html";
