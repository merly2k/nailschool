<?php

$template	 = "admin";
$mod_name	 = 'Управление настройками сайта/языки';
$f		 = new bootstrap\input();
$l		 = new db();
$brouse		 = '';
$lsize		 = '';
$context	 = '<table class="table table-bordered DataTable">';
$context	 .= '<tr>'
	. '<th>'
	. 'код языка'
	. '</th>'
	. '<th>'
	. 'отображаемое название'
	. '</th>'
	. '<th>'
	. 'иконка'
	. '</th>'
	. '<th>'
	. 'действия'
	. '</th>'
	. '</tr>';

foreach ($l->get_result("select * from `lang`") as $lang)
{
    $context .= '<tr>'
	    . '<td>' . $lang->lang_eu
	    . '</td>'
	    . '<td>' . $lang->langname
	    . '</td>'
	    . '<td>' . $lang->langicon
	    . '</td>'
	    . '<td>'
	    . '<a class="btn btn-info" href="' . WWW_ADMIN_PATH . 'settings/lang/edit/' . $lang->id . '"> <i class="far fa-edit"></i></a> '
	    . '<a class="btn btn-info" href="lans/delete/' . $lang->id . '"><i class="far fa-trash-alt"></i></a>'
	    . '</td>'
	    . '</tr>';
}
$context .= '</table>';
//print_r($this->param);
if (@$this->param[0] == 'edit'):
    foreach ($l->get_result("select * from `lang` where id='" . $this->param[1] . "'") as $lg)
    {
	$data = (array) $lg;
    }
    $forma = $f->renderFormByData('lang', $data);
else:
    $forma = $f->render_form('lang');
endif;
$context .= '<form method="post">' . $forma
	. '<button class="btn btn-info" type=submit>save</button>'
	. '</form>';
include TEMPLATE_DIR . DS . $template . ".html";
