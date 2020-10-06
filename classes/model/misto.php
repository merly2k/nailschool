<?php

namespace model;

/**
 * Description of misto
 *
 * @author merly
 */
class misto extends \db {

    function getByName($link) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from misto where link='$link'";
	$temp	 = $this->get_result($q);
	return $temp[0];
    }

    function insert($param) {
	extract($param);
	$q = "insert into `misto`(`link`,`name_ua`,`name_ru`,`image`,`addr_ua`,`addr_ru`,`phones`,`viber`,`fb`,`inst`,`gmap`)"
		. "VALUES('$link','$name_ua','$name_ru','$image','$addr_ua','$addr_ru','$phones','$viber','$fb','$inst','$gmap');";
	$this->query($q);
    }

    function getAll($link = '') {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from misto where link!='$link' ";
	//echo $q;
	$temp	 = $this->get_result($q);
	return $temp;
    }

    function getList() {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from misto";
	$temp	 = $this->get_result($q);
	return $temp;
    }

    function getById($id) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from misto where `id`='$id'";
	$temp	 = $this->get_result($q);
	return $temp[0];
    }

    function update($param, $id) {

	print_r($param);
	$q = "UPDATE `misto` SET ";

	foreach ($param as $k => $v)
	{
	    if (!empty($v))
	    {
		$v	 = addslashes($v);
		$p[]	 = "`$k`='$v'";
	    }
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);
	//exit;
	return $this->lastState;
    }

}

