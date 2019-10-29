<?php
$tpl='admin';
$vid= new model\video();
$f=new bootstrap\input();
$context='';
switch (@$this->param[0])
{
case 'edit':
    $id=$this->param[1];
$mod_name="Управление видеогалереей / редактируем видео";
if(!$_POST):

$row =$vid->getById($id) ;
    //print_r($row);
    $data=array(
	'id'=>$row->id,
	'link'=>"$row->link",
	'decr_ru'=>"$row->decr_ru",
	'dekr_ua'=>"$row->dekr_ua");
    //print_r($data);
$context='<form method="post">'.$f->renderFormByData('videogalery', $data)
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';


else:
    extract($_POST);
    $data=array(
	'link'=>"$link",
	'decr_ru'=>"$decr_ru",
	'dekr_ua'=>"$dekr_ua"
	);
   echo $vid->update($data,$id);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
endif;
	break;
case 'del':
$mod_name="Управление видеогалереей /удаление видео";
    $id=$this->param[1];
$vid->delete($id);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
	break;
case 'new':
$mod_name="Управление видеогалереей /новый видеофайл";
if(!$_POST){
    
$context='<form method="post">'.$f->render_form('videogalery')
	.'<button class="btn btn-info" type="submit">save</button>'
	. '</form>';
}
else
{
    //print_r($_POST);
    $data=array(
	'link'=>$_POST['link'],
	'deckr_ru'=>$_POST['decr_ru'],
	'deckr_ua'=>$_POST['dekr_ua']
	
	);
    $vid->insert($data);
$context.="<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
}
	break;

    default:
$mod_name="Управление видеогалереей";
$context.='<a class="btn btn-info" href="'.WWW_ADMIN_PATH.'video/new">добавить видео</a><br><br>'
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
	. '<td>'.$row->decr_ru
	. '</td>'
	. '<td>'
	    . "<a href='".WWW_ADMIN_PATH."video/edit/".$row->id."'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='".WWW_ADMIN_PATH."video/del/".$row->id."'>
		    <i class='fa fa-trash-o'></i></a>"
	. '</td>'
	. '</tr>';
}
$context.='</tbody></table>';
	break;
}
include TEMPLATE_DIR . DS . $tpl . ".html";
?>














































































































