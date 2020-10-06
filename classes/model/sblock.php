<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of sblock
 *
 * @author merly
 */
class sblock extends \db{
    function getBlock($id) {
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `stblock` where id=$id";
	$t=$this->get_result($q);
	return $t[0];
    }
    function getAll() {
	$q="SELECT SQL_CALC_FOUND_ROWS * FROM `stblock`";
	$t=$this->get_result($q);
	return $t[0];
    }
    function addBlock($param) {
	extract($param);
	$q="INSERT INTO `stblock` (`id`, `text_ua`, `text_ru`)
	VALUES ('$id', '$text_ua', '$text_ru');";
	$this->query($q);
    }
    function update($param){
	$q="UPDATE `stblock` SET `text_ua` = '$text_ua', `text_ru` = '$text_ru' WHERE `id` = $id";
	return $this->query($q);
    }
}
