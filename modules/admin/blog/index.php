<?php

$tpl		 = "admin/admin";
$lsize		 = ' 640×397px';
$template	 = "admin/bladmin";
$brouse		 = APP_PATH . '/images/articles/';
$web_brouse	 = WWW_IMAGE_PATH . 'articles/';
$mod_name	 = 'Управление блогом';
$context	 = '';

$cont_id = @$this->param[0];
$ed	 = new model\blog();
$ajax	 = " ";


$f	 = new bootstrap\input();
$forma	 = $f->render_form('blog');
if ($_POST)
{
    extract($_POST);
    if (!isset($id))
    {
	$id = @$this->param[1];
    }

    $content_ru = preg_replace('@<span style="font-size: 1rem;">@', '<p>', $content_ru);
    $content_ru = preg_replace('@<span style="white-space:pre">@', '<p>', $content_ru);
    $content_ru = preg_replace('@</span>@', '</p>', $content_ru);
    $content_ua = preg_replace('@<span style="font-size: 1rem;">@', '<p>', $content_ua);
    $content_ua = preg_replace('@<span style="white-space:pre">@', '<p>', $content_ua);
    $content_ua = preg_replace('@</span>@', '</p>', $content_ua);
    
    $params	 = array(
	'id'		 => $id,
	'title_ua'		 => $title_ua,
	'title_ru'		 => $title_ru,
	'link'		 => $link,
	'content_ru'	 => $content_ru,
	'content_ua'	 => $content_ua,
	'pdate'		 => $pdate,
	'image'		 => $image,
	'tags'		 => $tags,
	'pub'		 => $pub
    );
    if ($cont_id == 'new')
    {
	$ed->Insert($params);
    }
    elseif ($cont_id == 'update')
    {
        $image		 = basename($_POST['image']);
	$id = $this->param[1];
        $params	 = array(
	'id'		 => $id,
	'title_ua'	 => $_POST['title_ua'],
	'title_ru'	 => $_POST['title_ru'],
	'link'		 => $_POST['link'],
	'content_ru'	 => $_POST['content_ru'],
	'content_ua'	 => $_POST['content_ua'],
	'pdate'		 => $_POST['pdate'],
	'image'		 => basename($_POST['image']),
	'tags'		 => $_POST['tags'],
	'pub'		 => $_POST['pub']);
    
	$ed->Upostdate($params, $id);
    }
    if ($ed->lastState)
    {
	echo $ed->lastState;
    }
    else
    {
	$message = "сохранено";
	echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "blog/'); }, 900)</script>";
    }
}

if ($cont_id == 'new')
{

    $context .= "<form method='post'>$forma"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
}
elseif (is_numeric($cont_id))
{
    
    $data	 = $ed->SelectBy($cont_id);
$img=$data[0]->image;
$data[0]->image=$web_brouse.$img;
    $form	 = $f->renderFormByData('blog', (array) $data[0]);
    $context .= "<form method='post' action='update/$cont_id'>$form"
	    . "<button type='submit' class='btn btn-info'>Опубликовать</button>"
	    . "</form>";
}
else
{
    $context .= '<a class="btn btn-info" href="' . WWW_ADMIN_PATH . 'blog/new">добавить статью</a>
                                <table class="table  table-striped table-bordered table-hover DataTable" >
                                    <thead user-scalable="no">
                                        <tr>
                                            <th>#</th>
                                            <th>Заголовок</th>
                                            <th>Статья</th>
                                            <th>действие</th>
                                        </tr>
                                    </thead>
                                    <tbody>
				    ';

    foreach ($ed->SelectAll() as $row)
    {
	$context .= "<tr><td>" . $row->id
		. "</td><td>" . $row->title_ua
		. "</td><td>" . strip_tags($row->lcontent_ua)
		. "</td>"
		. "<td class='panel'>"
		. "<a href='" . WWW_ADMIN_PATH . "blog/" . $row->id . "'>
		    <i class='fa fa-pencil'></i></a>
		    &nbsp;&nbsp;
                    <a href='" . WWW_ADMIN_PATH . "blog/del_content/" . $row->id . "'>
		    <i class='fa fa-trash-o'></i></a>"
		. "</td>"
		. "</tr>
		";
    };
    $context .= "</tbody></table>
	    ";
}



include TEMPLATE_DIR . DS . $template . ".html";
