<?php

set_time_limit(490);
$tpl		 = 'admin';
$mod_name	 = 'модерация коментариев';
$context	 = '';
$brouse		 = '';
$lsize		 = '';
$page		 = @$this->param[0];
$f		 = new bootstrap\input();
$forma		 = $f->render_form('comments');
$curses		 = new model\curses();
$coments	 = new model\comments();
$tt		 = new model\misto();
$zur		 = $coments->getByLink($page);
if ($zur[0] != 'empty')
{
    foreach ($zur as $com)
    {

	$return[$com->parent_id][] = $com;
    }
    $context .= ' <div class="container">
    <div class="comments">
        <h3 class="title-comments">Комментарии (' . $coments->found . ')</h3>';

    $tree	 = new Tree();
    $tree->set_category_arr($return);
    $context = $tree->outTree(0, 0);
}
else
{
    $context .= "no komments";
}
$context .= ' </div">';

class Tree {

    public
	    $_category_arr = array();

    public
	    function set_category_arr($_category_arr) {
	$this->_category_arr = $_category_arr;
    }

    public
	    function outTree($parent_id, $level) {
	$out = '';
	if (isset($this->_category_arr[$parent_id]))
	{ //Если категория с таким parent_id существует
	    foreach ($this->_category_arr[$parent_id] as $value)
	    { //Обходим ее
		/**
		 * Выводим категорию
		 *   $level - хранит текущий уровень вложености (0,1,2..)
		 */
//		$out	 .= "<div class='card col-md-offset-" . ($level) . "'>"
//			. "<div class='header'>" . $value->name . "</div>"
//			. "<div class='col-6'>" . $value->body . "</div><br>";
		$out	 .= '<ul class="media-list">
                <li class="media">
                <div class="card col-9">
                    <div class="card-header d-flex row">
                        <div class="d-inline-flex justify-content-start">' . $value->name . '</div>
			<div class="d-inline-flex self">
                                <span class="date">' . $value->dt . '</span>
                        </div>
			<div class="ml-auto p-2">
				<a href="#" data-toggle="collapse" data-target="#collapse_' . $value->id . '" aria-expanded="true" ><i class="icon-action fa fa-chevron-down"></i></a>
			        <a href="' . WWW_ADMIN_PATH . 'moderation/editid/' . $value->id . '"><i class="icon-action fa fa-pen"></i></a>
			</div>
                    </div>
                    <div class="card-body" class="collapse show" id="collapse_' . $value->id . '">
		        <div class="row">
			<div class="col-2">
			    <img class="img-fluid rounded-circle" src="' . WWW_IMG_PATH . 'default_avatar.png" alt="...">
			</div>
			<div class="col-10 text-justify">' . $value->body . '</div>
			<div class="ml-auto p-2"><a href="' . WWW_ADMIN_PATH . 'moderation/del/' . $value->id . '"><i class="icon-action fa fa-trash"></i></a></div>
		    </div>

                </div>

                    </div>
</li>
		';
		$level++; //Увеличиваем уровень вложености
		//Рекурсивно вызываем этот же метод, но с новым $parent_id и $level
		$out	 .= $this->outTree($value->id, $level);
		$level--; //Уменьшаем уровень вложености
		$out	 .= "
        </ul>
";
	    }
	}
	return $out;
    }

}

include TEMPLATE_DIR . DS . $tpl . ".html";
?>
