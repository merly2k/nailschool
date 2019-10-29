<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

class curses extends \db {

    public
	    function getCurse($town, $link) {
	$q = "SELECT * FROM `cursses` WHERE `miso`='$town' and `link`='$link' LIMIT 1;";
	return $this->get_result($q);
    }

    public
	    function getCurseById($id) {
	$q = "SELECT * FROM `cursses` WHERE `id`='$id'";
	$r= $this->get_result($q);
	return $r[0];
    }

    public
	    function getALL($town) {
	$q = "SELECT * FROM `cursses` WHERE `miso`='$town'";
	return $this->get_result($q);
    }
    public
	    function getALLasArray($town) {
	$q = "SELECT * FROM `cursses` WHERE `miso`='$town'";
	return $this->get_result($q);
    }

    public
	    function GetRandAction() {
	$q	 = "SELECT * FROM `cursses`  order by rand()";
	$out	 = $this->get_result($q);
	if (count($out >= 1)):
	    return $out[0];
	else:
	    return "";
	endif;
    }
    public
	    function delCurse($id) {
	$q = "DELETE FROM `cursses` WHERE `id` = '$id'";
	return $this->query($q);
    }
    public
	    function add($param) {
	extract($param);
	$this->query("INSERT INTO `cursses` ("
		. "`link`, `name_ua`, `name_ru`, "
		. " `image`, `anonce_ru`, `anonce_ua`, `decription_ru`,"
		. " `fulltext_ru`, `decription_ua`, `fulltext_ua`, `display`,"
		. " `miso`, `start`, `finish`, `coast`, `action`, `ac_coast`"
		. ")"
		. " VALUES ("
		. "'$link', '$name_ua', '$name_ru', "
		. " '$image', '$anonce_ru', '$anonce_ua', '$decription_ru',"
		. " '$fulltext_ru', '$decription_ua', '$fulltext_ua', '$display',"
		. " '$miso', '$start', '$finish', '$coast', '$action', '$ac_coast'"
		. ");");
	return $this->lastState;
    }
     function editCurse($params) {
	extract($params);
	$q = "UPDATE `cursses` SET ";
	foreach ($params as $k => $v) {
	    $p[] = "`$k`='$v'";
	}
	$q.=implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
	
    }


}























