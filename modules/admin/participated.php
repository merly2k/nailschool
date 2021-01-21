<?php

ini_set("max_execution_time", 0);
$brouse		 = '';
$lsize		 = '';
$tpl		 = 'admin/admin';
$mod_name	 = "Лиды";
$vi		 = new model\leads();
$packet		 = new model\packets();
$stst		 = $vi->statusList();
switch (@$this->param[0])
{
    case 'no':
	$ppt	 = $vi->getParcipated(0);
	$as1	 = '';
	$as2	 = 'active';
	break;
    case 'yes':
	$ppt	 = $vi->getParcipated(1);
	$as1	 = 'active';
	$as2	 = '';

	break;

    default:
	$ppt	 = $vi->getParcipated(1);
	$as1	 = 'active';
	$as2	 = '';

	break;
}
$context = '<ul class="nav nav-tabs">'
	. '<li class="nav-item"><a class="nav-link ' . $as1 . '" href="' . WWW_ADMIN_PATH . 'participated">Подписаны на новости</a></li>'
	. '<li class="nav-item"><a class="nav-link ' . $as2 . '" href="' . WWW_ADMIN_PATH . 'participated/no">Не подписаны на новости</a></li>'
	. '</ul>';
$context .= "<table class='table table-striped table-bordered table-hover DataTable'  data-order='[[ 0, \"desc\" ]]'>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class='all'>Контакт</th>
                                            <th>email</th>
                                            <th>phone</th>
                                            <th>коментарий</th>
                                            <th class='all'>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
foreach ($ppt as $row)
{

    $context .= "<tr>"
	    . "<td>" . $row->id
	    . "</td>"
	    . "<td>" . $row->name . ' ' . $row->lname
	    . "</td>"
	    . "<td>" . $row->email
	    . "</td>"
	    . "<td>" . $row->phone
	    . "</td>"
	    . "<td>" . $row->coment
	    . "</td>"
	    . "<td class='panel'>"
	    . "<a href='" . WWW_ADMIN_PATH . "edit/" . $row->id . "'>
		    <i class='fa fa-pencil' title='edit'> </i></a>"
	    . "</td>"
	    . "</tr>";
}
$context .="</tbody></table>";
include TEMPLATE_DIR . DS . $tpl . ".html";
