<?php

$brouse		 = '';
$lsize		 = '';
$template	 = "admin";
$mod_name	 = 'Управление настройками сайта';

$context = '<ul class="nav nav-pills">';
$context .= '<li class="nav-item"><a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/lang">Управление языками</a></li>';
$context .= '<li class="nav-item"><a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/translation">Управление переводами</a></li>';
$context .= '</ul>';

include TEMPLATE_DIR . DS . $template . ".html";
