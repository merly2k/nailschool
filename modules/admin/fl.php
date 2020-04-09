<?php

$brouse		 = '';
$lsize		 = '';
$path		 = $_POST['path'];
$webpath	 = preg_replace('@' . APP_PATH . '/images/@', WWW_IMAGE_PATH, $path);
$filename	 = $_FILES['userfile']['name'];
$target		 = $_POST['target'];
//print_r($_FILES);
$file		 = basename($_FILES['userfile']['name']);
$uploadfile	 = $path . $file;
//echo "$uploadfile";

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
{
    $info	 = pathinfo($filename);
    $pn	 = basename($filename, '.' . $info['extension']);
    $fwpath	 = $webpath . $file;
    echo "<div id='$pn' class='col-3 iml card'>"
    . "<img src='" . $fwpath . "' style='width: 150px;cursor:pointer;' onclick=\"setimg('$target','$file','$fwpath');\">"
    . "<div class='card-footer'>"
    . "<a class='btn btn-danger mx-auto' onclick=\"delFile('$path','$file','$pn')\">"
    . "<i class='fa fa-trash-o'></i></a></div></div>";
}

function generate_string($sufix = '', $strength = 16) {
    $input		 = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length	 = strlen($input);
    $random_string	 = $sufix;
    for ($i = 0; $i < $strength; $i++)
    {
	$random_character	 = $input[mt_rand(0, $input_length - 1)];
	$random_string		 .= $random_character;
    }

    return $random_string;
}
