<?php

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
//print_r($currentMisto);
$addr		 = 'addr_' . $lang;
$ttown		 = 'name_' . $lang;
$fulladress	 = $currentMisto->$ttown . ',' . strip_tags($currentMisto->$addr);
$misto		 = $currentMisto->$mlang;
$gmap		 = $currentMisto->gmap;
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
switch ($town)
{
    case 'virtual':

	$tpl = "online";

	break;

    default:
	$tpl = 'curse';

	break;
}

$faddr		 = $km->getByName($town);
$sch		 = new model\school();
$school		 = $sch->getByLink($town);
//print_r($school);
$sch_osnashennia = htmlspecialchars_decode($school->{'osnashennia_' . $lang}, ENT_NOQUOTES);
$sch_ergonomik	 = htmlspecialchars_decode($school->{'ergonomik_' . $lang}, ENT_NOQUOTES);
$sch_location	 = htmlspecialchars_decode($school->{'location_' . $lang}, ENT_NOQUOTES);
$sch_shop	 = htmlspecialchars_decode($school->{'shop_' . $lang}, ENT_NOQUOTES);
$sch_konsult	 = htmlspecialchars_decode($school->{'konsult_' . $lang}, ENT_NOQUOTES);
$sch_tur	 = htmlspecialchars_decode($school->{'tur_' . $lang}, ENT_NOQUOTES);
if (firstChar($faddr->fb) != '#')
{
    $tfut = '
        <a href="' . $faddr->fb . '"><i class="fab fa-facebook-square"></i></a>';
}
if (firstChar($faddr->inst) != '#')
{
    $tfut .= '        	<a href="' . $faddr->inst . '"><i class="fab fa-instagram"></i></a>';
}
$tfut .= '<a href = "https://www.youtube.com/channel/UCZcCF_9g8Cp2mE1WG66IEjg"><i class = "fab fa-youtube-square"></i></a>
';

$curses	 = new model\curses();
$cc	 = $curses->getCurse($town, $link);
//esas
$k	 = $cc[0];
//print_r($k);
$zia	 = array();
$zia	 = explode(' ', $k->$mlang);
//echo count($zia);
$nth	 = 'nth-word-' . count($zia);
if (isset($k->{'googldock_' . $lang}))
{
    $gdoc = $k->{'googldock_' . $lang};
}
else
{
    $gdoc = '';
}
$ved	 = 'video_' . $lang;
//print_r($k);
$video	 = $k->$ved;
if ($lang == 'ua')
{
    $lar	 = array('ень', 'ні', 'нів');
    $act_lan = 'Акція!';
    $aza	 = 'Записатись на курс!';
}
else
{
    $lar	 = array('ень', 'ня', 'ней');
    $act_lan = 'Акция!';
    $aza	 = 'Записаться на курс!';
}
$mashas	 = '';
$mashas	 = WWW_IMG_PATH . 'grl/' . $k->mashas;

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
	$tur		 = $row->tur;

	$colors	 = new \model\gradients();
	$color	 = $colors->getGradient($row->basecolor);

	$cursCSS = "
    .course-manikyura .section-title {
    color: $color->start !important;
}

.course-manikyura .close-course-list__block {
    color: $color->start !important;
}
.line-sale-v2,
 .gradient-block {
    background-image: -moz-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%) !important;;
    background-image: -webkit-linear-gradient(0deg, $color->start 0%, $color->middle 30%, $color->end 100%) !important;;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%) !important;;

}
.nongradient{background-color: $color->end !important;}

.gradient-text {
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;;

}


main .nearest-course {
    background-image: -moz-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%) !important;
    background-image: -webkit-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;
    background-image: -ms-linear-gradient(0deg, $color->start  0%, $color->middle 30%, $color->end 100%)!important;
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
$bc['ua']	 = 'Курси ';
$bc['ru']	 = 'Курсы ';
$vidminnik	 = array('ua'	 => array(
	'dnipro'	 => 'у Дніпрі',
	'kyiv'		 => 'у Київі',
	'zaporizhzhya'	 => 'у Запоріжжі',
	'nicolaev'	 => 'у Миколаєві',
	'virtual'	 => 'онлайн',
    ),
    'ru'	 => array(
	'dnipro'	 => 'в Днепре',
	'kyiv'		 => 'в Киеве',
	'zaporizhzhya'	 => 'в Запорожье',
	'nicolaev'	 => 'в Николаеве',
	'virtual'	 => 'онлайн',
    )
);

$cc = $bc[$lang] . $vidminnik[$lang][$this->param[0]];

$data		 = new db();
$comments	 = array();
$q		 = "SELECT * FROM comments WHERE `page`='$link' ORDER BY id ASC";
$result		 = $data->get_result($q);
//echo $data->lastState;
foreach ($result as $row)
{
    $comments[] = new comment((array) $row);
}
$page_coment = '';
foreach ($comments as $c)
{
    $page_coment .= $c->markup();
}
//галерея работ
$g	 = new model\photogalery();
$files	 = $g->GetPhotos($town, $link);

$o		 = new templator();
$galery		 = '';
$id		 = 0;
$workingdir	 = APP_PATH . "/images/galery/";
$wdir		 = WWW_IMG_PATH . "galery/";
$fl		 = glob($workingdir . '*.{gif, jpg, png}', GLOB_BRACE);
$fl		 = array_map('basename', $files);

foreach ($fl as $f)
{
    if (in_array($f, $files))
    {
	$id++;
	$pl1	 = '<div class = "slide"><img src = "' . $wdir . $f . '" alt = "' . $id . '"></div>';
	$galery	 .= $pl1;
    }
    else
    {
	echo "$f not in " . print_r($fl, true) . '<br>';
    }
};


//галерея выпускников
$g1		 = new model\vipusknik;
$files1		 = $g1->GetPhotos($town, $link);
$oz		 = new templator();
$vipusk		 = '';
$id1		 = 0;
$workingdir1	 = APP_PATH . "/images/vipusknik/";
$wdir1		 = WWW_IMG_PATH . "vipusknik/";
$fl1		 = glob($workingdir1 . '*.{gif, jpg, png}', GLOB_BRACE);
$fl1		 = array_map('basename', $fl1);

foreach ($files1 as $f)
{ //<div class="slide"><img src="slider-photo.png"></div>
    if (in_array($f, $fl1))
    {
	$id1++;
	$pll	 = '<div class = "slide"><img src = "' . $wdir1 . $f . '" alt = "' . $id1 . '"></div>';
	$vipusk	 .= $pll;
    }
};
$fago	 = new bildfaqo();
$qa	 = $fago->getFAQO($town, $lang);
include TEMPLATE_DIR . DS . $tpl . ".html";
