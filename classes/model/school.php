<?php

namespace model;

/**
 * Description of school
 *
 * @author merly
 */
class school extends \db {

    function getByLink($link) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `school` WHERE `misto`='$link'";
	//echo $q;
	$out	 = $this->get_result($q);
	if (count($out) > 0):
	    return $out[0];
	else:
	    $p = array('id'		 => '',
		'misto'		 => $link,
		'osnashennia_ua' => '',
		'osnashennia_ru' => '',
		'osn_img'	 => '',
		'ergonomik_ua'	 => '',
		'ergonomik_ru'	 => '',
		'ergonomik_img'	 => '',
		'location_ua'	 => '',
		'location_ru'	 => '',
		'location_img'	 => '',
		'shop_ua'	 => '',
		'shop_ru'	 => '',
		'shop_img'	 => '',
		'konsult_ua'	 => '',
		'konsult_ru'	 => '',
		'konsult_img'	 => '',
		'tur_ua'	 => '',
		'tur_ru'	 => '',
		'tur_link'	 => '');
	    $this->insert($p);
	    return $this->getByLink($link);
	endif;
    }

    function insert($param) {
	extract($param);
	$q = "INSERT INTO `school` ("
		. " `misto`,"
		. " `osnashennia_ua`, `osnashennia_ru`, `osn_img`,"
		. " `ergonomik_ua`, `ergonomik_ru`,`ergonomik_img`,"
		. " `location_ua`, `location_ru`,`location_img`,"
		. " `shop_ua`, `shop_ru`, `shop_img`,"
		. " `konsult_ua`, `konsult_ru`,`konsult_img`,"
		. " `tur_ua`, `tur_ru`, `tur_link`)"
		. " VALUES ("
		. " '$misto', "
		. "'$osnashennia_ua','$osnashennia_ru', '$osn_img',"
		. " '$ergonomik_ua','$ergonomik_ru', '$ergonomik_img',"
		. " '$location_ua','$location_ru', '$location_img',"
		. " '$shop_ua','$shop_ru', '$shop_img',"
		. " '$konsult_ua','$konsult_ru', '$konsult_img', "
		. "'$tur_ua','$tur_ru', '$tur_link');";
	$this->query($q);
	return $this->lastState;
    }

    function update($param) {
	extract($param);
	$q = "UPDATE `school` SET ";
	foreach ($param as $k => $v)
	{
	    $p[] = "`$k`='" . htmlspecialchars($v, ENT_QUOTES) . "'";
	}
	$q .= implode(", ", $p) . " WHERE  `misto`='$misto';";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

}

