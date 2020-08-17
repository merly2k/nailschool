<?php

ini_set("max_execution_time", 0);
$brouse		 = '';
$lsize		 = '';
$tpl		 = 'admin';
$context	 = '<ul class="nav nav-tabs nav-justified">'
	. '<li class="nav-item"><a class="nav-link" href="' . WWW_ADMIN_PATH . '"> Все лиды</a></li>';
$mod_name	 = "Лиды";
$vi		 = new model\leads();
$packet		 = new model\packets();
$stst		 = $vi->statusList();
foreach ($stst as $st)
{
    if (isset($this->param[0]) and @ $this->param[0] == $st->id)
    {
	$context .= "<li class='nav-item'><a class='nav-link active' href='$st->id'> $st->status</a></li> ";
    }
    else
    {
	$context .= "<li class='nav-item'><a class='nav-link' href='$st->id'> $st->status</a></li> ";
    }
}
$context .= '</ul>';

$context .= "<table class='table table-striped table-bordered table-hover DataTable'  data-order='[[ 0, \"desc\" ]]'>
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
if (!isset($this->param[0]))
{
    $datat = $vi->GetAll();
}
else
{
    $datat = $vi->getByStatus($this->param[0]);
}


foreach ($datat as $row)
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
	$stt	 = $vi->getStatusById($row->status);
	$mststus = $stt[0]->status;
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
		. "<a href='" . WWW_ADMIN_PATH . "edit/p" . $row->id . "'>
		    <i class='fa fa-pencil' title='edit'> </i></a>"
		. "</td>"
		. "</tr>";
    }
}


$context .= '</tbody>';
$context .= "</table></div>";

$f = new bootstrap\input();
//$form=$f->render_form('setting');
//      $context.=$form;

include TEMPLATE_DIR . DS . $tpl . ".html";

function getCurseInfo($id) {
    $a	 = new model\curses();
    $o	 = $a->getCurseById($id);

    if (empty($o))
    {
	$vl = new model\leads();
	$vl->query("delete from `leads` where `id`='$id'");
	return $vl->lastState;
    }
    else
    {
	return $o->miso . ' ' . $o->start . '<br>' . $o->name_ru;
    }
}

