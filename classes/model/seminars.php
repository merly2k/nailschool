<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

class seminars extends \db {

    public
	    function getCurse($town, $link) {
	$q = "SELECT * FROM `seminars` WHERE `miso`='$town' and `link`='$link' LIMIT 1;";
	return $this->get_result($q);
    }

    public
	    function getCurseById($id) {
	$q = "SELECT * FROM `seminars` WHERE `id`='$id'";
	$r= $this->get_result($q);
	return $r[0];
    }

    public
	    function getALL($town) {
	$q = "SELECT * FROM `seminars` WHERE `miso`='$town'";
	return $this->get_result($q);
    }
    public
	    function getALLasArray($town) {
	$q = "SELECT * FROM `seminars` WHERE `miso`='$town'";
	return $this->get_result($q);
    }

    public
	    function GetRandAction() {
	$q	 = "SELECT * FROM `seminars`  order by rand()";
	$out	 = $this->get_result($q);
	if (count($out >= 1)):
	    return $out[0];
	else:
	    return "";
	endif;
    }
    public
	    function delSeminars($id) {
	$q = "DELETE FROM `seminars` WHERE `id` = '$id'";
	return $this->query($q);
    }
    public
	    function add($param) {
	extract($param);
	 /*id int(11)
    link varchar(50)
    name_ru Название семинара 
    decription_ru Описание семинара
    fulltext_ru longtextДетальная информация 
    name_ua 	varchar(50)	Назва семінару
    decription_ua text опис семінару
    fulltext_ua text детально про семінар
    show set('yes', 'no')показувати
    miso varchar(50)
    start date початок 
    finish int(4)длительность 
    coast decimal(10,2)	ціна
    basecolor */
	$this->query("INSERT INTO `seminars` ("
		. "`link`,"
		. "`name_ru`,"
		. " `decription_ru`,"
		. " `fulltext_ru`,"
		. "`name_ua`"
		. " `decription_ua`,"
		. " `fulltext_ua`,"
		."`show`,"
		. " `miso`,"
		. " `start`, "
		. "`finish`,"
		. " `coast`,"
		. " `action`,"
		. " `ac_coast`,"
		. "`basecolor`"
		. ")"
		. " VALUES ("
		. "'$link', '$name_ua', '$name_ru', "
		. " '$image', '$anonce_ru', '$anonce_ua', '$decription_ru',"
		. " '$fulltext_ru', '$decription_ua', '$fulltext_ua', '$display',"
		. " '$miso', '$start', '$finish', '$coast', '$action', '$ac_coast'"
		. ");");
	return $this->lastState;
    }
     function editSeminars($params) {
	extract($params);
	$q = "UPDATE `seminars` SET ";
	foreach ($params as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
	
    }


}



























