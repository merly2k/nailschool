<?php

$brouse		 = '';
$lsize		 = '';
ini_set("max_execution_time", 0);
$tpl		 = 'admin/admin';
$context	 = '';
$modal_name	 = '';
$modal_content	 = '';
$mod_name	 = "SEO";
$filename	 = APP_PATH . '/sitemap.xml';
$robot  =APP_PATH."/robots.txt";
$context .= "<h2>Исключения из сайтмапа и индексирования</h2>";
$context .= "<a href='" . WWW_ADMIN_PATH . "settings/seo/noindex'>Настроить</a> ";
$context .= "<h2>Метатеги сайта по страницам</h2>";
$context .= "<a href='" . WWW_ADMIN_PATH . "settings/seo/metatags'>Настроить</a> ";
$context	 .= "<h2>файл карты сайта</h2>";
if (file_exists($filename))
{
    $context .= "<p>в последний раз файл sitemap.xml был изменен: " . date("F d Y H:i:s.", filemtime($filename)) . "</p>";
    $context .= "<a href='" . WWW_ADMIN_PATH . "settings/seo/generator'>Обновить</a> ";
    $context .= "| <a href='" . WWW_BASE_PATH . "sitemap.xml' target='_blank'>просмотреть в новом окне</a>";
}
else
{
    $context .= "Файл сайтмап не создан";
    $context .= " <a href='" . WWW_ADMIN_PATH . "settings/seo/generator'>Создать</a> ";
}
$context	 .= "<h2>файл ROBOTS сайта</h2>";
if (file_exists($robot))
{
    $context .= "<p>в последний раз файл robots.txt был изменен: " . date("F d Y H:i:s.", filemtime($robot)) . "</p>";
    $context .= "<a href='" . WWW_ADMIN_PATH . "settings/seo/robogen'>Обновить</a> ";
    $context .= "| <a href='" . WWW_BASE_PATH . "robots.txt' target='_blank'>просмотреть в новом окне</a>";
}
else
{
    $context .= "Файл сайтмап не создан";
    $context .= " <a href='" . WWW_ADMIN_PATH . "settings/seo/generator'>Создать</a> ";
}
include TEMPLATE_DIR . DS . $tpl . ".html";



