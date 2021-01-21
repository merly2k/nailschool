<?php

$tpl		 = "admin/admin";
$town		 = @$this->param[0];
$context	 = '';
$mod_name	 = "Семинары";
$nav		 = ' <ul class="nav nav-tabs">';
$f		 = new bootstrap\input();
$forma		 = $f->render_form('seminars');
$cc		 = new model\seminars();
$tt		 = new model\misto();
$brouse='';
$lsize ="";
foreach ($tt->getAll() as $t)
{
    if ($town == $t->link)
    {
	$active		 = 'active';
	$mod_name	 = "Семинары : $t->name_ua";
    }
    else
    {
	$active = '';
    }
    $nav .= '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'seminars/' . $t->link . '">' . $t->name_ua . '</a></li> ';
}
$nav .= "</ul>";
if (isset($town)):
    $out = '<a href="' . WWW_ADMIN_PATH . 'seminars/add/' . $town . '" class="btn btn-primary">добавить семинар</a><hr>'
	    . '<table class="table DataTable"><thead><tr>'
	    . '<th class="all">порядок</th>'
	    . '<th class="all">семинар</th>'
	    . '<th >Старт</th>'
	    . '<th >Длительность</th>'
	    . '<th >Действие</th>'
	    . '</tr>'
	    . '</thead><tbody>';

    foreach ($cc->getALL($town)as $cl)
    {
	//print_r($cl);
	$out .= "<tr>"
		. "<td>$cl->porjadok</td>"
		. "<td>$cl->name_ru</td>"
		. "<td>$cl->start</td>"
		. "<td>$cl->finish</td>"
		. "<td>"
		. "<a href='edit/$cl->id'><i class='fa fa-edit'> </i></a> "
		. "<a href='del/$cl->id'><i class='fa fa-trash'> </i></a>"
		. "</td>"
		. "</tr>";
    }
    $out.="</tbody></table>";
else:
    $out = "выберите город";
endif;



$nav	 .= '</ul> ';
$context .= $nav . $out;
include TEMPLATE_DIR . DS . $tpl . ".html";





































































