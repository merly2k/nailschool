<?php

extract($_POST);
$gal = new model\photogalery();
if(empty($title)){$title='';}
switch ($dija)
{
    case 'add':
	$gal->insert($town, $curs, $photo, $title);
	echo "record aded";
	break;
    case 'del':
	echo "record deleted";
	$gal->delete($town, $curs, $photo);
	break;
}








