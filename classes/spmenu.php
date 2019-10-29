<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of spmenu
 *
 * @author merly
 */
class spmenu extends db{
    //put your code here
    public
	    function __construct() {
	parent::__construct();
    }
    function getLinks($lang){
	switch ($lang){
    case 'ua':
	$q="SELECT * FROM `staticpages`";
    break;
    default:
	$q="SELECT * FROM `lang_ststicpages`WHERE `lang`='$lang'";
    break;
	}
	return $this->get_result($q);
    }
    
    function decor($link,$name,$status=''){
	$st='<li class="nav-item $status">
    <a class="nav-link" href="'.WWW_BASE_PATH.$link.'">'.$name.' </a></li>';
	return $st;
    }
    
    function render($lang){
	$out='';
	foreach ($this->getLinks($lang) as $row)
	{
	    //print_r($row);
	    $out.= $this->decor($row->link, $row->name);
	}
	return $out;
    }
}





















