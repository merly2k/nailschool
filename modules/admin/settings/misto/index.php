<?php

$tpl		 = 'admin/admin';
$vid		 = new model\misto();
$f		 = new bootstrap\input();
$context	 = '';
$lsize		 = ' 630×360px';
$web_brouse	 = WWW_IMAGE_PATH . 'towns/';
$brouse		 = APP_PATH . '/images/towns/';
switch (@$this->param[0])
{
    case 'edit':
	$id		 = $this->param[1];
	$mod_name	 = "Управление городами / редактируем город";
	if (!$_POST):

	    $row		 = $vid->getById($id);
	    //print_r($row);
	    $data		 = (array) $row;
	    $data['image']	 = $web_brouse . $data['image'];
	    $context	 = '<form enctype="multipart/form-data" method="post">' . $f->renderFormByData('misto', $data)
		    . '<button class="btn btn-info" type="submit">save</button>'
		    . '</form>';


	else:
//    print_r($_FILES);
	    if (!empty($_FILES['image']['name']))
	    {
		$image	 = array('image' => imgUpload());
		$data	 = array_merge($_POST, $image);
	    }
	    else
	    {
		$data = $_POST;
	    }
	    //print_r($data);
	    $data['image']	 = basename($_POST['image']);
	    echo $vid->update(array_filter($data), $id);
	    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/misto/'); }, 900)</script>";
	endif;
	break;
    case 'del':
	$mod_name	 = "Управление городами /удаление города";
	$id		 = $this->param[1];
	$vid->delete($id);
	$context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/misto/'); }, 900)</script>";
	break;
    case 'new':
	$mod_name	 = "Управление городами /новый город";
	if (!$_POST)
	{

	    $context = '<form method="post">' . $f->render_form('misto')
		    . '<button class="btn btn-info" type="submit">save</button>'
		    . '</form>';
	}
	else
	{
	    //  print_r($_POST);
	    $data	 = array(
		'link'		 => $_POST['link'],
		'name_ua'	 => $_POST['name_ua'],
		'name_ru'	 => $_POST['name_ru'],
		'image'		 => $_POST['image'],
		'addr_ua'	 => $_POST['addr_ua'],
		'addr_ru'	 => $_POST['addr_ru'],
		'phones'	 => $_POST['phones'],
		'viber'		 => $_POST['viber'],
		'fb'		 => $_POST['fb'],
		'inst'		 => $_POST['inst'],
		'gmap'		 => $_POST['gmap']
	    );
	    $vid->insert($data);
	    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/misto/'); }, 900)</script>";
	}
	break;

    default:
	$mod_name	 = "Управление городами";
	$context	 .= '<a class="btn btn-info" href="' . WWW_ADMIN_PATH . 'settings/misto/new">добавить город</a><br><br>'
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
		    . '<td>' . $row->name_ua
		    . '</td>'
		    . '<td>'
		    . "<a href='" . WWW_ADMIN_PATH . "settings/misto/edit/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='" . WWW_ADMIN_PATH . "settings/misto/del/" . $row->id . "'>
		    <i class='fa fa-trash-o'></i></a>"
		    . '</td>'
		    . '</tr>';
	}
	$context .= '</tbody></table>';
	break;
}
include TEMPLATE_DIR . DS . $tpl . ".html";
?>

