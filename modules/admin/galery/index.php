<?php
error_reporting(0);
$tpl="admin";
$mod_name="Управление галереей";
if (isset($_POST['action']) && $_POST['action'] == "upload") {
	include_once "uploader.php";
	include_once "resize_image.php";

	$uploader = new Uploader($_FILES['files']);
	$uploader->set_upload_to(APP_PATH."/img/galery/");
	$uploader->set_valid_extensions(array('jpg', 'png', 'png'));
	$uploader->set_resize_image_library(new ResizeImage());
	
	if ($uploader->is_valid_extension() === false) {
		echo "<p>Error</p>";
		print_r($uploader->get_errors());
	}else{
		
		if ($uploader->run() === false) {
			echo "<p>Error</p>";
			print_r($uploader->get_errors());
		}else{
			echo "...Uploaded";
			
			if ($uploader->resize(70) === false) {
				echo "<p>Error</p>";
				print_r($uploader->get_errors());
			}else{
				echo "...Resized";
			}
		}
		
	}
	
	
};
$context='<div class="card-columns">';
//function filebrouser{){
  $workingdir  =APP_PATH."/img/galery/";
  $files = glob($workingdir.'*.{gif,jpg,png}' ,GLOB_BRACE);
// найти все php и txt файлы
//$files = glob('*.{php,txt}', GLOB_BRACE);
$files = array_map('realpath',$files);

foreach ($files as $f)
{
    $context.='<div class="card">'
	    . '<img class="card-img-top" src="'.WWW_IMG_PATH.'galery/'. basename($f).'">'
	    . '<div class="card-footer">'
	    . '<a href="'.WWW_ADMIN_PATH.'galery/del/'.basename($f).'" class="btn btn-info"><i class="fa fa-trash-o"></i></a>'
	    . '</div>'
	    . '</div>' ;
};
//}   ; 
 $context.='</div>
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  загрузить
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">загрузка файлов</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
<form  method="post" enctype="multipart/form-data">
<input type="hidden" name="action" value="upload" />
1: <input type="file" name="files[]" /><br />
2: <input type="file" name="files[]" /><br />
3: <input type="file" name="files[]" />
<input type="submit" value="Upload" />
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>';

include TEMPLATE_DIR . DS . $tpl . ".html";
