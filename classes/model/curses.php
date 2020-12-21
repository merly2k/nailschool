<?php

namespace model;

class curses extends \db {

    public
	    function getCurse($town, $link) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `miso`='$town' and `link`='$link' LIMIT 1;";

	return $this->get_result($q);
    }

    public
	    function getCurseById($id) {

	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `id`='$id'";
	$r	 = $this->get_result($q);
	if (count($r) > 0)
	{
	    return $r[0];
	}
	else
	{
	    return $r;
	}
    }

    public
	    function getALL($town, $st = 'Y') {
	if ($st == 'Y'):
	    $q = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `miso`='$town' and `display_r`='Y' order by `porjadok` ASC";
	else:
	    $q = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `miso`='$town'  order by `porjadok` ASC";
	endif;
	//echo $q;
	$r = $this->get_result($q);

	return $r;
    }

    public
	    function getALLasArray($town) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `miso`='$town'";
	return $this->get_result($q);
    }

    public
	    function GetRandAction() {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `action`='Y' and `display`='Y' order by rand()";
	$out	 = $this->get_result($q);
	if (count($out >= 1)):
	    return $out[0];
	else:
	    return "";
	endif;
    }

    public
	    function GetRandOnline() {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `cursses` WHERE `miso`='virtual' and `display`='Y' order by rand() LIMIT 1";
	$out	 = $this->get_result($q);
	if ($this->found >= 1):
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
	//Газ горит оранжевым
	$q = "INSERT INTO `cursses` ("
		. "`link`, `name_ua`, `name_ru`,"
		. " `image`, `anonce_ru`, `anonce_ua`,`hidedeckr`,`hideprog`,"
		. " `decription_ru`, `fulltext_ru`, `decription_ua`, `fulltext_ua`,"
		. " `display`,"
		. " `display_r`,"
		. " `darunok`,"
		. " `darunok_ru`,"
		. " `darunok_ua`,"
		. " `miso`,"
		. " `start`,`hidestart`, `finish`, `coast`, `action`,`deadline`, `ac_coast`, `mashas`, `basecolor`, `porjadok`,"
		. " `video_ua`, `video_ru`,"
		. " `googldock_ua`, `googldock_ru`,"
		. " `tur`,"
		. " `zrazki`,"
		. " `vipusk`,"
                . " `showcomment`)"
		. " VALUES ("
		. "'$link', '$name_ua', '$name_ru', "
		. " '$image', '$anonce_ru', '$anonce_ua','$hidedeckr','$hideprog',"
		. " '$decription_ru', '$fulltext_ru', '$decription_ua', '$fulltext_ua',"
		. " '$display',"
		. " '$display_r',"
		. " '$darunok',"
		. " '$darunok_ru',"
		. " '$darunok_ua',"
		. " '$miso', "
		. " '$start','$hidestart', '$finish', '$coast', '$action','$deadline' ,'$ac_coast','$mashas','$basecolor','$porjadok',"
		. " '$video_ua', '$video_ru',"
		. " '$googldock_ua', '$googldock_ru',"
		. " '$tur',"
		. " '$zrazki',"
		. " '$vipusk',"
                . " '$showcomment'"
		. ");";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

    function editCurse($params) {
	extract($params);
	$q = "UPDATE `cursses` SET ";
	foreach ($params as $k => $v)
	{
	    $v	 = addslashes($v);
	    $p[]	 = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

}
