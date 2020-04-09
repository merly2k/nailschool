<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of faqo
 *
 * @author merly
 */
class faqo extends \db {

    public
	    function __construct() {
	parent::__construct();
    }

    public
	    function getAll($misto) {
	$q = "select * from `faqo` where `misto`='$misto' order by `porjadok`;";
	//echo $q;
	return $this->get_result($q);
    }

    public
	    function getById($id) {
	$q = "select * from `faqo` where `id`='$id';";
	//echo $q;
	return $this->get_result($q);
    }

    public
	    function add($param) {
	extract($param);
	$question_ua	 = htmlspecialchars($question_ua, ENT_QUOTES);
	$ansver_ua	 = htmlspecialchars($ansver_ua, ENT_QUOTES);
	$question_ru	 = htmlspecialchars($question_ru, ENT_QUOTES);
	$ansver_ru	 = htmlspecialchars($ansver_ru, ENT_QUOTES);
	$q		 = "INSERT INTO `faqo`"
		. " ( `misto`, `question_ua`, `ansver_ua`, `question_ru`, `ansver_ru`)"
		. " VALUES"
		. " ( '$misto', '$question_ua', '$ansver_ua', '$question_ru', '$ansver_ru')";

	$this->query($q);
	return $this->lastState;
    }

    function edit($params) {
	extract($params);

	$q = "UPDATE `faqo` SET ";
	foreach ($params as $k => $v)
	{
	    $v	 = htmlspecialchars($v, ENT_QUOTES);
	    $p[]	 = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

    function del($id) {
	$q = "delete from `faqo` where `id`='$id'";
	return $this->query($q);
    }

}
