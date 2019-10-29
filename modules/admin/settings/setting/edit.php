<?php

$tpl = 'admin';
$content = '';
$modal_name = '';
$modal_content = '';
$mod_name = "правка валюты";
$content .= "<div class='row'></div>";
$st = new model\setting();
$pow = $st->getSettingById($_POST['id']);
$tb = new model\remotecurrensy();
$pow = $pow[0];


$content .= ""
        . "<form class='form-inline' method='post' action='" . WWW_ADMIN_PATH . "setting/update'>"
        . "<select class='custom-select col-3' id='inlineFormCustomSelect' name='currensy'>";
foreach ($tb->getAllCurrency() as $row) {

    if ($pow->currency == $row->id) {
        $ac = "selected='selected'";
    } else {
        $ac = '';
    }
    $content .= "<option $ac "
            . " value='" . $row->id . "'>"
            . "("
            . $row->id
            . ")" . $row->fullName . ""
            . "</option>";
}
$content .= "</select>"
        . "<input name='obsag' class='form-control col-2'  value='" . $pow->obsag . "' type='Number' step='.0001'>"
        . "<input name='id' value='" . $pow->id . "' type='hidden'>"
        . "<button class='btn btn-primary' type='submit'>сохранить</button></form>";


include TEMPLATE_DIR . DS . $tpl . ".html";
