<?php
error_reporting(0);
$tpl="admin/admin";
$context='<a href="'.WWW_ADMIN_PATH.'fidback/add" class="btn btn-info">новый отзыв</a>'
	. '<table class="table table-bordered datatable"><thead>'
	. '<tr>'
	. '<th>id</th>'
	. '<th>имя</th>'
	. '<th>город</th>'
	. '<th>Действия</th>'
	. '</tr>'
	. '</thead><tbody>';
   
$mod_name="Управление отзывами(слайдер)";

$fd= new model\feedbask();
foreach ($fd->getAll() as $row){
$context.= '<tr>'
	. "<td>$row->id</td>"
	. "<td>$row->name_ru</td>"
	. "<td>$row->misto_ru</td>"
	. "<td>"
	. "<a class='btn btn-info'  href='".WWW_ADMIN_PATH."fidback/edit/$row->id'><b class='fa fa-edit'></b></a>&nbsp;"
	. "<a class='btn btn-info' href='".WWW_ADMIN_PATH."fidback/del/$row->id'><b class='fa fa-trash'></b></a>"
	. "</td>"
	. '</tr>';

}
$context.='</tbody></table>';
include TEMPLATE_DIR . DS . $tpl . ".html";
