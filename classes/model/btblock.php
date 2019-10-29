<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of btblock
 *
 * @author merly
 */
class btblock extends \db{
        function getByName($link){
	$q="select * from `staticblock` where `pagename`='$link'";
	$temp=$this->get_result($q);
	return $temp[0];
    }
    function getAll($pagename=''){
	$q="select * from `staticblock` where pagename!='$link'";
	$temp=$this->get_result($q);
	return $temp;
    }
    function getList(){
	$q="select * from `staticblock`";
	$temp=$this->get_result($q);
	return $temp;
    }
    function getById($id) {
	$q="select * from `staticblock` where `id`='$id'";
	$temp=$this->get_result($q);
	return $temp[0];
    }
    function update($param,$id){
	unset($param['files']);
	//print_r($param) ;
	$q = "UPDATE `staticblock` SET ";
	foreach ($param as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	
	$this->query($q);
	return $this->lastState;
    }
    public
	    function insert($param) {
	unset($param['files']);
	extract($param);
	$q="INSERT INTO `staticblock` "
		. "( `pagename`, `header_ua`, `header_ru`, `content_ua`, `content_ru`) "
		. "VALUES"
		. " ( '$pagename', '$header_ua', '$header_ru',"
		. "'$content_ua','$content_ru');";
	return $this->query($q);
    }
}











