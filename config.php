<?php

ini_set('display_errors', 1);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
//echo $protocol;
define("PRODUCT", "dev"); //@val = dev or prod
define("SITE_NAME", "dev"); //@val = dev or prod
define("DS", DIRECTORY_SEPARATOR);
define("APP_PATH", dirname(__FILE__)); // локальный путь к скриптам проекта
define("TEMPLATE_DIR", APP_PATH . DS . "templates" . DS); //пути к файлам templates
define("CSS_PATH", APP_PATH . DS . "css" . DS);
define("JS_PATH", APP_PATH . DS . "js" . DS);
define("MEDIA_PATH", APP_PATH . DS . "media" . DS);
define("WWW_BASE_PATH", $protocol . $_SERVER["SERVER_NAME"] . str_replace("index.php", "", $_SERVER["SCRIPT_NAME"])); //определяем адрес
define("WWW_ADMIN_PATH", WWW_BASE_PATH . "admin/"); //пути к файлам стилей
define("WWW_CSS_PATH", WWW_BASE_PATH . "css/"); //пути к файлам стилей
define("WWW_JS_PATH", WWW_BASE_PATH . "js/"); //пути к файлам яваскриптов
define("WWW_IMAGE_PATH", WWW_BASE_PATH . "images/"); //пути к файлам изображений
define("WWW_IMG_PATH", WWW_BASE_PATH . "images/"); //пути к файлам изображений
define("WWW_MEDIA_PATH", WWW_BASE_PATH . "media/"); //пути к файлам
define("APP_LOG", APP_PATH . DS . "logs" . DS); //пути к файлам логов
define("GOOGLE_MAPS_KEY", 'AIzaSyDNvCX4sJ_J2FRJhyNxKFVfyS0L4WJRNdQ'); //key for generate gmap on pages
define("ONLINE_ONLY", 'Y'); //Y or N used fot action bar
if (PRODUCT == "dev")
{
    error_reporting(99999);
    define("DB_HOST", "localhost");   //Database host.
    define('DB_USER', 'merlin');
    define('DB_PASSWORD', 'abetupatu');
    define('DB_NAME', 'zadmin_valet');
}
else
{

}








