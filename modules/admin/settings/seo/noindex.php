<?php
$brouse		 = '';
$lsize		 = '';
ini_set("max_execution_time", 0);
$tpl		 = 'admin/admin';
$context	 = '';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "SEO Управление исключениями";
$context	 .= "<h2>Список файлов исключеных из индексации</h2>";
$pages	 = new model\seobase();

if(!$_POST):
    $context	 .= "<ul>";
foreach ($pages->GetHide() as $v) {
    //id url title deckription keywords hide 
    $context .= '<li>'.$v->url.'<form method="post">'
            . '<input type="hidden" name="id" value="'.$v->id.'">'
            . '<input type="hidden" name="hide" value="0">'
            . '<button><i class="fas fa-eye" title="включить"></i></button>'
            . '</form></li>';
}
    $context	 .= "<ul>";
else:
    //$context	 .= print_r($_POST,true);
    $pages->Update($_POST);
    $context	 .= "<script>setTimeout(function() { location.replace('" . WWW_ADMIN_PATH . "settings/seo/noindex'); }, 900)</script>";
endif;

include TEMPLATE_DIR . DS . $tpl . ".html";
