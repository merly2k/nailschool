<?php

efine('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);
define('semana', array('', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'));

function checkImageAttrs($image, $targeFile) {
    if (getimagesize($image["tmp_name"]) === false)
    {
	return "El archivo de el archivo no es una imagen.";
    }

    if ($image["size"] > 10 * MB)
    {
	return "Ups, el archivo es muy grande.";
    }

    $imageFileType = pathinfo($image["name"], PATHINFO_EXTENSION);

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
    {
	return "Ups, sólo están permitidos los archivos de tipo JPG, JPEG, PNG y GIF.";
    }

    return "OK";
}

function randomPassword($characters_count) {
    $alphabet	 = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass		 = array(); //remember to declare $pass as an array
    $alphaLength	 = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $characters_count; $i++)
    {
	$n	 = rand(0, $alphaLength);
	$pass[]	 = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$target_image_dir	 = APP_PATH . "/images/articles/";
$target_file		 = "";

$response	 = array('data' => [], 'success' => false, "status" => 499);
$fotoLink	 = json_encode($_FILES);

if (!empty($_FILES["image"]['tmp_name']))
{
    $imagen		 = $_FILES["image"];
    list($width, $height) = getimagesize($imagen['tmp_name']);
    $imageFileType	 = pathinfo($imagen["name"], PATHINFO_EXTENSION);
    $fileNameCoded	 = uniqid('', false) . '.' . strtolower($imageFileType);
    $target_file	 = $target_image_dir . $fileNameCoded;
    $fotoLink	 = $target_file;


    if (move_uploaded_file($imagen["tmp_name"], $target_file))
    {
	strtolower($imageFileType);
	$littleImage	 = WWW_IMAGE_PATH . 'inner_img/' . $fileNameCoded;
	$fotoLink	 = SITE_URL . $littleImage;

	$data		 = array("type"	 => "image/" . strtolower($imageFileType),
	    "width"	 => $width,
	    "height" => $height,
	    "name"	 => "",
	    "link"	 => $fotoLink);
	$response	 = array('data' => $data, 'success' => true, "status" => 200);
    }
}

$response = array('data' => $data, 'success' => true, "status" => 200);

echo json_encode($response);
