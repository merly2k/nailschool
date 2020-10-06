<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of feedbask
 *
 * @author merly
 */
class feedbask extends \db {

    public
	    function getAll() {
	$q = 'SELECT SQL_CALC_FOUND_ROWS * FROM `feedback`';
	return $this->get_result($q);
    }

    public
	    function newFeedback($param) {
	extract($param);
	$q = "INSERT INTO `feedback` ("
		. " `name_ua`,"
		. " `name_ru`,"
		. " `age`,"
		. " `image`,"
		. " `misto_ua`,"
		. " `misto_ru`,"
		. " `feed_ua`,"
		. " `feed_ru`)"
		. " VALUES ("
		. " '$name_ua',"
		. " '$name_ru',"
		. " '$age',"
		. " '$image',"
		. " '$misto_ua',"
		. " '$misto_ru',"
		. " '$feed_ua',"
		. " '$feed_ru');";
	return $this->query($q);
    }

    public
	    function UpdateFeedback($param) {
	extract($param);

	$q = "UPDATE `feedback` SET ";
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
	    function delFeedback($id) {
	$q = "delete from `feedback` where id='$id'";
    }

    function getFeedback($id) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `feedback` where `id`='$id'";
	return $this->get_result($q);
    }

}
