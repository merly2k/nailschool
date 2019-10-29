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
class feedbask extends \db{
    public
	    function getAll() {
	$q='SELECT * FROM `feedback`';
	return $this->get_result($q);
    }
    public
	    function newFeedback($param) {
	$q="INSERT INTO `feedback` ("
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
    public	    function UpdateFeedback($param) {
	extract($param);
	$q="UPDATE `feedback` SET "
		. "`name_ua` = '$name_ua',"
		. " `name_ru` = '$name_ru',"
		. " `age` = '$age',"
		. " `image` = '$image',"
		. " `misto_ua` = '$misto_ua',"
		. " `misto_ru` = '$misto_ru',"
		. " `feed_ua` = '«$feed_ua»',"
		. " `feed_ru` = '«$feed_ru»'"
		. " WHERE `id` = $id;";
	return $this->query($q);
    }
    public
	    function delFeedback($id) {
	$q="delete from `feedback` where id='$id'";
    }
}
