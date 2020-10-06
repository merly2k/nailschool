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
class sp extends \db{
    //put your code here
    public
	    function getArticle($name) {
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `staticpages` WHERE `link`='$name'";
	$t=$this->get_result($q);
	return $t[0];
    }
    public
	    function getAll() {
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `staticpages`";
	return $t=$this->get_result($q);
	 	
    }
    public
	    function save($param,$link) {
	foreach ($param as $key => $value)
	{
	    $s[]="`$key`='$value' ";
	}
	$q="UPDATE `staticpages` SET "
                .implode(', ', $s).
                " WHERE  `link`='".$link."';";
	//echo $q;
	return $this->query($q) . $this->lastState;
    }
}

















