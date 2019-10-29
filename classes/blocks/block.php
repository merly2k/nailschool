<?php

namespace blocks;

class block {

    public
	    $tpl = '';

    public 
	    function loadTpl($name) {
	$template	 = APP_PATH . DS . 'templates' . DS . 'block' .DS. $name.".html";
	$this->tpl	 = file_get_contents($template, true);
    }

    public
	    function printTpl($vars) {
	$r=new \templator();
	$r->loadFromString($this->tpl);
	return $r->Render($vars);
	
    }
    public function dbg(){
	$r=new \templator();
	$r->loadFromString($this->tpl);
	return $r->tplAnalise();
    }


}
