<?php
//print_r($_POST);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($_POST);
switch ($_POST['leadtype'])
{
    case 'curs':
	$leadtype	 = 'Запись на курс';
	break;
    case 'consult':
	$leadtype	 = 'Запись на консультацию';
	break;
    case 'calback':
	$leadtype	 = 'Обратный звонок';
	break;

    default:
	break;
}

$output = explode('/', trim($_POST['returnto'], '/'));


$l	 = new model\leads();
$name	 = $_POST['name'];
if (!isset($_POST['lname']))
{
    $lname = '';
}
else
{
    $lname = $_POST['lname'];
}
if (!isset($_POST['email']))
{
    $email = '';
}
else
{
    $email = $_POST['email'];
}
$phone	 = $_POST['phone'];
$curse	 = $_POST['id'];

$returnto = $_POST['returnto'];
$l->add($curse, $leadtype, $name, $lname, $email, $phone);
?>

<!DOCTYPE html>
<html lang = "en" >

    <head>
	<meta charset = "UTF-8">
	<title><?= l('thankyou'); ?></title>
	<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>

    </head>
    <body>

	<div class="jumbotron text-xs-center">
	    <h1 class="display-3"><?= l('thankyou'); ?></h1>
	    <p class="lead"><?= l('thank_txt'); ?></p>
	    <hr>
	    <p>
		<a href="<?= WWW_BASE_PATH ?>"><?= l('m1'); ?></a> |
		<a href="<?= WWW_BASE_PATH ?>curses/<?= $output[0] ?>"><?= l('m7'); ?></a>
	    </p>
	    <p class="lead">
		<a class="btn btn-primary btn-sm" href="<?= WWW_BASE_PATH . 'curses/curse/' . $_POST['returnto'] ?>" role="button"><?= l('gobask') ?></a>
	    </p>
	</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>



    </body>

</html>

