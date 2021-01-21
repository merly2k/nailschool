<?php

namespace model;

class comments extends \db {

    public
	    function getByLink($page) {
	$q	 = "SELECT SQL_CALC_FOUND_ROWS * FROM  `comments` where `page`='$page'";
	$out	 = $this->get_result($q);
	//print_r($this->found);
	if ($this->found == 0)
	{
	    $out[0] = 'empty';
	    return $out;
	}
	else
	{
	    return $out;
	}
    }

    public
	    function getComment($id) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `comments` where `id`='$id'";
	return $this->get_result($q);
    }
    public
	    function getLatest($lim) {
	$q = "SELECT * FROM `comments` ORDER BY dt DESC LIMIT $lim";
	return $this->get_result($q);
    }

    public
	    function updateComment($id, $body) {
	$q = "UPDATE `comments` SET `body`='$body' WHERE  `id`=$id;";
	$this->query($q);
	return $this->lastState;
    }

    public
	    function deleteComment($id) {
	$q = "DELETE FROM `comments` where (`id`='$id' or `parent_id`='$id')";
	$this->query($q);
	return $this->lastState;
    }

}

