<?php
header('Content-Type: application/json');
//print_r($_POST);
$tr	 = new \model\translation();
$lang	 = $_POST['lang'];
unset($_POST['DataTables_Table_1_length']);
$mil=$_POST['lang'];
unset($_POST['lang']);
foreach ($_POST as $key => $value)
{
    $sa = array(
	'lang'		 => "$lang",
	'ident'		 => "$key",
	'langtext'	 => "$value"
    );
   // print_r($sa);
    $r=$tr->updateTranslation($sa);
}
    if(!$r){
    $result = array("lang"=>"$mil");
    
    }
    else{
        $result=array("lang"=>"$mil","error"=>$r);
        
    }

             echo json_encode($result);

//echo "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/translation/'); }, 900)</script>";

//print_r($_POST);
