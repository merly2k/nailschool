<?php
header("Content-type: application/json; charset=utf-8");
$v= new model\video();

foreach ( $v->getList() as $row)
{
   $t[]= (array)$row;
}
echo json_encode($t);
?>





