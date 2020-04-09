<?php

extract($_POST);
$gal = new model\vipusknik();
switch ($dija)
{
    case 'add':
	$gal->insert($town, $curs, $photo);
	echo "record aded";
	break;
    case 'del':
	echo "record deleted";
	$gal->delete($town, $curs, $photo);
	break;
}








