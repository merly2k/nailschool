<?php

$template = "admin";
/**
 * 	`id` INT(10) NOT NULL AUTO_INCREMENT,
 * 	`name` VARCHAR(50) NULL DEFAULT NULL,
 * 	`deckription` TEXT NULL,
 */
//print_r($_POST);
//echo $this->param[0];
$cont_id = $this->param[0];

$mod_name = 'Управление статьями';
if($_SESSION['role']<9):
    $bcump='<li><a href="'.WWW_BASE_PATH.'manage"><i class="fa fa-dashboard"></i>Дачборд</a></li><li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-home"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>статьи</a></li>';

    else:
	$bcump='<li><a href="'.WWW_BASE_PATH.'"><i class="fa fa-dashboard"></i> Головна</a></li>
        <li class="active"><a href="'.WWW_BASE_PATH.'uslugi/"><i class="fa fa-gavel"></i>статьи</a></li>';

endif;
$context.="<article class='module width_full'><header><h3>Управление статьями</h3></header>
		<div class='module_content'> ";

$select = new content_opt_list();
$select->editlist();
$context.=$select->select;
$context.="";

if (!empty($cont_id)) {
    $ed = new db();
    $zap = "select id,header,title,keywords,deckription,context as content from context where `id`='$cont_id' LIMIT 1;";
    $ed->get_rows($zap);
//print_r($zap);
    extract($ed->result[0]);


    $context.="<fieldset>
<legend>редактор статей</legend>
<form name='add_content' method='POST' action='" . WWW_BASE_PATH . "/manage/update_content'>
    <input type='hidden' name='id' value='$cont_id' />
        <input type='hidden' name='ref' value='ed_content' />
    <input type='text' name='header' value='$header' /><br /><br />
<div class='width_full'>
    <textarea id='editor1' class='editor1' name='content'>$content</textarea>
</div>
</form>
</fieldset>
";
} else {
    extract($_POST);
    $z_apparment = "update `context` SET`header`='$header', `context`='$content' where `id`='$id';";
    $z_ap = new db();
    $z_ap->query($z_apparment);
    if ($z_ap->lastState) {
	$message = $z_ap->lastState;
    } else {

    }
}

$postPrint.="
        function updateElement(tag,urls){
        //alert(tag);
                $.ajax(
                         {
                            type: \"get\",
                            url: urls,
                            success: function(html){
                            $(tag).html(html);
                            //$('.column').equalHeight();
                            }
                          }
                        );
              }
        function clearElement(tag){
        var clean='';
         $(tag).html(clean);
        }

        ";

include TEMPLATE_DIR . DS . $template . ".html";
?>

