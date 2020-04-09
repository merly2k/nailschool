<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;

/**
 * Description of user
 *
 * @author merly
 */
class user extends \db {

    public
	    function __construct() {
	parent::__construct();
	$q = "CREATE TABLE `user` if not exist (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`role` VARCHAR(255) NOT NULL DEFAULT '2' COLLATE 'utf8_unicode_ci',
	`api_key` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	`seq_key` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `username` (`login`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT";
	$this->query($q);


	return;
    }

    public
	    function getUser($login) {
	$q = "SELECT * FROM `user` where login='$login' LIMIT 1;";
	return $this->get_result($q);
    }

    public
	    function getUserByID($id) {
	$q = "SELECT * FROM `user` where id='$id' LIMIT 1;";
	return $this->get_result($q);
    }

    public
	    function checkUser($login) {
	$q = "SELECT SQL_CALC_FOUND_ROWS * FROM `user` where login='$login'";
	$this->get_result($q);
	return $this->found;
    }

    public
	    function updateKey($api_key, $seq_key, $uid) {
	$q = "UPDATE `user` SET `api_key`='$api_key', `seq_key`='$seq_key' WHERE  `id`='$uid';";
	$this->query($q);
	return $this->lastState;
    }

    public
	    function auch($login) {
	$q	 = "SELECT * FROM user WHERE `login`='$login' LIMIT 1;";
	//echo $q;
	$user	 = $this->get_result($q);
	$curuser = $user[0];
	return $curuser;
    }

    public
	    function getUsers() {
	$q = "SELECT * FROM user";
	return $this->get_result($q);
    }

    public
	    function editUser($id, $login, $password) {
	$q = "UPDATE `user` SET `login`='$login', `password`='" . md5($password) . "', `role`='601' WHERE `id`=$id;";

	$this->query($q);
	return $this->lastState;
    }

    function Delete($id) {
	$q = "DELETE FROM `user` WHERE  `id`=$id";
	$this->query($q);
	return $this->lastState;
    }

    function Insert($login, $password, $role = 601) {
	$q = "INSERT INTO `user` (`login`, `password` ,`role`)"
		. "values('$login',"
		. "'" . md5($password) . "',"
		. "'$role');";
	$this->query($q);
	return $this->lastState;
    }

}
