<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of log2file
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
class log2file {

    private
	    $classname	 = __CLASS__;
    private
	    $index		 = 0;
    private
	    $tracearray	 = array();

    function __construct() {
	$file = 'log.txt';
	if (isfile(APP_LOG . $file))
	{

	}
    }

    function log($msg = 'default message', $file = 'log.txt') {
	try
	{
	    $from		 = get_class($this);
	    $raw		 = debug_backtrace();
	    $this->index	 = 0;
	    foreach ($raw as $entry)
	    {
		$output					 = $entry['class'] . $entry['type'] . $entry['function'];
		$this->tracearray[$this->index++]	 = $output;
	    }
	}
	catch (Exception $e)
	{

	}
	if (!isset($this->tracearray[2])):$err = "";
	else:$err = $this->tracearray[2];
	endif;
	file_put_contents(APP_LOG . $file, 'ERROR ' . $err . "  message: " . $msg . "  (" . date('c') . " )\r\n", FILE_APPEND);
    }

    function dump() {
	return var_dump($this);
    }

}
?>




