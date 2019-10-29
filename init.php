<?php
$tablelist = glob(APP_PATH.DS."migration".DS."table".DS."*.sql");
$updatelist = glob(APP_PATH.DS."migration".DS."update".DS."*.sql");
$datalist = glob(APP_PATH.DS."migration".DS."data".DS."*.sql");
$db=new db();
foreach($tablelist as $location){
$commands = file_get_contents($location);   
$db->query($commands) ;
echo $db->lastState;
}
foreach($updatelist as $location){
$commands = file_get_contents($location);   
$db->query($commands)or die($db->lastState);
}

foreach($updatelist as $location){
$commands = file_get_contents($location);   
$db->multi_query($commands);
echo $db->lastState;
}

echo $db->lastState;
echo "init complete";
?>

