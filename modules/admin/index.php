<?php

ini_set("max_execution_time", 0);
$brouse		 = '';
$lsize		 = '';
$tpl		 = 'admin';
$context	 = '';
$mod_name	 = "Лиды";
$vi		 = new model\leads();
$packet		 = new model\packets();
$context	 .= "<table class='table table-striped table-bordered table-hover DataTable'  data-order='[[ 4, \"desc\" ]]'>
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
    if (firstChar($row->curse) != 'p')
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
		. "<a href='" . WWW_ADMIN_PATH . "edit/" . $row->id . "'>
		    <i class='fa fa-pencil' title='edit'> </i></a>"
		. "</td>"
		. "</tr>";
    }
    else
    {
	$id	 = preg_replace('/p/', '', $row->curse);
	$pinfo	 = $packet->getPacket($id);
	$info	 = ($pinfo[0]);
	//print_r($info);
	$context .= "<tr>"
		. "<td>" . $row->id
		. "</td>"
		. "<td>" . $row->leadtype
		. "</td>"
		. "<td>" . $info->town . '<br><b>пакет:</b> ' . $info->name_ru
		. "</td>"
		. "<td>" . $row->name . ' ' . $row->lname
		. "</td>"
		. "<td>" . $mststus
		. "</td>"
		. "<td class='panel'>"
		. "<a href='" . WWW_ADMIN_PATH . "edit/" . $row->id . "'>
		    <i class='fa fa-pencil' title='edit'> </i></a>"
		. "</td>"
		. "</tr>";
    }
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
    return $o->miso . ' ' . $o->start . '<br>' . $o->name_ru;
}

