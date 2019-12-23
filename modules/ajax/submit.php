<?php

// Сообщение об ошибке:
error_reporting(E_ALL^E_NOTICE);
$page=$_POST['page'];
if(isset($_POST['email'])){$_SESSION['email']=$_POST['email'];}
if(isset($_POST['name'])){$_SESSION['name']=$_POST['name'];}
/*
/	Данный массив будет наполняться либо данными,
/	которые передаются в скрипт,
/	либо сообщениями об ошибке.
/*/
if(isset($_POST['parent_id'])){$parent_id=$_POST['parent_id'];}
else
{
    $parent_id=0;
}
$arr = array();
$validates = comment::validate($arr);

if($validates)
{
	/* Все в порядке, вставляем данные в базу: */
	$comen= new db();
	$q=("INSERT INTO comments(`parent_id`,`name`,`page`,`email`,`body`)
					VALUES (
						'".$parent_id."',
						'".$arr['name']."',
						'".$page."',
						'".$arr['email']."',
						'".$arr['body']."'
					)");
	$comen->query($q);
	$arr['dt'] = date('r',time());
	$arr['id'] = $comen->last_id;
	
	/*
	/	Данные в $arr подготовлены для запроса mysql,
	/	но нам нужно делать вывод на экран, поэтому 
	/	готовим все элементы в массиве:
	/*/
	
	$arr = array_map('stripslashes',$arr);
	
	$insertedComment = new comment($arr);

	/* Вывод разметки только-что вставленного комментария: */

	echo json_encode(array('status'=>1,'html'=>$insertedComment->markup()));

}
else
{
	/* Вывод сообщений об ошибке */
	echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>



















