<?php

//echo $this->param[0];
$brouse		 = '';
$lsize		 = '';
$a		 = new model\leads();
$b		 = new model\packets();
$f		 = new bootstrap\input();
$template	 = "admin";
$context	 = '';
$mod_name	 = "Работа с лидами";
if (!$_POST):
    $packId = $this->param[0];
    if (firstChar($packId) == 'p')
    {
	$id	 = preg_replace('/p/', '', $packId);
	$ppp	 = $b->getPacket($id);
	print_r($ppp);
    }
    $con			 = $a->getById($packId);
    $fields			 = (array) $con;
    $fields['sdate']	 = (new DateTime("$con->sdate"))->format('Y-m-d'); //
    $fields['lastedit']	 = (new DateTime())->format('Y-m-d'); //
    //$fields['status']		 = $a->statusListArray();
    $selected		 = $con->status;
    $mashas			 = $a->statusListArray();

    $mashas['selected']	 = $selected;
    //print_r($a->statusListArray());
    $fields['status']	 = $mashas;
    $context		 .= getCurseInfo($con->curse) . '<div class="right">' . $con->leadtype . '</div>'
	    . '<form method="post">' . $f->renderFormByData('leads', $fields)
	    . "<button type='submit' class='btn btn-info'>save</button>"
	    . "</form>";
else:
    unset($_POST['files']);
    //$_POST['id'] = $this->param[0];
    $a->save($_POST, $this->param[0]);

    $context .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "'); }, 900)</script>";
endif;

function getCurseInfo($id) {
    $a	 = new model\curses();
    $o	 = $a->getCurseById($id);
    return $o->miso . ' ' . $o->start . '<br>' . $o->name_ru;
}

include TEMPLATE_DIR . DS . $template . ".html";
?>





































































