<?php
//print_r($_REQUEST);
$us=new model\user();
echo $us->checkUser($_POST['login']);
