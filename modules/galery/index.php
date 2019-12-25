<?php
error_reporting(0);
$p=@$this->param[0];
$o=new templator();
switch ($p){
case 'gal':
    $tpl='<div class="slide slick-slide slick-current slick-active" style="width: 672px;" data-slick-index="3" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide{ID}">'
	. '<img src="{img}">'
	. '</div>';
    break;
case 'mod':
    $tpl='<div class="slide slick-slide slick-current slick-active" style="width: 672px;" data-slick-index="3" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide{id}">'
	. '<img src="{img}">'
	. '</div>';
    break;
case '':
    $tpl='<div class="slide slick-slide slick-current slick-active" style="width: 672px;" data-slick-index="3" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide{id}">'
	. '<img src="{img}">'
	. '</div>';
    break;
default :
    $tpl='<div class="slide slick-slide slick-current slick-active" style="width: 672px;" data-slick-index="3" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide{id}">'
	. '<img src="{img}">'
	. '</div>';
    break;
}
$workingdir  =APP_PATH."/images/galery/";
$files = glob($workingdir.'*.{gif,jpg,png}' ,GLOB_BRACE);
$files = array_map('basename',$files);
$id=0;
foreach ($files as $f)
{
    $id++;
    $ara= array('id'=>$id,'img'=>WWW_IMG_PATH.'galery/'.$f);
    $o->loadFromString($tpl);
 $context.=$o->Render($ara);
};
//}   ; 
 //$context.='</div>';
echo $context;
//include TEMPLATE_DIR . DS . $tpl . ".html";
