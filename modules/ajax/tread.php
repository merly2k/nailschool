<?php
header('Content-Type: application/json');
$darling=new model\leads();
foreach($darling->getLatest() as $row){
    
$origin = new DateTime($row->sdate);
$target = new DateTime('NOW');
$interval = $origin->diff($target);
$s=(int)$interval->format('%a');
$out=array();
if($s<1){
$out['data'][]= '<a class="dropdown-item" href="'.WWW_ADMIN_PATH.'edit/'.$row->id.'">'.$row->leadtype.'</a>';}
}

 echo json_encode($out);
?>
