<?php

$tpl		 = "admin";
$brouse		 = '';
$lsize		 = '';
$town		 = @$this->param[0];
$context	 = '';
$mod_name	 = "вопросы и ответы";
$nav		 = ' <ul class="nav nav-tabs">';
$f		 = new bootstrap\input();
$forma		 = $f->render_form('cursses');
$cc		 = new model\faqo();
$tt		 = new model\misto();
foreach ($tt->getAll() as $t)
{
    if ($town == $t->link)
    {
	$active = 'active';
    }
    else
    {
	$active = '';
    }
    $nav .= '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'faqo/' . $t->link . '">' . $t->name_ua . '</a></li> ';
}
$nav .= "</ul>";
if (isset($town)):
    $out = '<a href="' . WWW_ADMIN_PATH . 'faqo/add/' . $town . '" class="btn btn-primary">новый вопрос</a><hr>'
	    . '<table class="table DataTable"><thead><tr>'
	    . '<th>Порядок</th>'
	    . '<th>вопрос</th>'
	    . '<th>Действие</th>'
	    . '</tr>'
	    . '</thead>';

    foreach ($cc->getAll($town)as $cl)
    {
	//print_r($cl);
	$out .= "<tr>"
		. "<td>$cl->porjadok</td>"
		. "<td>$cl->question_ru</td>"
		. "<td>"
		. "<a href='edit/$cl->id'><i class='fa fa-edit'> </i></a> "
		. "<a href='del/$cl->id'><i class='fa fa-trash'> </i></a>"
		. "</td>"
		. "</tr>";
    }
else:
    $out = "выберите город";
endif;



$nav	 .= '</ul> ';
$context .= $nav . $out;
include TEMPLATE_DIR . DS . $tpl . ".html";







































































