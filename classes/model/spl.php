<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of sp
 *
 * @author merly
 */
class spl extends \db{
    //put your code here
    public
	    function getArticle($name,$lang) {
	$q="SELECT * FROM `lang_ststicpages` WHERE `link`='$name' and `lang`='$lang'";
	//echo $q;
	$t=$this->get_result($q);
	return $t[0];
    }
    public
	    function getAll($lang) {
	$q="SELECT * FROM `lang_ststicpages`WHERE `lang`='$lang'";
	return $t=$this->get_result($q);
	 	
    }
    public
	    function save($param,$link,$lang) {
	foreach ($param as $key => $value)
	{
	    $s[]="`$key`='$value' ";
	}
	$q="UPDATE `lang_ststicpages` SET "
                .implode(', ', $s).
                " WHERE  `link`='".$link."' and lang='$lang'";
	//echo $q;
	return $this->query($q) . $this->lastState;
    }
}
















