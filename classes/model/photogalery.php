<?php

namespace model;

class photogalery extends \db {

    public
	    function insert($town, $curs, $imgname) {
	$q = "INSERT INTO `photogalery` ("
		. " `town`, `curs`, `imgname`"
		. ") VALUES ("
		. " '$town', '$curs', '$imgname');";
	$this->query($q);
	return $this->lastState;
    }

    public
	    function deleteById($id) {
	$q = "DELETE FROM `photogalery` WHERE `id` ='$id'";
	$this->query($q);
    }

    public
	    function deleteByName($name) {
	$q = "DELETE FROM `photogalery` WHERE `imgname` ='$name'";
	$this->query($q);
    }

    public
	    function delete($town, $curs, $imgname) {
	$q = "DELETE FROM `photogalery` WHERE `town`='$town' AND `curs`='$curs' AND `imgname`='$imgname'";
	$this->query($q);
    }

    public
	    function GetPhotos($town, $curs) {
	$out	 = array();
	$q	 = "SELECT `imgname` FROM `photogalery` WHERE `town`='$town' AND `curs`='$curs';";
	foreach ($this->get_result($q) as $ut)
	{
	    $out[] = $ut->imgname;
	}
	return $out;
    }

}

