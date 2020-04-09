<?php

$brouse	 = '';
$lsize	 = '';
$tpl	 = 'admin';
$vid	 = new model\video();
$f	 = new bootstrap\input();
$context = '';
switch (@$this->param[0])
{
    case 'edit':
	$id		 = $this->param[1];
	$mod_name	 = "Управление видеогалереей / редактируем видео";
	if (!$_POST):

	    $row	 = $vid->getById($id);
	    //print_r($row);
	    $data	 = array(
		'id'		 => $row->id,
		'link'		 => "$row->link",
		'name_ua'	 => "$row->name_ua",
		'name_ru'	 => "$row->name_ru",
		'decr_ru'	 => "$row->decr_ru",
		'dekr_ua'	 => "$row->dekr_ua",
		'kurse'		 => "$row->kurse"
	    );

	    //print_r($data);
	    $context = '<form method="post">' . $f->renderFormByData('videogalery', $data)
		    . '<button class="btn btn-info" type="submit">save</button>'
		    . '</form>';


	else:
	    extract($_POST);
	    $data	 = array(
		'link'		 => "$link",
		'name_ua'	 => "$name_ua",
		'name_ru'	 => "$name_ru",
		'decr_ru'	 => "$decr_ru",
		'dekr_ua'	 => "$dekr_ua",
		'kurse'		 => "$kurse"
	    );
	    echo $vid->update($data, $id);
	    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
	endif;
	break;
    case 'del':
	$mod_name	 = "Управление видеогалереей /удаление видео";
	$id		 = $this->param[1];
	$vid->delete($id);
	$context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
	break;
    case 'new':
	$mod_name	 = "Управление видеогалереей /новый видеофайл";
	if (!$_POST)
	{

	    $context = '<form method="post">' . $f->render_form('videogalery')
		    . '<button class="btn btn-info" type="submit">save</button>'
		    . '</form>';
	}
	else
	{
	    //print_r($_POST);
	    $data	 = array(
		'link'		 => $_POST['link'],
		'name_ua'	 => $_POST['name_ua'],
		'name_ru'	 => $_POST['name_ru'],
		'deckr_ru'	 => htmlspecialchars($_POST['decr_ru'], ENT_QUOTES),
		'deckr_ua'	 => htmlspecialchars($_POST['dekr_ua'], ENT_QUOTES),
		'kurse'		 => $_POST['kurse']
	    );
	    $vid->insert($data);
	    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "video/'); }, 900)</script>";
	}
	break;

    default:
	$mod_name	 = "Управление видеогалереей";
	$context	 .= '<a class="btn btn-info" href="' . WWW_ADMIN_PATH . 'video/new">добавить видео</a><br><br>'
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
	foreach ($vid->getList() as $row)
	{
	    //id name source duration img decription
	    $context .= '<tr>'
		    . '<td>' . $row->link
		    . '</td>'
		    . '<td>' . $row->decr_ru
		    . '</td>'
		    . '<td>'
		    . "<a href='" . WWW_ADMIN_PATH . "video/edit/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='" . WWW_ADMIN_PATH . "video/del/" . $row->id . "'>
		    <i class='fa fa-trash-o'></i></a>"
		    . '</td>'
		    . '</tr>';
	}
	$context .= '</tbody></table>';
	break;
}
include TEMPLATE_DIR . DS . $tpl . ".html";
?>























































































































