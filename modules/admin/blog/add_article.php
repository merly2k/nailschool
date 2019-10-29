<?php
$template="admin";//dform; //"index";
$context='';
/**
*	`id` INT(10) NOT NULL AUTO_INCREMENT,
*	`name` VARCHAR(50) NULL DEFAULT NULL,
*	`deckription` TEXT NULL,
*/
//print_r($_POST);
//echo $this->param[0];
$cont_id=@$this->param[0];

$mod_name='Блог: новая статья';
$context.="<article class='module width_full'
		<div class='module_content'> ";

if(!$_POST){
    $context.="<fieldset>
<legend>редактор статей</legend>
<form name='add_content' method='POST'>
    <input type='hidden' name='ref' value='ed_content' />
    <input type='text' name='header' value='' required='required' placeholder='введите url(имя для статьи на английском)'/><br /><br />
<div class='width_full'>
    <textarea id='editor1' class='editor1' name='content'></textarea>
</div>
</form>
</fieldset>
</div>
";
} else {
    extract($_POST);
    $z_apparment="INSERT INTO `blog` SET `header`='$header', `context`='$content';";
    $z_ap=new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) { $message=$z_ap->lastState;} else{
    }
}



        include TEMPLATE_DIR.DS.$template.".html";
        
 ?>









