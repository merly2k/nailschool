<?php

ini_set("max_execution_time", 0);
$tpl		 = 'admin';
$context	 = '';
$mod_name	 = "Лиды";
$vi		 = new model\leads();
$context	 .= "<table class='table table-striped table-bordered table-hover' >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Лид</th>
                                            <th>Контакт</th>
                                            <th>Статус</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

foreach ($vi->getNew() as $row)
{
    //$context.=print_r($v,true);
    $context .= "<tr>"
	    . "<td>" . $row->id
	    . "</td>"
	    . "<td>" . getCurseInfo($row->curse)
	    . "</td>"
	    . "<td>" . $row->name . ' ' . $row->lname
	    . "</td>"
	    . "<td>" . $row->status
	    . "</td>"
	    . "<td class='panel'>"
	    . "<a href='" . WWW_ADMIN_PATH . "edit/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>"
	    . "</td>"
	    . "<tr>";
}


$context .= '</tbody></table>';
$context .= "</table></div>";
$f	 = new bootstrap\input();
//$form=$f->render_form('setting');
//      $context.=$form;
include TEMPLATE_DIR . DS . $tpl . ".html";

function getCurseInfo($id) {
    $a	 = new model\curses();
    $o	 = $a->getCurseById($id);
    return $o->miso . ' ' . $o->start . '<br>' . $o->name_ru;
}

