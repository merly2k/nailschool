<?php

$template	 = "admin/admin";
$cont_id	 = $this->param[0];
$ajax		 = "";
$mod_name	 = 'Удаление изображения';
$context	 = '';
$brouse		 = '';
if (!$_POST)
{
    $context .= "<h3>Удаление изображения</h3>"
	    . "Вы собираетесь удалить изображение"
	    . "<div class='col-6'><img class='img' src='" . WWW_IMG_PATH . "vipusknik/" . $cont_id . "'></div>"
	    . "<form method='post'>"
	    . "<input type='hidden' name='confirm' value='yes'>"
	    . "<button class='btn btn-danger' type='sybmit'>Удалить</button> "
	    . "<a class='btn btn-info' href='" . WWW_ADMIN_PATH . "vipusknik'>Отменить</a>"
	    . "</form>";
}
else
{

    if ($_POST['confirm'] == 'yes')
    {
	$file = APP_PATH . "/images/vipusknik/" . $cont_id;
	if (unlink($file))
	{
	    $todel	 = new model\vipusknik();
	    $todel->deleteByName($cont_id);
	    $context .= "изображение удалено";
	    $context .= "<script>location.replace('" . WWW_ADMIN_PATH . "vipusknik/');</script>";
	}
    }
}
include TEMPLATE_DIR . DS . $template . ".html";
?>
