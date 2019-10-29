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
$ajax = " $(document).ready(function(){
        var opts = {
                    cssClass : 'el-rte',
                    lang     : 'ru',
                    allowSource : 1,  // allow user to view source
                    height   : 450,   // height of text area
                    toolbar  : 'normal',   // Your options here are 'tiny', 'compact', 'normal', 'complete', 'maxi', or 'custom'
                    cssfiles : ['css/elrte-inner.css'],
                    // elFinder
                    fmAllow  : 1,
                    fmOpen : function(callback) {
                        $('<div id=\"myelfinder\" />').elfinder({
                            url : 'connector', // elFinder configuration file.
                            lang : 'ru',
                            dialog : { width : 900, modal : true, title : 'Files' }, // Open in dialog window
                            closeOnEditorCallback : true, // Close after file select
                            editorCallback : callback     // Pass callback to file manager
                        })
                    }
                    //end of elFinder
                }
                $('#editor').elrte(opts); // id of textarea you want rich edit on
		});

";
$mod_name = 'Управление объявлениями';
$context.="<article class='module width_full'><header><h3>Управление объявлениями</h3></header>
		<div class='module_content'> ";

$select = new objava_opt_list();
$select->editlist();
$context.=$select->select;
$context.="";

if (!empty($cont_id)) {
    $ed = new db();
    $zap = "select `id`,`message` as` content` from announces where `id`='$cont_id' LIMIT 1;";
    $ed->get_rows($zap);
//print_r($zap);
    extract($ed->result[0]);


    $context.="<fieldset>
<legend>редактор статей</legend>
<form name='add_objava' method='POST' action='" . WWW_BASE_PATH . "manage/update_objava'>
    <input type='hidden' name='id' value='$cont_id' />
        <input type='hidden' name='ref' value='ed_content' />
<div class='width_full'>
    <textarea id='editor' name='content'>$content</textarea>
</div>
</form>
</fieldset>
";
} else {
    extract($_POST);
    $z_apparment = "update `announces` SET `message`='$content' where `id`='$id';";
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

