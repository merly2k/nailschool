<?php

$tpl		 = 'admin';
$mod_name	 = 'модерация коментариев';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$id		 = @$this->param[0];
$coments	 = new model\comments();
$data		 = $coments->getComment($id);

if (!$_POST)
{
    $context = "Вы действительно хотите удалить коментарий: "
	    . "<b>" . $data[0]->body . "</b> ?"
	    . "<hr>ВНИМАНИЕ! При удалении коментария все ответы на него будут так-же удалены"
	    . "<form method='POST'>"
	    . "<input type='hidden' name='id' value='" . $id . "' >"
	    . "<a href='" . WWW_ADMIN_PATH . "moderation' class='btn btn-info'>отмена</a> &nbsp;"
	    . "<button class='btn btn-danger' type='submit'>удалить</button>"
	    . "</form>";
}
else
{
    if ($_POST{'id'} == $id)
    {
	$coments->deleteComment($id);
	$context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "moderation'); }, 900)</script>";
    }
    else
    {
	$context = "Не хватает прав на удаление";
    }
}

include TEMPLATE_DIR . DS . $tpl . ".html";


























