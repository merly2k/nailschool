<?php
$tpl='admin';
$vid= new model\misto();
$f=new bootstrap\input();
$context='';
switch (@$this->param[0])
{
case 'edit':
    $id=$this->param[1];
$mod_name="Управление городами / редактируем город";
if(!$_POST):

$row =$vid->getById($id) ;
    //print_r($row);
    $data=array(
	'id'=>$row->id,
	'link'=>"$row->link",
	'name_ru'=>"$row->name_ru",
	'name_ua'=>"$row->name_ua");
    //print_r($data);
$context='<form method="post">'.$f->renderFormByData('misto',(array)$row)
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';


else:
    extract($_POST);
    $data=$_POST;
   echo $vid->update($data,$id);
//$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "misto/'); }, 900)</script>";
endif;
	break;
case 'del':
$mod_name="Управление городами /удаление города";
    $id=$this->param[1];
$vid->delete($id);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/misto/'); }, 900)</script>";
	break;
case 'new':
$mod_name="Управление городами /новый город";
if(!$_POST){
    
$context='<form method="post">'.$f->render_form('misto')
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';
}
else
{
    //print_r($_POST);
    $data=array(
	'link'=>$_POST['link'],
	'deckr_ru'=>$_POST['name_ua'],
	'deckr_ua'=>$_POST['dekr_ua']
	
	);
    $vid->insert($data);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "misto/'); }, 900)</script>";
}
	break;

    default:
$mod_name="Управление видеогалереей";
$context.='<a class="btn btn-info" href="'.WWW_ADMIN_PATH.'misto/new">добавить видео</a><br><br>'
	. '<table class="table table-bordered datatable">'
	. '<thead>'
	. '<tr>'
	. '<th> источник(URL)'
	. '</th>'
	. '<th> описание'
	. '</th>'
	. '<th> действие'
	. '</th>'
	. '</tr>'
	. '</thead><tbody>';
foreach ($vid->getList() as $row){
    //id name source duration img decription
    $context.='<tr>'
	. '<td>'.$row->link
	. '</td>'
	. '<td>'.$row->name_ua
	. '</td>'
	. '<td>'
	    . "<a href='".WWW_ADMIN_PATH."settings/misto/edit/".$row->id."'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='".WWW_ADMIN_PATH."settings/misto/del/".$row->id."'>
		    <i class='fa fa-trash-o'></i></a>"
	. '</td>'
	. '</tr>';
}
$context.='</tbody></table>';
	break;
}
include TEMPLATE_DIR . DS . $tpl . ".html";
?>

































































































































