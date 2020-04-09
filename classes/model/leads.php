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
class leads extends \db {

    function GetAll() {
	$q = "Select * from `leads` order by `sdate`,`lastedit` DESC";
	return $this->get_result($q);
    }

    function add($curse, $leadtype, $name, $lname, $email, $phone) {

	$q = "INSERT INTO `leads` "
		. "( `curse`,`leadtype`, `name`, `lname`, `email`, `phone`,"
		. " `sdate`, `status`, `lastedit`, `coment`)"
		. " VALUES ('$curse','$leadtype' ,'$name', '$lname', '$email', '$phone', "
		. "current_timestamp(), '1', current_timestamp(), '');";
	$this->query($q);
	return $this->lastState;
    }

    function getById($id) {
	$q	 = "Select * from `leads` where `id`='$id'";
	$t	 = $this->get_result($q);
	return $t[0];
    }

    function getNew() {
	$q = "Select * from `leads` where `status`='новый'";
	return $this->get_result($q);
    }

    function getNotClosed($param) {
	$q = "Select * from `leads` where `status` not '0'";
	return $this->get_result($q);
    }

    function getByStatus($params) {
	if (is_array($params))
	{
	    $param	 = implode("','", $galleries);
	    $q	 = "select * from `leads` where `status` in ('$param')";
	}
	else
	{
	    $q = "select * from `leads` where `status`='$params'";
	}
	return $this->get_result($q);
    }

    function statusList() {
	$q = "SELECT * FROM `lstatus`";
	return $this->get_result($q);
    }

    function statusListArray() {
	$out	 = array();
	$q	 = "SELECT * FROM `lstatus`";
	foreach ($this->get_result($q)as $k => $v)
	{
	    $out[$k]['value']	 = $v->id;
	    $out[$k]['name']	 = $v->status;
	};
	return $out;
    }

    function AddStatus($status) {
	$q = "INSERT INTO `lstatus` (`status`) VALUES ('$status');";
	$this->query($q);
	return $this->lastState;
    }

    function EditStatus($param) {
	extract($param);
	$q = "UPDATE `lstatus` SET `status` = '$status' WHERE `id` = '$id';";
	$this->query($q);
	return $this->lastState;
    }

    function getStatusById($id) {
	$q = "SELECT * FROM `lstatus` WHERE `id`=$id";
	return $this->get_result($q);
    }

    function DelStatus($id) {
	$q = "DELETE FROM `lstatus` WHERE `lstatus`.`id` = $id";
	$this->query($q);
	return $this->lastState;
    }

    function save($param, $id) {
	extract($param);

	$q = "UPDATE `leads` SET ";
	foreach ($param as $k => $v)
	{
	    $p[] = "`$k`='" . htmlspecialchars($v, ENT_QUOTES) . "'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`='$id';";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

}
