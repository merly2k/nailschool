<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of leads
 *
 * @author merly
 */
class leads extends \db{
    
    function GetAll() {
	$q="Select * from `leads`";
	return $this->get_result($q);
    }
    function add($param) {
	$q="INSERT INTO `leads` "
		. "( `curse`, `name`, `lname`, `email`, `phone`,"
		. " `sdate`, `status`, `lastedit`, `coment`)"
		. " VALUES ('$curse', '$name', '$lname', '$email', 'phone', current_timestamp(), 'новый', current_timestamp(), '');";
	$this->query($q);
	return $this->lastState;
    }
    function getById($id) {
	$q="Select * from `leads` where `id`='$id'";
	$t= $this->get_result($q);
	return $t[0];
    }
    function getNew(){
	$q="Select * from `leads` where `status`='новый'";
	return $this->get_result($q);
    }
    function getNotClosed($param) {
	$q="Select * from `leads` where `status` not '0'";
	return $this->get_result($q);
    }
    function getByStatus($params) {
	if(is_array($params)){
	$param=implode("','",$galleries);
	$q="select * from `leads` where `status` in ('$param')";
	}else{
	    $q="select * from `leads` where `status`='$params'";
	}
	return $this->get_result($q);
    }
    function statusList(){
	$q="SELECT * FROM `lstatus`";
	return $this->get_result($q);
    }
    function AddStatus($status){
	$q="INSERT INTO `lstatus` (`status`) VALUES ('$status');";
	$this->query($q);
	return $this->lastState;
    }
    function EditStatus($param){
	extract($param);
	$q="UPDATE `lstatus` SET `status` = '$status' WHERE `id` = '$id';";
	$this->query($q);
	return $this->lastState;
	
    }
    function getStatusById($id){
	$q="SELECT * FROM `lstatus` WHERE `id`=$id";
	return $this->get_result($q);
    }
    function DelStatus($id){
	$q="DELETE FROM `lstatus` WHERE `lstatus`.`id` = $id";
	$this->query($q);
	return $this->lastState;
    }
    
}
