<?php

namespace model;

class comments extends \db {

    public
	    function getByLink($page) {
	$q	 = "SELECT * FROM  `comments` where `page`='$page'";
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
	$q = "SELECT * FROM `comments` where `id`='$id'";
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

