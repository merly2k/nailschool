<?php
$img = $_POST['image'];
	if (file_exists( APP_PATH.'/upload/'.$img)) 
		unlink(APP_PATH.'/upload/'.$img);
