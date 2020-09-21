<?php

set_time_limit(490);
$tpl		 = 'admin';
$mod_name	 = 'модерация коментариев';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$town		 = @$this->param[0];
$context	 .= ' <ul class="nav nav-tabs">';
$f		 = new bootstrap\input();
$forma		 = $f->render_form('cursses');
$curses		 = new model\curses();
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
    $context .= '<li class="nav-item"><a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'moderation/' . $t->link . '">' . $t->name_ua . '</a></li> ';
}
$context .= "</ul>";
if (isset($town)):
    $context .= ''
	    . '<table class="table DataTable"><thead><tr>'
	    . '<th>курс</th>'
	    . '</tr>'
	    . '</thead>';
    foreach ($curses->getALL($town)as $cl)
    {

	$context .= "<tr>
		<td>
		<a href='" . WWW_ADMIN_PATH . "moderation/edit/$cl->link'><i class='fas fa-eye'>" . strip_tags($cl->name_ru) . "</i></a>
		</td>
		</tr>";
    }
else:
    $context .= "выберите город";
endif;



$context .= '</ul> ';


include TEMPLATE_DIR . DS . $tpl . ".html";




























