<?php

$tpl		 = "admin";
$mod_name	 = "Управление привязкой элементов галереи к курсу";
$context	 = '';
$nav		 = ' <ul class="nav nav-tabs">';
$curses		 = new model\curses();
$towns		 = new model\misto();
$town		 = @$this->param[0];
$cur_curs	 = @$this->param[1];
$imglist	 = '';
$brouse		 = '';
$lsize		 = '';
$lnav		 = '';
if (isset($cur_curs))
{
    //echo $town . " " . $cur_curs;
    $ss	 = $curses->getCurse($town, $cur_curs);
    $btText	 = $ss[0]->name_ru;
    $gal	 = new model\photogalery();
    $imgaray = $gal->GetPhotos($town, $cur_curs);
    $fp	 = APP_PATH . "/images/galery/" . '*.{jpg,png,gif}';
    $photos	 = array_map('basename', glob($fp, GLOB_BRACE));
    $llet	 = '';
    foreach ($photos as $k => $photo)
    {
	$firstletter = mb_substr($photo, 0, 1);
	if ($firstletter != $llet)
	{
	    $llet	 = $firstletter;
	    $lnav	 .= "<a class='btn btn-info' href='" . chr(35) . $llet . "'>" . $llet . "</a> ";
	    $imglist .= "<a name='$firstletter'></a>";
	}
	if (in_array($photo, $imgaray))
	{
	    $checked = "checked='checked'";
	}
	else
	{
	    $checked = '';
	}
	$imglist .= "<div class='card col-2'>"
		. "<img class='img-thumbnail' src='" . WWW_IMAGE_PATH . "galery/" . $photo . "' >"
		. "<small>$photo</small>"
		. "<input id='_$k' type='checkbox' $checked onclick=\"galerist($k,'$town','$cur_curs','$photo')\"><p></p>"
		. "</div>";
    }
}
else
{
    $btText = 'выберите курс';
}

$f = new bootstrap\input();
foreach ($towns->getAll() as $t)
{
    if ($t->link == $town)
    {
	$active = 'active';
    }
    else
    {
	$active = '';
    }
    $nav .= '<li class="nav-item">'
	    . '<a class="nav-link ' . $active . '" href="' . WWW_ADMIN_PATH . 'galery/curses/' . $t->link . '">'
	    . $t->name_ua . '</a>'
	    . '</li> ';
}
$nav	 .= "</ul>";
$context .= $nav . $lnav;
if (isset($town)):
    $but = '<div class="dropdown">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
   ' . $btText . '
  </button>
  <div class="dropdown-menu scrollable-menu">';
    foreach ($curses->getALLasArray($town)as $li)
    {

	$but .= '<a class="dropdown-item" href="' . WWW_ADMIN_PATH . 'galery/curses/' . $town . "/" . $li->link . '">' . $li->name_ru . '</a>';
    }
    $but	 .= '</div></div> ';
    $context .= $but . '<div class="row">' . $imglist . '</div>';

else:
    $context .= "Выберите город и курс";

endif;
include TEMPLATE_DIR . DS . $tpl . ".html";
















