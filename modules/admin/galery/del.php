<?php

$template	 = "admin/admin";
$cont_id	 = $this->param[0];
$ajax		 = "";
$mod_name	 = 'Удаление изображения';
$context	 = '';

if (!$_POST)
{
    $context .= "<h3>Удаление изображения</h3>"
	    . "Вы собираетесь удалить изображение"
	    . "<div class='col-6'><img class='img' src='" . WWW_IMG_PATH . "galery/" . $cont_id . "'></div>"
	    . "<form method='post'>"
	    . "<input type='hidden' name='confirm' value='yes'>"
	    . "<button class='btn btn-danger' type='sybmit'>Удалить</button> "
	    . "<a class='btn btn-info' href='" . WWW_ADMIN_PATH . "galery'>Отменить</a>"
	    . "</form>";
}
else
{

    if ($_POST['confirm'] == 'yes')
    {
	$file = APP_PATH . "/images/galery/" . $cont_id;
	if (unlink($file))
	{
	    $context .= "изображение удалено";
	    $todel	 = new model\photogalery();
	    $todel->deleteByName($cont_id);
	    $context .= "<script>location.replace('" . WWW_ADMIN_PATH . "galery/');</script>";
	}
    }
}
include TEMPLATE_DIR . DS . $template . ".html";
?>
