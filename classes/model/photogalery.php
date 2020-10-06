<?php

namespace model;

class photogalery extends \db {

    public
	    function insert($town, $curs, $imgname, $title) {
	$q = "INSERT INTO `photogalery` ("
		. " `town`, `curs`, `imgname`,`title`"
		. ") VALUES ("
		. " '$town', '$curs', '$imgname','$title');";
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
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM `photogalery` WHERE `town`='$town' AND `curs`='$curs';";
	foreach ($this->get_result($q) as $ut)
	{
	    $out[] = $ut->imgname;
	}
	//print_r($q);
	return $out;
    }

    public
	    function GetTitle($imgname) {
	$q	 = "SELECT `title` FROM `photogalery` WHERE `imgname`='$imgname';";
	$z	 = $this->get_result($q);
	if (isset($z[0]))
	{
	    //print_r($z[0]->title);
	    return $z[0]->title;
	}
	else
	{
	    return '';
	}
    }

}

