<?php

//print_r($this->param);
if (isset($_SESSION['lang']))
{
    $lang = mb_strtolower(@$_SESSION['lang']);
}
else
{
    $lang = "ua";
}
$lname		 = 'name_' . $lang;
$ldecription	 = 'decription_' . $lang;
$mlang		 = 'name_' . $lang;
$addr		 = 'addr_' . $lang;
$otherTown	 = '';
$tfut		 = '';
$lfulltext	 = 'fulltext_' . $lang;
$km		 = new model\misto();
$link		 = $this->param[0];
$currentMisto	 = ($km->getByName($link));
$misto		 = $currentMisto->$mlang;
foreach ($km->getall()as $k => $r)
{
    $mista[$r->link] = $r->$mlang;
    $otherTown	 .= '<a class="dropdown-item" href="' . WWW_BASE_PATH . 'curses/' . $r->link . '/">' . $r->$mlang . '</a>';

    $butons = array(
	'ua'	 => array(
	    "b1"	 => 'перейти на сторінку',
	    "b2"	 => 'навчального центра'
	),
	'ru'	 => array(
	    "b1"	 => 'перейти на страницу',
	    "b2"	 => 'учебного центра'
	)
    );
}



//print_r($this->param);
$town	 = $this->param[0];
$link	 = $this->param[1];
$tpl	 = 'curse';
$faddr=$km->getByName($town);
$tfut= '
        <a href="'.$faddr->fb.'"><i class="fab fa-facebook-square"></i></a>
	<a href="'.$faddr->inst.'"><i class="fab fa-instagram"></i></a>
';
    
$curses	 = new model\curses();
$cc	 = $curses->getCurse($town, $link);
$k	 = $cc[0];
if ($lang == 'ua')
{
    $lar=array('ень', 'ні', 'нів');
    $act_lan = 'Акція!';
    $aza	 = 'Записатись на курс!';
}
else
{
    $lar=array('ень', 'ня', 'ней');
    $act_lan = 'Акция!';
    $aza	 = 'Записаться на курс!';
}

//print_r($k);
$randAction = '
<div class="sale">
<p class="sale__text">Акция! <del></del> <strong>' . $k->ac_coast . '</strong> грн</p>
<a href="' . $k->link . '" class="sale__btn" style="cursor: pointer;" data-toggle="modal" data-target="#akcia">'.$aza.'! </a>

</div>
<img class="close-course__img" src="' . WWW_IMAGE_PATH . '/girl.png" alt="">

';

//print_r($mista);



if (count($cc) > 0)
{
    foreach ($cc as $row)
    {
	$context	 = '';
	$name		 = $row->$lname;
	$decription	 = $row->$ldecription;
	$fulltext	 = $row->$lfulltext;
	$dateX		 = strtotime($row->start);
	$start		 = date('d', $dateX);
	$monts		 = localeMomts($lang, date('m', $dateX));
	$coast		 = $row->coast;

	$colors	 = new \model\gradients();
	$color	 = $colors->getGradient($row->basecolor);

	$cursCSS = "
    .course-manikyura .section-title {
    color: $color->start !important;
}

.course-manikyura .close-course-list__block {
    color: $color->start !important;
}

.course-manikyura .gradient-block {
    background-image: -moz-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);

}

.gradient-text {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);

}


main .nearest-course {
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%);
    padding: 16px 0;
}
ol.about-list {
  list-style: none;
  counter-reset: my-awesome-counter;
}
ol.about-list li {
  counter-increment: my-awesome-counter;
}
ol.about-list li::before {
  content: counter(my-awesome-counter) \". \";
  color: #e7437c;
  font-weight: bold;
}
";

	$context .= '  <div class="row row-eq-height">
					<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 themed-grid-col py-5 px-4 px-lg-4 px-xl-5">
						<div class="px-lg-0 px-xl-5 py-5">
							<h3 class="text-center text-uppercase font-weight-bold gradient-text pt-1 mb-1">Базовий манікюр</h3>
							<h3 class="text-center text-uppercase font-weight-bold gradient-block py-1 mb-1">Програма курсу</h3>
							<h3 class="text-center text-uppercase font-weight-bold gradient-text mb-0"><small>обрезной + комбинированный</small></h3>
							<ol class="about-list">
							' . $decription . '
							</ol>
							<a href="#" class="btn btn-warning btn-lg btn-block text-uppercase font-weight-bold" data-toggle="modal" data-target="#">  ' . l('z3') . ' </a>
							<p class="text-center"><small>мы предоставляем базу моделей и расходные материалы высокого качества</small></p>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 themed-grid-col m-auto px-5">
						<iframe width="560" height="380" class="px-xl-5" src="https://www.youtube.com/embed/TAgL-NM4Yh8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
		' . $fulltext . '

';
    }
}
else
{
    $context = "для вашего города курсов нет";
}
$context	 .= "<script>
        var x=document.getElementById('geo');
        function getLocation()
         {
        if (navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(showPosition);
        }
        else{x.innerHTML='Geolocation is not supported by this browser.';}
        }
        function showPosition(position)
        {
        x.innerHTML='Latitude: ' + position.coords.latitude + 
        '<br>Longitude: ' + position.coords.longitude;  
        }
        getLocation()
        </script>";
$bc['ua']	 = 'Курси у ';
$bc['ru']	 = 'Курсы в ';
$vidminnik	 = array('ua'	 => array(
	'dnipro'	 => 'Дніпрі',
	'kyiv'		 => 'Київі',
	'zaporizhzhya'	 => 'Запоріжжї',
	'nicolaev'	 => 'Миколаєві',
    ),
    'ru'	 => array(
	'dnipro'	 => 'Днепре',
	'kyiv'		 => 'Киеве',
	'zaporizhzhya'	 => 'Запорожье',
	'nicolaev'	 => 'Николаеве',
    )
);
$cc		 = $bc[$lang] . $vidminnik[$lang][$this->param[0]];

$data=new db();
$comments = array();
$q="SELECT * FROM comments WHERE `page`='$link' ORDER BY id ASC";
$result=$data->get_result($q);
//echo $data->lastState;
foreach ($result as $row)
{
	$comments[] = new comment((array)$row);
}
$page_coment='';
foreach($comments as $c){
	$page_coment.= $c->markup();
}
//echo $_SESSION['lang'];

$workingdir  =APP_PATH."/images/galery/";
$files = glob($workingdir.'*.{gif,jpg,png}' ,GLOB_BRACE);
$files = array_map('basename',$files);
$id=0;
$o=new templator();
$galery='';
foreach ($files as $f)
{
    $pl='<div class="slide"><img src="{img}" alt="{id}"></div>';
    $id++;
    $ara= array('id'=>$id,'img'=>WWW_IMG_PATH.'galery/'.$f);
    $o->loadFromString($pl);
 $galery.=$o->Render($ara);
};
include TEMPLATE_DIR . DS . $tpl . ".html";
