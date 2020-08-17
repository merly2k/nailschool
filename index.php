<?php

session_start();
$_SESSION['start']	 = time();
$_SESSION['lifetime']	 = ini_get("session.gc_maxlifetime");
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
    $ip = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
    $ip = $_SERVER['REMOTE_ADDR'];
}

$p		 = dirname(__FILE__);
$template	 = 'tool'; //default template name
require_once $p . '/config.php';
require_once $p . '/shared.php';
if (!isset($_SESSION['lang']))
{
    $_SESSION['lang'] = 'UA';
}
set_error_handler(function ($errno, $errstr, $errfile, $errline ) {
    // Не выбрасываем исключение если ошибка подавлена с
    // помощью оператора @
    if (!error_reporting())
    {
	return;
    }
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800))
{
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
ini_set("max_execution_time", 0);
spl_autoload_register("autoload");
require_once APP_PATH . DS . 'vendor' . DS . 'autoload.php';

function autoload($class_name) {
    $possibilities = array(
	APP_PATH . DS . $class_name . '.php',
	APP_PATH . DS . "classes" . DS . $class_name . '.php',
	APP_PATH . DS . "classes" . DS . str_replace('\\', DS, $class_name) . '.php'
    );

    foreach ($possibilities as $file)
    {
	//echo $file."<br>";
	if (file_exists($file))
	{
	    require_once($file);
	    return true;
	}
    }
    return false;
}

if (!isset($_SESSION['userinfo']))
{
    $ato			 = '4c1c651e83ba7a';
    $infos			 = "https://ipinfo.io/$ip?token=$ato";
    $_SESSION['userinfo']	 = file_get_contents($infos);
}
else
{
    $stat	 = new db();
    $q	 = "INSERT INTO `vizitor` (`info`,`vizit` ,`vdate`) VALUES ('" . $_SESSION['userinfo'] . "',1 , current_timestamp())
		    ON DUPLICATE KEY UPDATE `vizit`=`vizit`+1, `vdate`=current_timestamp();";
    $stat->query($q);
    //echo $q.' '.$stat->lastState;
}
$app = new app();

$app->set('protocol', $protocol);
foreach ($_SESSION as $name => $value)
{
    $app->set($name, $value);
};
foreach ($_COOKIE as $name => $value)
{
    $app->set($name, $value);
};

foreach ($_POST as $name => $value)
{
    $app->set($name, $value);
};

$app->router();

unset($app);

if (PRODUCT == 'dev')
{


    $log = new \log2file;

    if (!error_get_last()):
	return 1;
    else:
	$errors = implode('|', error_get_last());
    endif;
    $log->log($errors, "error.log");

//$mempik= memory_get_peak_usage(true)/10485764;
//echo "максимально используемая память".round($mempik, 3)."Mb";
}




