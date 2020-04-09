<?php

$tpl		 = 'admin';
$context	 = '';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "Настройки градиентов";
$brouse		 = '';
$lsize		 = '';
$grad		 = new model\gradients();
$context	 = '<div class="row">';
$fr		 = new bootstrap\input();
if (!$_POST):
    foreach ($grad->getAll() as $val)
    {
	//$context .= print_r($val, true);
	$context .= '<div class="card col-2" style="'
		. "background-image: -moz-linear-gradient(0deg, $val->start 0%, $val->middle 30%, $val->end 100%) !important;
	    background-image: -webkit-linear-gradient(0deg, $val->start 0%, $val->middle 30%, $val->end 100%) !important;
	    background-image: -ms-linear-gradient(0deg, $val->start  0%, $val->middle 30%, $val->end 100%) !important;" . '">'
		. '<a href="' . WWW_ADMIN_PATH . 'settings/gradients/edit/' . $val->name . '">' . $val->name . '</a></div>';
    }
    $context .= '</div>';
    $context .= '<div class="gedit card col-12">'
	    . '<form method="post">';
    $ed	 = $grad->getGradient($this->param[0]);
//$context .= print_r($ed, true);
    $context .= "<div class='col-12 edgradient'"
	    . "style='background-image: -moz-linear-gradient(0deg, $ed->start 0%, $ed->middle 30%, $ed->end 100%) !important;"
	    . "background-image: -webkit-linear-gradient(0deg, $ed->start 0%, $ed->middle 30%, $ed->end 100%) !important;"
	    . "background-image: -ms-linear-gradient(0deg, $ed->start  0%, $ed->middle 30%, $ed->end 100%) !important;'"
	    . "'><br>Образец градиента<br></div>"
	    . "<hr>";
    $context .= '<div class="row">'
	    . '<div class="col-3">название</div>'
	    . '<div class="col-8">'
	    . '<input type="text" class="form-control" id="name" placeholder="название градиента" name="name" value="' . $ed->name . '" required="required" onkeyup="setgrad(\'middle\')">'
	    . '</div></div>'
	    . '<div class="row">'
	    . '<div class="col-12">параметры градиента</div>'
	    . '<div class="col-4">'
	    . '<input type="text" class="form-control" id="start" placeholder="hex value" name="start" value="' . $ed->start . '" required="required" onkeyup="setgrad(\'start\')">'
	    . '</div>'
	    . '<div class="col-4">'
	    . '<input type="text" class="form-control" id="middle" placeholder="hex value" name="middle" value="' . $ed->middle . '" required="required" onkeyup="setgrad(\'middle\')">'
	    . '</div>'
	    . '<div class="col-4"><input type="text" class="form-control" id="end" placeholder="hex value" name="end" value="' . $ed->end . '" required="required" onkeyup="setgrad(\'end\')"></div>'
	    . '</div>'
	    . '<div><p></p>'
	    . '<div class="row">'
	    . '<button class="btn btn-info ml-auto" type="submit">сохранить</button>'
	    . '</div>'
	    . '</div>';
    $context .= '</form><p></p></div>';
else:

    $grad->edit($_POST);

    header("Location: ../");
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";













































































