<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of gradients
 *
 * @author merly
 */
class gradients extends \db{
    
    public
	    function getGradient($name) {
	$q="SELECT * FROM gradients WHERE `name`='$name';";
	//echo $q;
	$res= $this->get_result($q);
	//print_r($res);
	return $res[0];
    }
    public
	    function getGradients() {
	$q='SELECT `name`,`image` FROM gradients';
	return $this->get_rows($q);
    }
}














