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
$teleg	 = new telegrambot();

$curses	 = new model\curses();
$packet	 = new model\packets();

$name = $_POST['name'];
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
//echo firstChar($_POST['id']);
$phone	 = $_POST['phone'];
$curse	 = $_POST['id'];
//echo $curse;
if (firstChar($curse) == 'p')
{
    $id	 = preg_replace('/p/', '', $_POST['id']);
    $c	 = $packet->getPacket($id);
    //print_r($c);
    $cursen	 = 'пакет ' . $c[0]->name_ru;
}
else
{

    $c	 = $curses->getCurseById($curse);
    $cursen	 = strip_tags($c->name_ru);
}
//print_r($c);
$km	 = new model\misto();
$mist	 = $km->getAll();
foreach ($mist as $e)
{
    //print_r($e->link);
    $mista[] = $e->link;
}

if (in_array($_POST['returnto'], $mista))
{
    $goback = '<a class="btn btn-primary btn-sm" href="' . WWW_BASE_PATH . 'curses/' . $_POST['returnto'] . '" role="button">' . l('gobask') . '</a>';
}
else
{
    $goback = '<a class="btn btn-primary btn-sm" href="' . WWW_BASE_PATH . 'curses/' . $_POST['returnto'] . '" role="button">' . l('gobask') . '</a>';
}
$returnto = $_POST['returnto'];
if (file_exists('telegram.ini'))
{
    $ini_array = parse_ini_file("telegram.ini", true);

    $teleg->setToken($ini_array['main']['token']);
    $teleg->setChat_id($ini_array["$c->miso"]['chat_id']);
}

$l->add($curse, $leadtype, $name, $lname, $email, $phone);
$teleg->send($cursen, $leadtype, $name, $phone, $lname, $email);
//print_r($_POST);
$teleg->setChat_id($ini_array['main']['mainChat']);
$teleg->send($cursen, $leadtype, $name, $phone, $lname, $email);
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
		<?= $goback ?>
	    </p>
	</div>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>



    </body>

</html>

