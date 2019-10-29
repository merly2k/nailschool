<?php
$tpl='admin';
$vid= new model\btblock();
$f=new bootstrap\input();
$context='';
switch (@$this->param[0])
{
case 'edit':
    $id=$this->param[1];
$mod_name="Управление статическими блоками";
if(!$_POST):

$row =$vid->getById($id) ;
    //'id','pagename','header_ua','header_ru','content_ua','content_ru'
$context='<form method="post">'.$f->renderFormByData('staticblock',(array)$row)
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';


else:
    extract($_POST);
    $data=$_POST;
   echo $vid->update($data,$id);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "stblocck/'); }, 900)</script>";
endif;
	break;
case 'del':
$mod_name="Управление видеогалереей /удаление видео";
    $id=$this->param[1];
$vid->delete($id);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "stblocck/'); }, 900)</script>";
	break;
case 'new':
$mod_name="Управление видеогалереей /новый видеофайл";
if(!$_POST){
    
$context='<form method="post">'.$f->render_form('staticblock')
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';
}
else
{
 //'id','pagename','header_ua','header_ru','content_ua','content_ru'
 //print_r($_POST);
    $data= (array)$_POST;
    $vid->insert($data);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "stblocck/'); }, 900)</script>";
}
	break;

    default:
$mod_name="Управление статическими блоками";
$context.='<a class="btn btn-info" href="'.WWW_ADMIN_PATH.'stblocck/new">добавить блок</a><br><br>'
	. '<table class="table table-bordered datatable">'
	. '<thead>'
	. '<tr>'
	. '<th> страница'
	. '</th>'
	. '<th> заголовок'
	. '</th>'
	. '<th> действие'
	. '</th>'
	. '</tr>'
	. '</thead><tbody>';
foreach ($vid->getList() as $row){
    //id name source duration img decription
    //'id','pagename','header_ua','header_ru','content_ua','content_ru'
    $context.='<tr>'
	. '<td>'.$row->pagename
	. '</td>'
	. '<td>'.$row->header_ru
	. '</td>'
	. '<td>'
	    . "<a href='".WWW_ADMIN_PATH."stblocck/edit/".$row->id."'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='".WWW_ADMIN_PATH."stblocck/del/".$row->id."'>
		    <i class='fa fa-trash-o'></i></a>"
	. '</td>'
	. '</tr>';
}
$context.='</tbody></table>';
	break;
}
include TEMPLATE_DIR . DS . $tpl . ".html";
?>













































































































































