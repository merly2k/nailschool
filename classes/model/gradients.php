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
class gradients extends \db {

    public
	    function getGradient($name) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM gradients WHERE `name`='$name';";
	//echo $q;
	$res	 = $this->get_result($q);
	//print_r($res);
	return $res[0];
    }

    public
	    function getGradients() {
	$q = 'SELECT `name`,`image` FROM gradients';
	return $this->get_rows($q);
    }

    public
	    function getAll() {
	$q = 'SELECT SQL_CALC_FOUND_ROWS * FROM gradients';
	return $this->get_result($q);
    }

    public
	    function add($param) {
	extract($param);
	$q = "INSERT INTO `gradients` ( `name`,  `start`, `middle`, `end`)"
		. " VALUES ( '$name',  '$start', '$middle', '$end');";
	$this->query($q);
	return $this->lastState;
    }

    public
	    function edit($params) {
	extract($params);

	$q = "UPDATE `gradients` SET ";
	foreach ($params as $k => $v)
	{
	    $v	 = htmlspecialchars($v, ENT_QUOTES);
	    $p[]	 = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `name`='" . $params['name'] . "';";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

    function del($id) {
	$q = "delete from `gradients` where `id`='$id'";
	return $this->query($q);
    }

}

