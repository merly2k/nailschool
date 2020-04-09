<?php

error_reporting(0);

$tpl		 = "admin";
$mod_name	 = "Управление галереей выпускников";
$brouse		 = '';
$lsize		 = '640×397px';
if (isset($_POST['action']) && $_POST['action'] == "upload")
{
    include_once "uploader.php";
    include_once "resize_image.php";

    $uploader = new Uploader($_FILES['files']);
    $uploader->set_upload_to(APP_PATH . "/images/vipusknik/");
    $uploader->set_valid_extensions(array('jpg', 'png', 'png'));
    $uploader->set_resize_image_library(new ResizeImage());

    if ($uploader->is_valid_extension() === false)
    {
	echo "<p>Error</p>";
	print_r($uploader->get_errors());
    }
    else
    {

	if ($uploader->run() === false)
	{
	    echo "<p>Error</p>";
	    print_r($uploader->get_errors());
	}
	else
	{
	    echo "...Uploaded";

	    if ($uploader->resize(70) === false)
	    {
		echo "<p>Error</p>";
		print_r($uploader->get_errors());
	    }
	    else
	    {
		echo "...Resized";
	    }
	}
    }
};
$context	 = '<div class="card-columns row">';
//function filebrouser{){
$workingdir	 = APP_PATH . "/images/vipusknik/";
$files		 = glob($workingdir . '*.{gif,jpg,png}', GLOB_BRACE);
// найти все php и txt файлы
//$files = glob('*.{php,txt}', GLOB_BRACE);
$files		 = array_map('basename', $files);
$llet		 = '';

foreach ($files as $f)
{
    $firstletter = mb_substr($f, 0, 1);
    if ($firstletter != $llet)
    {
	$llet	 = $firstletter;
	$lnav	 .= "<a class='btn btn-info' href='" . chr(35) . $llet . "'>" . $llet . "</a> ";
	$context .= "<a name='$firstletter'></a>";
    }
    $context .= '<div class="card col-2">'
	    . '<img class="card-img-top" src="' . WWW_IMG_PATH . 'vipusknik/' . $f . '">'
	    . '<div class="card-footer">'
	    . '<small>' . $f . '</small><br>'
	    . '<a href="' . WWW_ADMIN_PATH . 'vipusknik/del/' . $f . '" class="btn btn-info"><i class="fa fa-trash-o"></i></a>'
	    . '</div>'
	    . '</div>';
};
$mod_name	 .= "<hr>" . $lnav;
//}   ;
$context	 .= '</div>
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
<p class="alert alert-info">размер изображений ' . $lsize . '</p>
<input type="hidden" name="action" value="upload" />
1: <input type="file" multiple name="files[]" /><br />
2: <input type="file" name="files[]" /><br />
3: <input type="file" name="files[]" />
<button type="submit"  class="btn btn-info" value="Upload"><i class="fa fa-upload"></i></button>
</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">закрыть окно</button>
      </div>

    </div>

    </div>
  </div>
</div>';

include TEMPLATE_DIR . DS . $tpl . ".html";
