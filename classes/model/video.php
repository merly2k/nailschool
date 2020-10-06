<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of videogalery
 *
 * @author merly
 */
class video extends \db {

    public
	    function getList() {
	$zapros = "SELECT SQL_CALC_FOUND_ROWS * from `videogalery`";
	return $this->get_result($zapros);
    }

    public
	    function getFirst() {
	$zapros	 = "SELECT SQL_CALC_FOUND_ROWS * from `videogalery`";
	$r	 = $this->get_result($zapros);
	return $r[0];
    }

    public
	    function getById($id) {
	$zapros	 = "SELECT SQL_CALC_FOUND_ROWS * from `videogalery` WHERE `id`=$id";
	$r	 = $this->get_result($zapros);
	return $r[0];
    }

    public
	    function insert($param) {
	//print_r($param);
	extract($param);
	$zapros = "INSERT INTO `videogalery` (`link`,`name_ua`,`name_ru`, `decr_ru`, `dekr_ua`,`kurse`)
	VALUES
	('$link','$name_ua','$name_ru', '$deckr_ru', '$deckr_ua','$kurse');";
	//echo $zapros;
	$this->query($zapros);
	return $this->lastState;
    }

    public
	    function update($param, $id) {
	$q = "UPDATE `videogalery` SET ";
	foreach ($param as $k => $v)
	{
	    $p[] = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

    public
	    function delete($id) {
	$zapros = "delete from `videogalery` where `id`='$id' ";
	$this->query($zapros);
	return $this->lastState;
    }

}
