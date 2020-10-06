<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of packets
 *
 * @author merly
 */
class packets extends \db {

    function getPacket($id) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `packets` WHERE `id`='$id' LIMIT 1;";
	//echo $q;
	return $this->get_result($q);
    }

    function getPackets($town) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `packets` WHERE `town`='$town' order by `porjadok` ASC;";
	//echo $q;
	return $this->get_result($q);
    }

    function addPackets($param) {
	extract($param);
	$q = "INSERT INTO `packets` ( `name_ua`,
		 `name_ru`,
		 `porjadok`,
		 `coast`,
		 `dayz`,
		 `kurs1_id`,
		 `kurs2_id`,
		 `kurs3_id`,
		 `kurs4_id`,
		 `kurs5_id`,
		 `kurs6_id`,
		 `kurs7_id`,
		 `seminar`,
		 `link`,
		 `town`
		 ) VALUES (
		 '$name_ua', '$name_ru','$porjadok', '$coast', '$dayz', '$kurs1_id', '$kurs2_id', '$kurs3_id', '$kurs4_id','$kurs5_id','$kurs6_id', '$kurs7_id','$seminar','$link','$town');";
	//echo $q;
	return $this->query($q);
    }

    function editPackets($params) {
	extract($params);
	$q = "UPDATE `packets` SET ";
	foreach ($params as $k => $v)
	{
	    $p[] = "`$k`='$v'";
	}
	$q .= implode(", ", $p) . " WHERE  `id`=$id;";
	//echo $q;
	$this->query($q);

	return $this->lastState;
    }

    function delPackets($id) {
	$q = "delete from `packets` WHERE `id`='$id'";
	return $this->query($q);
    }

}

