<?php

/*
 * этот файл распространяется на условиях коммерческой лицензии
 * по вопросам приобретения кода обращайтесь merly2k at gmail.com
 */

/**
 * Description of application
 *
 * @author Лосев-Пахотин Руслан Витальевич <merly2k at gmail.com>
 */
abstract class application {

    public $db;
    public $session;
    public $auch;

    function __construct() {
       //$session= new sessions();
       
    }

    public function set($name, $value=NULL) {
        $this->$name = $value;
        return TRUE;
    }

    public function get($name) {
        return $this->$name;
    }
    public function dump($arr){
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

}

