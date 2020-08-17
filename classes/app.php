<?php

/**
 * Description of app
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class app extends application {

    public
	    $classname	 = __CLASS__;
    public
	    $ajax;
    public
	    $content;
    public
	    $tpl		 = array();
    public
	    $postprint;
    public
	    $db;
    public
	    $auch;
    public
	    $param		 = array();
    public
	    $script;
    public
	    $action;
    public
	    $_DATA;
    public
	    $alert;

    public
	    function __construct() {
	parent::__construct();
	$this->parse_vars();
	foreach ($this->_DATA as $key => $value)
	{
	    $_SESSION[$key] = $value;
	}
    }

    public
	    function set($name, $value = NULL) {
	$this->$name = $value;
	return TRUE;
    }

    public
	    function parse_vars() {
	if (isset($_COOKIE))
	{
	    foreach ($_COOKIE as $key => $value)
	    {
		$this->_DATA[$key] = $value;
	    }
	};
	if (isset($_POST))
	{
	    foreach ($_POST as $key => $value)
	    {
		$this->_DATA[$key] = $value;
	    }
	};
	if (isset($_SESSION))
	{
	    foreach ($_SESSION as $key => $value)
	    {
		$this->_DATA[$key] = $value;
	    }
	};
    }

    public
	    function get($name) {
	return $this->$name;
    }

    protected
	    function errormessage($filemane) {
	ob_clean();
	header("HTTP/1.0 404 Not Found");
	echo '404error<br>file' . $filemane . " not found";
    }

    function router() {
//определяем параметры запроса и задаём параметры по умолчанию;
	$route_str	 = trim(preg_replace("#route=#", "", $_SERVER["QUERY_STRING"]), '/');
// '<hr>' . $route_str . '<hr>';
	$route_array	 = preg_split("#/#", $route_str);
// Удаляем утм метки
	$route_array	 = array_filter($route_array, function($pin) {
	    if (firstChar($pin) != '&')
	    {
		return $pin;
	    }
	});

	$filestring = implode(DS, $route_array);

	if (stripos(@$route_array[0], "=") !== false or empty($route_array[0]))
	{
// если корень сайта или корень с утм метками включаем индекс
	    require_once APP_PATH . DS . "modules" . DS . 'index.php';
	}
	else
	{
//	    парсим запрос находя файл в файловой структуре
	    foreach ($route_array as $key => $value)
	    {
		$fp[1]	 = APP_PATH . DS . $filestring . ".php";
		$fp[0]	 = APP_PATH . DS . $filestring . DS . "index.php";
		$fp[3]	 = APP_PATH . DS . "modules" . DS . $filestring . '.php';
		$fp[2]	 = APP_PATH . DS . "modules" . DS . $filestring . DS . 'index.php';
		for ($i = 0; $i < count($fp); $i++)
		{
		    switch (file_exists($fp[$i]))
		    {

			case TRUE:
//echo $fp[$i]."-file!<br>";
			    require_once $fp[$i];
			    break 3;

			default:
//echo $fp[$i]." not a file<br>";
			    break;
		    }
		}
//echo "<hr>";
//print_r(parse_str($_SERVER['QUERY_STRING']),true);
//foreach ([a-z] as $key => $value){print $key;};
		$as		 = array_pop($route_array);
		array_unshift($this->param, $as);
		$filestring	 = implode(DS, $route_array);
	    }
//print_r($this->param);

	    return;
	}
    }

    public
	    function alert($mesage) {
	$this->alert = $mesage;
    }

    public
	    function __destruct() {

//$this->db->close();
    }

}

