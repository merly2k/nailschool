<?php

namespace model;

class vipusknik extends \db {

    public
	    function insert($town, $curs, $imgname) {
	$q = "INSERT INTO `vipusknik` ("
		. " `town`, `curs`, `imgname`"
		. ") VALUES ("
		. " '$town', '$curs', '$imgname');";
	$this->query($q);
	return $this->lastState;
    }

    public
	    function deleteById($id) {
	$q = "DELETE FROM `vipusknik` WHERE `id` ='$id'";
	$this->query($q);
    }

    public
	    function deleteByName($name) {
	$q = "DELETE FROM `vipusknik` WHERE `imgname` ='$name'";
	$this->query($q);
    }

    public
	    function delete($town, $curs, $imgname) {
	$q = "DELETE FROM `vipusknik` WHERE `town`='$town' AND `curs`='$curs' AND `imgname`='$imgname'";
	$this->query($q);
    }

    public
	    function GetPhotos($town, $curs) {
	$out	 = array();
	$q	 = "SELECT `imgname` FROM `vipusknik` WHERE `town`='$town' AND `curs`='$curs';";
	foreach ($this->get_result($q) as $ut)
	{
	    $out[] = $ut->imgname;
	}
	return $out;
    }

}

