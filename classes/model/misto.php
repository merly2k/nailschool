<?php
namespace model;

/**
 * Description of misto
 *
 * @author merly
 */
class misto extends \db{
    function getByName($link){
	$q="select * from misto where link='$link'";
	$temp=$this->get_result($q);
	return $temp[0];
    }
    function insert($param) {
	extract($param);
    }
    
    function getAll($link=''){
	$q="select * from misto where link!='$link'";
	$temp=$this->get_result($q);
	return $temp;
    }
    function getList(){
	$q="select * from misto";
	$temp=$this->get_result($q);
	return $temp;
    }
    function getById($id) {
	$q="select * from misto where `id`='$id'";
	$temp=$this->get_result($q);
	return $temp[0];
    }
    function update($param,$id){
	unset($param['files']);
	//print_r($param) ;
	$q = "UPDATE `misto` SET ";
	foreach ($param as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	
	$this->query($q);
	return $this->lastState;
    }
}
	

















