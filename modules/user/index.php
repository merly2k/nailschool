<?php

ini_set("max_execution_time", 0);
$brouse		 = '';
$lsize		 = '';
$tpl		 = 'user';
$context	 = '';
$mod_name	 = "Лиды";
$vi		 = new model\leads();
$context	 .= "<table class='table table-striped table-bordered table-hover DataTable' >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Тип лида</th>
                                            <th>Лид</th>
                                            <th>Контакт</th>
                                            <th>Статус</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

foreach ($vi->GetAll() as $row)
{

    $stt	 = $vi->getStatusById($row->status);
    $mststus = $stt[0]->status;
    $context .= "<tr>"
	    . "<td>" . $row->id
	    . "</td>"
	    . "<td>" . $row->leadtype
	    . "</td>"
	    . "<td>" . getCurseInfo($row->curse)
	    . "</td>"
	    . "<td>" . $row->name . ' ' . $row->lname
	    . "</td>"
	    . "<td>" . $mststus
	    . "</td>"
	    . "<td class='panel'>"
	    . "<a href='" . WWW_USER_PATH . "edit/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>"
	    . "</td>"
	    . "</tr>";
}


$context .= '</tbody>';
$context .= "</table></div>";
$f	 = new bootstrap\input();
//$form=$f->render_form('setting');
//      $context.=$form;
include TEMPLATE_DIR . DS . $tpl . ".html";

function getCurseInfo($id) {
    $a	 = new model\curses();
    $o	 = $a->getCurseById($id);
    if (!is_array($o))
    {
	return $o->miso . ' ' . $o->start . '<br>' . $o->name_ru;
    }
    else
    {
	return;
    }
}
