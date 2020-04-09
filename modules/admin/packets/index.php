<?php

set_time_limit(490);
$tpl		 = 'admin';
$mod_name	 = 'Пакеты курсов';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$town		 = @$this->param[0];
$context	 .= ' <ul class="nav nav-tabs">';
$f		 = new bootstrap\input();
$forma		 = $f->render_form('cursses');
$packets	 = new model\packets();
$tt		 = new model\misto();

foreach ($tt->getAll() as $t)
{
    //print_r($t);
    if ($town == $t->link)
    {
	$active		 = 'active';
	$mod_name	 = "Пакеты : $t->name_ua";
    }
    else
    {
	$active = '';
    }
    $context .= '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'packets/' . $t->link . '">' . $t->name_ua . '</a></li> ';
}
$context .= "</ul>";
if (isset($town)):
    $context .= '<a href="add" class="btn btn-primary">Создать пакет курсов</a><hr>'
	    . '<table class="table DataTable"><thead><tr>'
	    . '<th>порядок</th>'
	    . '<th>пакет</th>'
	    . '<th>цена</th>'
	    . '<th>Длительность</th>'
	    . '<th>Действие</th>'
	    . '</tr>'
	    . '</thead>';
    foreach ($packets->getPackets($town)as $cl)
    {

	$context .= "<tr>
		<td>$cl->porjadok</td>
		<td>$cl->name_ua</td>
		<td>$cl->coast</td>
		<td>$cl->dayz</td>
		<td><a href='" . WWW_ADMIN_PATH . "packets/edit/$cl->id'><i class='fa fa-edit'> </i></a>
		<a href='del/$cl->id'><i class='fa fa-trash'> </i></a></td>
		</tr>";
    }
else:
    $context .= "выберите город";
endif;



$context .= '</ul> ';


include TEMPLATE_DIR . DS . $tpl . ".html";













