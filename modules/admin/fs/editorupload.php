<?php
if(empty($_FILES['file']))
{
	exit();
}
$errorImgFile = WWW_BASE_PATH."img/img_upload_error.jpg";
$destinationFilePath = WWW_BASE_PATH.'upload/'.$_FILES['file']['name'];
$FilePath = APP_PATH.'/upload/'.$_FILES['file']['name'];
if(!move_uploaded_file($_FILES['file']['tmp_name'], $FilePath)){
	echo $errorImgFile;
}
else{
	echo $destinationFilePath;
}
?>
