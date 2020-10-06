<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of translation
 *
 * @author merly
 */
class translation extends \db {

    public
	    function getStrByLang($lang) {
	$out	 = array();
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from langs where `lang`='$lang'";

	foreach ($this->get_result($q) as $fr)
	{

	    $out["$fr->ident"] = "$fr->langtext";
	};

	return $out;
    }

    public
	    function getLang($lang) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * from langs where `lang`='$lang'";
	return $this->get_result($q);
    }

    public
	    function getOneByLang($lang, $frase) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * from langs where `lang`='$lang' and `ident`='$frase'";
	$turn	 = $this->get_result($q);
	$a	 = $turn[0];
	return $a->langtext;
    }

    public
	    function InsertTranslation($param) {
	extract($param);
	$q = "INSERT INTO `langs` ( `ident`, `lang`, `langtext`) VALUES ('$ident', '$lang', '$langtext')"
		. "ON DUPLICATE KEY UPDATE `langtext` = '$langtext';";
	echo $q;
	$this->q($q);
	return $this->lastState;
    }

    public
	    function updateTranslation($param) {
	extract($param);
	$q = "UPDATE `langs` SET `langtext` = '$langtext' WHERE `ident` = '$ident' and `lang`='$lang';";
	//echo $q;
	$this->query($q);
	return $this->lastState;
    }

    public
	    function delTranslation($id) {

	$q = "DELETE FROM `langs` WHERE `id` = '$id'";
	$this->query($q);
	return $this->lastState;
    }

}
