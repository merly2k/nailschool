<?php

$brouse		 = '';
$lsize		 = '';
$template	 = "admin";
$context	 = '';
$mod_name	 = 'Управление настройками сайта/переводы';
$langs		 = new db();
$tran		 = new model\translation();
$f		 = new bootstrap\input();
$tab		 = '';
$tabcontent	 = '';
foreach ($langs->get_result("select * from `lang`") as $l)
{

    $tab .= '<li class="nav-item">'
	    . '<a class="nav-link" data-toggle="pill" href="#' . $l->lang_eu . '">' . $l->langname . '</a>'
	    . ' </li>';



    $fr = "<br><form method='post' action='" . WWW_ADMIN_PATH . "settings/translation/save'>"
	    . "<table class='table table-striped table-bordered table-hover DataTable' style='width:100%'><thead><tr>"
	    . "<th style='width:40%'>Описание</th>"
	    . "<th style='width:60%'>Перевод</th>"
	    . "</tr>"
	    . "</thead><tbody>";
    foreach ($tran->getLang($l->lang_eu) as $k => $frases)
    {
	$fr	 .= "<tr>";
	$fr	 .= '<td style="width:40%"><small id="helper" class="form-text text-muted mb-4">' . $frases->templates_block . '<br>' . $frases->ident . '</small></td>';
	$fr	 .= '<td style="width:60%">' . $f->input('lang', '', 'hidden', 'lang', '', $l->lang_eu);
	$fr	 .= $f->input('sa' . $k, '', 'text', $frases->ident, 'введите перевод', htmlentities($frases->langtext)) . '</td>';
	$fr	 .= "</tr>";
    }

    $fr	 .= "</tbody>";
    $fr	 .= "<tfoot><tr>"
	    . "<td style='display: none;'></td>"
	    . "<td><button type='submit' class='btn btn-info'>save</button></td>"
	    . "</tr><tfoot></table>";
    $fr	 .= "</form>";

    $tabcontent .= '<div class = "tab-pane container fade" id = "' . $l->lang_eu . '">'
	    . $l->langname . ' - переведенные фразы <hr>'
	    . $fr
	    . '</div>';
}
$context .= '<ul class = "nav nav-pills">';
$context .= $tab . '</ul>';
$context .= '<div class = "tab-content">' . $tabcontent . '</div>';
include TEMPLATE_DIR . DS . $template . ".html";
