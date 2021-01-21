<?php

$tpl		 = 'admin/admin';
$mod_name	 = 'модерация коментариев';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$id		 = @$this->param[0];
$f		 = new bootstrap\input();
//$forma		 = $f->render_form('comments');
$curses		 = new model\curses();
$coments	 = new model\comments();
$tt		 = new model\misto();
$data		 = $coments->getComment($id);
$context	 = print_r($data[0]->dt, true);
if (!$_POST)
{
    $context .= 'Внимание: сохраняется только текст комментария, остальные поля в форме выведены исключительно для информативности<hr><form method="POST">' .
	    $f->renderFormByData('comments', (array) $data[0])
	    . '<button class="btn btn-info" type="submit">save</button></fotm>';
}
else
{
    extract($_POST);
    $coments->updateComment($id, $body);
    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "moderation'); }, 900)</script>";
}
include TEMPLATE_DIR . DS . $tpl . ".html";





















