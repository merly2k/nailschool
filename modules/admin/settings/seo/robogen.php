<?php
$rob=APP_PATH.'/robots.txt';
if(file_exists($rob)){unlink($rob);}
$disalow=array('/auth', '/admin','/user');
$dis=new model\seobase();
foreach ($dis->GetHide()as $v){
    array_push($disalow,'/'.$v->url);
};
///echo $rob;
$robot=fopen($rob, "w");

$rtemplate="
    User-agent: *\n
    Disallow: ".implode(',', $disalow)."
    Allow: /
    Sitemap: https://nailschool.com.ua/sitemap.xml";
    //echo $rtemplate;
fwrite($robot, $rtemplate);
fclose($robot);
echo "новый файл <a href='".WWW_BASE_PATH."robots.txt'>robots.txt </a>создан";