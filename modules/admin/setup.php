<?php

$template	 = 'admin';
$mod_name	 = 'настройки';
$ajax		 = "";
$brouse		 = '';
$lsize		 = '';
$con		 = file_get_contents('config.php');
$out		 = '';
if ($_POST)
{
    save_file('bkp', $con);
    save_file('bkp', $_POST['config']);
}
$out	 .= "<div class='row'>
<div class='module_content'> <fieldset>
    <legend>редактор конфигурации</legend>
    <form name='config' method='POST'>";
$out	 .= "<textarea class='form_control' name='config' >$con</textarea>";
$out	 .= '<div class="submit_link">
        <button class="alt_btn" name="save" value="сохранить" type="submit">сохранить</button>
        </div>
    </form>
</fieldset>
</div>
</div>';
$context = $out;
include TEMPLATE_DIR . DS . $template . ".html";

function save_file($f_type = 'php', $fcontent) {
    $w = fopen('config.' . $f_type, 'w');
    fwrite($w, $fcontent);
    fclose($w);
}
?>


