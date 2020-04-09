<?php

$brouse	 = '';
$lsize	 = '';
//print_r($_POST);
$bpath	 = $_POST['brouse']; //получакм путь к папке для просмотра и загрузки
$target	 = $_POST['target'];
$files	 = glob($bpath . '*.{gif,jpg,png}', GLOB_BRACE);
$files	 = array_map('basename', $files);
$webpath = preg_replace('@' . APP_PATH . '/images/@', WWW_IMAGE_PATH, $bpath);
//echo $webpath;
echo "<div class='scrollable'><div class='row no-gutters' style='height: 400px; overflow-y: auto;'>";
foreach ($files as $file)
{
    $info	 = pathinfo($file);
    $pn	 = basename($file, '.' . $info['extension']);

    $fwpath = $webpath . $file;
    echo "<div id='$pn' class='col-3 iml card'>"
    . "<img style='cursor:pointer;' src='$fwpath' class='card-img-top img-fluid' onclick=\"setimg('$target','$file','$fwpath');\">"
    . "<div class='card-footer'>"
    . "<a class='btn btn-danger mx-auto' onclick=\"delFile('$bpath','$file','$pn')\">"
    . "<i class='fa fa-trash-o'></i></a></div></div>";
}
echo "</div>";
echo "</div>";
