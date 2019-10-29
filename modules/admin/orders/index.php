<?php
$template = "admin";
$mod_name='Управление товарами';
$langua='';
$langru='';
$langen='';
$context='';

$cont_id = @$this->param[0];
$ed = new model\tovar();
$ajax = " ";
$orders= new model\orders();
$context.="<table class='table DataTable table-striped table-bordered table-hover'>"
	. "<thead><tr>"
	. "<th>№</th>"
	. "<th>заказ</th>"
	. "<th>статус</th>"
	. "<th>Коментарий</th>"
	. "<th>мои заметки</th>"
	. "<th>дата заказа</th>"
	. "<th>действия</th>"
	. "</tr>"
	. "</thead>"
	. "<tbody>";
foreach ($orders->getAll() as $v)
{
   //$context.=print_r($v,true);
   $context.= "<tr>"
	. "<th>$v->id</th>"
	. "<td>"
	.  "товар:". $v->order_ids
	. "</td>"
	. "<td>$v->status</td>"
	. "<td>$v->User_comment</td>"
	. "<td>$v->komment</td>"
	. "<td>$v->date</td>"
	. "<td></td>"
	. "</tr>";
	
	//[login]
	//[password]
	//[address] 
	//[npId]  
    
}
$context.="<tbody></table>";

$f=new bootstrap\input();
$forma= $f->render_form('orders');
include TEMPLATE_DIR . DS . $template . ".html";
?>








































