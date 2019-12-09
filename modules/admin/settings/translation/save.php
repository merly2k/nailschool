<?php


$lang=array_shift($_POST);
$tr=new \model\translation();
foreach ($_POST as $key => $value)
{
    $sa=array(
	'lang'=>"$lang",
	'ident'=>"$key",
	'langtext'=>"$value"
	    );
//print_r($sa);
$tr->updateTranslation($sa);
    
}
echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/translation/'); }, 900)</script>";

//print_r($_POST);
