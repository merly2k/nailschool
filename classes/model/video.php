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
class video extends \db{
   
    public
	    function getList() {
	$zapros="select * from `videogalery`";
	return $this->get_result($zapros);
	
    }
    
    public
	    function getFirst() {
	$zapros="select * from `videogalery`";
	$r= $this->get_result($zapros);
	return $r[0];
    }
    
    public
	    function getById($id) {
	$zapros="select * from `videogalery` WHERE `id`=$id";
	$r=$this->get_result($zapros);
	return $r[0];
	
    }
    public
	    function insert($param) {
	extract($param);
	$zapros="INSERT INTO `videogalery` (`link`, `decr_ru`, `dekr_ua`)
	VALUES 
	('$link', '$deckr_ru', '$deckr_ua');";
	//echo $zapros;
	$this->query($zapros);
	return $this->lastState;
    }
    public
	    function update($param,$id) {
	$q = "UPDATE `videogalery` SET ";
	foreach ($param as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }
    public function delete($id){
	$zapros="delete from `videogalery` where `id`='$id' ";
	$this->query($zapros);
	return $this->lastState;
    }
}
