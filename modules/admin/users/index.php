<?php

$context	 = '';
$brouse		 = '';
$lsize		 = '';
$template	 = "admin";
$mod_name	 = "управление пользователями";
$ulist		 = new model\user();

$context .= "<a class='btn btn-info' href='" . WWW_ADMIN_PATH . "users/add_user'>Додати співробітника</a>"
	. "<br><hr>"
	. "<div class='box-body table-responsive'>"
	. "<table id='users' class='table table-bordered table-hover dataTable'>"
	. "<thead>"
	. "<tr>"
	. "<th class='sorting' role='columnheader'>login</th>"
	. "<th>Действия</th>"
	. "</tr>"
	. "</thead>"
	. "<tbody>";
foreach ($ulist->getUsers() as $row)
{
    //$context.=print_r($row,true);
    $context .= "<tr>"
	    . "<td>$row->login</td>"
	    . "<td><a href='" . WWW_ADMIN_PATH . "users/edit_profile/$row->id'><i class='fa fa-edit' title='редагувати'></i></a>&nbsp;&nbsp;"
	    . "<a href='" . WWW_ADMIN_PATH . "users/del_profile/$row->id'><i class='fa fa-trash-o' title='видалити'></i></a></td>"
	    . "</tr>";
}

$context .= "</tbody></table></div>";


include TEMPLATE_DIR . $template . ".html";

