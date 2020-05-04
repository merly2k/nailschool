<?php

$tpl		 = "admin";
$brouse		 = '';
$lsize		 = '';
$town		 = @$this->param[0];
$context	 = '';
$mod_name	 = "Курсы";
$nav		 = ' <ul class="nav nav-tabs">';
$f		 = new bootstrap\input();
$forma		 = $f->render_form('cursses');
$cc		 = new model\curses();
$tt		 = new model\misto();
foreach ($tt->getAll() as $t)
{
    if ($town == $t->link)
    {
	$active		 = 'active';
	$mod_name	 = "Курсы : $t->name_ua";
    }
    else
    {
	$active = '';
    }
    $nav .= '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'curses/' . $t->link . '">' . $t->name_ua . '</a></li> ';
}
$nav .= "</ul>";
if (isset($town)):
    $out = '<a href="' . WWW_ADMIN_PATH . 'curses/add/' . $town . '" class="btn btn-primary">додати курс</a><hr>'
	    . '<table class="table DataTable"><thead><tr>'
	    . '<th>порядок</th>'
	    . '<th>Курс</th>'
	    . '<th>линк</th>'
	    . '<th>скрыт</th>'
	    . '<th>Старт</th>'
	    . '<th>Длительность</th>'
	    . '<th>Действие</th>'
	    . '</tr>'
	    . '</thead>';

    foreach ($cc->getALL($town, 1)as $cl)
    {
	if ($cl->display_r == "N")
	{
	    $tram = 'Y';
	}
	else
	{
	    $tram = '';
	}
	$out .= "<tr>"
		. "<td>$cl->porjadok</td>"
		. "<td>$cl->name_ua </td>"
		. "<td><a onclick='copyToClipboard($(this))' class='btn' data-link='" . WWW_BASE_PATH . 'curses/curse/' . $town . '/' . "$cl->link'><i class='fa fa-link'> </i></a></td>"
		. "<td>$tram</td>"
		. "<td>$cl->start</td>"
		. "<td>$cl->finish</td>"
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

























































































