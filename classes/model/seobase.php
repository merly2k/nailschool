<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of seobase
 *
 * @author merly
 */
class seobase extends \db {

    public
	    function insert($url, $title, $deckription, $keywords, $hide = 0) {
	$q = "INSERT INTO `seo` (`url`, `title`, `deckription`, `keywords`,`hide`)"
		. " VALUES ('$url', '$title', '$deckription', '$keywords','$hide')"
		. " ON DUPLICATE KEY UPDATE `title`='$title', `deckription`='$deckription', `keywords`='$keywords', `hide`='$hide'; ";

	$this->query($q);

	return $this->lastState;
    }

    public
	    function getByUrl($url) {
	//ECHO $url;
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `seo` WHERE `url` like '%$url';";
	//echo $q;
	$r	 = $this->get_result($q);
//print_r($r);
	if (isset($r[0])):
	    return $r[0];
	else:
	    $this->insert($url, '', '', '');
	    return $this->getByUrl($url);
	endif;
    }

    public
	    function GetAll() {
	return $this->get_result("SELECT SQL_CALC_FOUND_ROWS * FROM `seo` WHERE `hide`=0");
    }
    public
	    function GetHide() {
	return $this->get_result("SELECT SQL_CALC_FOUND_ROWS * FROM `seo` WHERE `hide`=1");
    }
    public function Update($params) {
	extract($params);
	$q = "UPDATE `seo` SET ";
	foreach ($params as $k => $v)
	{
	    $p[] = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

}
