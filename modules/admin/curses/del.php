<?php

$a = new model\curses();
if (!$_POST)
{
    $template	 = "admin"; //dform; //"index";
    $context	 = '';
    $id		 = $this->param[0];
    $ajax		 = "";
    $curs		 = $a->getCurseById($id);

    $mod_name	 = 'Удаление Курса';
    $context	 .= "<article class='module width_full'><h3><h3>Удаление Курса " . $curs->name_ru . "</h3></h3>
		<div class='module_content'> ";
    $context	 .= "<fieldset>
<legend>если вы хотите удалить курс " . $curs->name_ru . " нажмите &quot;удалить&quot;<br>
    в противном случае нажмите &quot;отменить&quot;
</legend>
<form name='del_content' method='POST'>
    <input type='hidden' name='id' value='$id' />
    <div class='submit_link'>
        <button type='submit' name='act' value='Удалить' class='btn btn-danger'>Удалить</button>
	<a href='" . WWW_ADMIN_PATH . "curses' class='btn btn-info'>Отменить</a>
    </div>
</form>
</fieldset>
";
    include TEMPLATE_DIR . DS . $template . ".html";
}
else
{
    $id = $_POST['id'];
    //echo 'curs ' . $id . " whil be deleted";
    $a->delCurse($id);
    echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "curses'); }, 900)</script>";
}




































