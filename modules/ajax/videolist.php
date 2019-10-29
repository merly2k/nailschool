<?php
//header("Content-type: application/json; charset=utf-8");
$v= new model\video();

echo '<ul>';
foreach ( $v->getList() as $row)
{
  echo "<li><a onclick=\"chahgeSource('".$row->source."')\">"
	  . "<img src='".$row->img."'>".$row->name."</a>"
	  . "</li>"; 
}
echo '<ul>';
?>

















