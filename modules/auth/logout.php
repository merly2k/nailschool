<?php

error_reporting(0);

session_start();
$_SESSION = array();
$this->_DATA['login'] = '';
$this->_DATA['role'] = '';
session_destroy();
header('Location:' . WWW_BASE_PATH . '');
?>
